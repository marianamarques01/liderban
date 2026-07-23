#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")"

if ! command -v python3 >/dev/null; then
  echo "python3 nao encontrado"
  exit 1
fi

python3 -m pip install --quiet pymysql

MYSQL_PUBLIC_URL="$(rtk railway variables --service MySQL --json | python3 -c "import sys,json; print(json.load(sys.stdin)['MYSQL_PUBLIC_URL'])")"
SQL_PATH="$(pwd)/init/01-import.sql"

MYSQL_PUBLIC_URL="$MYSQL_PUBLIC_URL" SQL_PATH="$SQL_PATH" python3 import-db.py

echo
echo "Importacao concluida."
echo "Abra: https://liderban-preview-production.up.railway.app"
