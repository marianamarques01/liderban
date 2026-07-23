#!/usr/bin/env python3
import os
import re
import sys
from urllib.parse import urlparse

import pymysql


def parse_mysql_url(url: str):
    parsed = urlparse(url)
    return {
        "host": parsed.hostname,
        "port": parsed.port or 3306,
        "user": parsed.username,
        "password": parsed.password,
        "database": parsed.path.lstrip("/"),
    }


def split_sql_statements(sql: str):
    statements = []
    buffer = []
    in_string = False
    escape = False
    for char in sql:
        buffer.append(char)
        if escape:
            escape = False
            continue
        if char == "\\":
            escape = True
            continue
        if char == "'":
            in_string = not in_string
            continue
        if char == ";" and not in_string:
            statement = "".join(buffer).strip()
            if statement:
                statements.append(statement)
            buffer = []
    tail = "".join(buffer).strip()
    if tail:
        statements.append(tail)
    return statements


def main():
    mysql_url = os.environ.get("MYSQL_PUBLIC_URL")
    sql_path = os.environ.get("SQL_PATH")
    if not mysql_url or not sql_path:
        print("Set MYSQL_PUBLIC_URL and SQL_PATH", file=sys.stderr)
        sys.exit(1)

    cfg = parse_mysql_url(mysql_url)
    with open(sql_path, "r", encoding="utf-8", errors="replace") as handle:
        sql = handle.read()

    sql = re.sub(r"/\*![0-9]+.*?\*/;", "", sql, flags=re.DOTALL)
    statements = split_sql_statements(sql)

    conn = pymysql.connect(
        host=cfg["host"],
        port=cfg["port"],
        user=cfg["user"],
        password=cfg["password"],
        database=cfg["database"],
        charset="utf8mb4",
        autocommit=True,
        connect_timeout=30,
        read_timeout=300,
        write_timeout=300,
    )

    executed = 0
    try:
        with conn.cursor() as cursor:
            cursor.execute("SET SESSION sql_mode = ''")
            cursor.execute("SET FOREIGN_KEY_CHECKS = 0")
            cursor.execute("SHOW TABLES")
            for (table_name,) in cursor.fetchall():
                cursor.execute(f"DROP TABLE IF EXISTS `{table_name}`")
            for statement in statements:
                if statement.startswith("--"):
                    continue
                try:
                    cursor.execute(statement)
                    executed += 1
                except pymysql.MySQLError as exc:
                    if exc.args and exc.args[0] in {1050, 1062}:
                        continue
                    print(f"Error on statement #{executed + 1}: {exc}", file=sys.stderr)
                    print(statement[:200], file=sys.stderr)
                    raise
    finally:
        conn.close()

    print(f"Imported {executed} SQL statements into {cfg['database']}")


if __name__ == "__main__":
    main()
