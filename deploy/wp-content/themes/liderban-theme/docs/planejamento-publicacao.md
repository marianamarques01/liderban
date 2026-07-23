# Planejamento de Publicação — Liderban

> Documento de planejamento para levar o site do ambiente **Local WP** à **produção**.
> **Data:** 2026-07-03  
> **Escopo:** tema `liderban-theme` + WordPress + plugin Instagram

---

## Resumo executivo

O site está **~85% pronto para publicação**. O blog está completo; as páginas principais existem, exceto **Clientes**. Falta fechar desenvolvimento (SEO, QA, imagens), configurar o admin WordPress, contratar hospedagem e migrar.

**Estimativa total até go-live:** 1–2 semanas  
- **Desenvolvimento (Cursor):** 3–5 sessões (~8–12 h)  
- **Configuração admin (você):** 1–2 h  
- **Infraestrutura (hospedagem + domínio):** 1–3 dias (depende do provedor)

---

## Estado atual

| Item | Status |
|------|--------|
| Home (`front-page.php`) | ✅ Pronta |
| Serviços (`page-solucoes.php`) | ✅ Pronta |
| Quem Somos (`page-quem-somos.php`) | ✅ Pronta |
| BanBan (`page-banban.php`) | ✅ Pronta |
| **Clientes (`page-clientes.php`)** | ❌ **Não existe** (CSS já pronto) |
| Blog — listagem + detalhe + filtros | ✅ Fases 0–6 concluídas |
| Plugin Instagram (`liderban-instagram-feed`) | ⚠️ Existe; feed real depende de token/API |
| SEO (meta, OG, schema) | ⚠️ Parcial (só home manual) |
| QA final + redirects + imagens | ❌ Pendente |
| Hospedagem / domínio / deploy | ❌ Não iniciado |

> **Nota:** O arquivo `liderban /DEPLOY.md` (Netlify) é do site HTML estático antigo e **não se aplica** a este WordPress.

---

## Quem faz o quê

Legenda:
- 🤖 **Cursor (eu)** — posso implementar no código/local
- 👤 **Você** — ação manual no admin, decisão ou contratação
- 🏢 **Terceiros** — hospedagem, registro de domínio, cliente

---

### 🤖 O que o Cursor consegue fazer

| # | Tarefa | Entrega | Tempo est. |
|---|--------|---------|------------|
| 1 | Criar `page-clientes.php` | Template WP espelhando `clientes.html` (13 logos, hero, grid) | 30–45 min |
| 2 | Implementar SEO no tema (sem plugin) | Meta description por página, Open Graph, Twitter Cards, JSON-LD Organization | 2–3 h |
| 3 | **OU** preparar tema para Rank Math | Remover meta duplicada da home; hooks compatíveis | 30 min |
| 4 | Comprimir/otimizar imagens pesadas | Reduzir `banban_bg.jpeg` e demais > 1 MB; documentar antes/depois | 1–2 h |
| 5 | QA técnico no código | Verificar links, templates, PHP, console JS, responsivo via checklist | 1–2 h |
| 6 | Documento de redirects 301 | Regras para plugin Redirection ou `.htaccess` | 30 min |
| 7 | Limpeza Fase 7 | Mover imagens do symlink para `assets/images/` físico; arquivar `liderban /` | 1 h |
| 8 | Guia do cliente (blog) | Markdown/PDF: como publicar notícia no wp-admin | 30 min |
| 9 | Script de verificação pré-deploy | Checklist automatizado (PHP lint, arquivos obrigatórios, etc.) | 30 min |
| 10 | Ajustes visuais finais | Correções pontuais reportadas no QA | Variável |
| 11 | Integração Instagram (se houver token) | Configurar plugin com credenciais da Meta | 1 h |
| 12 | Atualizar docs de migração | Marcar fases concluídas; alinhar status real | 30 min |

**Total estimado (Cursor):** ~8–12 horas em 3–5 sessões

---

### 👤 O que depende de você

| # | Tarefa | Por quê o Cursor não faz sozinho |
|---|--------|----------------------------------|
| 1 | Criar páginas no wp-admin | Requer login no WordPress local/produção |
| 2 | Configurar Leitura (Home + Blog) | Admin → Configurações |
| 3 | Configurar permalinks e menu | Admin → Aparência / Configurações |
| 4 | Publicar posts seed (2–3 notícias) | Conteúdo editorial + imagens reais |
| 5 | Escolher e contratar hospedagem | Decisão comercial / budget |
| 6 | Comprar/configurar domínio | Acesso ao Registro.br ou similar |
| 7 | Instalar Rank Math e preencher metas | Admin produção (ou local, se preferir plugin) |
| 8 | Exportar site do Local (All-in-One WP Migration) | Plugin + clique no admin |
| 9 | Importar na hospedagem | Acesso ao painel da hospedagem |
| 10 | Apontar DNS do domínio | Painel do registrador |
| 11 | Cadastrar Search Console / Analytics | Contas Google do cliente |
| 12 | Validar visualmente no navegador | Aprovação humana do layout |
| 13 | Fornecer token Instagram (Meta API) | Credenciais da conta @liderban |
| 14 | Aprovar textos finais (mídia, conformidades, etc.) | Conteúdo de negócio |

---

### 🏢 O que depende de terceiros

| # | Tarefa | Responsável |
|---|--------|-------------|
| 1 | Servidor PHP + MySQL + SSL | Hospedagem (Hostinger, Locaweb, Kinsta, etc.) |
| 2 | Propagação DNS (24–48 h) | Registrador + hospedagem |
| 3 | Certificado HTTPS | Hospedagem (Let's Encrypt) |
| 4 | Backup automático | Plano da hospedagem |
| 5 | Conteúdo editorial definitivo | Cliente Liderban |
| 6 | Links reais "Liderban na mídia" | Cliente (matérias de imprensa) |

---

## Plano por fases

### Fase A — Fechar desenvolvimento (Cursor + você)

**Objetivo:** Site 100% funcional no Local, pronto para exportar.

| Ordem | Tarefa | Responsável | Bloqueio |
|-------|--------|-------------|----------|
| A1 | Criar `page-clientes.php` | 🤖 Cursor | — |
| A2 | QA visual em todas as páginas | 👤 Você + 🤖 Cursor | A1 |
| A3 | Corrigir bugs do QA | 🤖 Cursor | A2 |
| A4 | Otimizar imagens pesadas | 🤖 Cursor | — |
| A5 | SEO (tema ou prep. Rank Math) | 🤖 Cursor | Decisão: plugin vs código |
| A6 | Documento redirects 301 | 🤖 Cursor | — |
| A7 | Limpeza `liderban /` + symlink | 🤖 Cursor | A3 OK |
| A8 | Configurar admin local | 👤 Você | `configuracao-wordpress.md` |
| A9 | Publicar 2–3 posts seed | 👤 Você | A8 |

**Critério de saída:** Todas as URLs funcionam no Local; zero 404 interno; blog com conteúdo de teste.

---

### Fase B — Preparar produção (você + terceiros)

**Objetivo:** Infraestrutura pronta para receber o site.

| Ordem | Tarefa | Responsável | Bloqueio |
|-------|--------|-------------|----------|
| B1 | Escolher hospedagem WordPress | 👤 Você | Budget |
| B2 | Contratar plano + instalar WP | 🏢 Hospedagem | B1 |
| B3 | Registrar/apontar domínio | 👤 Você + 🏢 Registrador | Domínio definido |
| B4 | Exportar site do Local | 👤 Você | Fase A concluída |
| B5 | Importar na hospedagem | 👤 Você | B2, B4 |
| B6 | Atualizar URLs (local → produção) | 👤 Você / plugin | B5 |
| B7 | Ativar SSL (HTTPS) | 🏢 Hospedagem | B3 |

**Critério de saída:** Site acessível em `https://seudominio.com.br`.

---

### Fase C — Go-live (Cursor + você)

**Objetivo:** Site público, indexável e monitorado.

| Ordem | Tarefa | Responsável | Bloqueio |
|-------|--------|-------------|----------|
| C1 | Instalar Redirection + regras 301 | 👤 Você (regras: 🤖 Cursor) | B7 |
| C2 | Instalar Rank Math + metas por página | 👤 Você | B7 |
| C3 | Cache + segurança (opcional) | 👤 Você | B7 |
| C4 | Search Console + sitemap | 👤 Você | B7 |
| C5 | Google Analytics | 👤 Você | B7 |
| C6 | Teste final em produção | 👤 Você + 🤖 Cursor | C1–C5 |
| C7 | Entregar guia ao cliente | 🤖 Cursor (doc) + 👤 Você (envio) | C6 |

**Critério de saída:** Site no ar, HTTPS, redirects OK, Search Console configurado.

---

## Cronograma sugerido

```
Semana 1
├── Sessão 1 (Cursor): page-clientes + início QA
├── Sessão 2 (Cursor): SEO + otimização de imagens
├── Você: configurar admin local + posts seed
└── Sessão 3 (Cursor): correções QA + limpeza + redirects

Semana 2
├── Você: contratar hospedagem + domínio
├── Você: exportar Local → importar produção
├── Sessão 4 (Cursor): ajustes pós-migração (se necessário)
└── Você: Rank Math, Redirection, Search Console, go-live
```

---

## Decisões pendentes (preciso da sua resposta)

Antes de executar, confirme:

| # | Decisão | Opções | Recomendação |
|---|---------|--------|--------------|
| 1 | SEO | **A)** Rank Math (plugin) **B)** Código no tema | **A** — mais fácil de manter |
| 2 | Hospedagem | Hostinger / Locaweb / Kinsta / outra | Depende do budget |
| 3 | Domínio | Qual URL final? (`liderban.com.br`?) | — |
| 4 | Site antigo | Existia HTML no ar? Precisa redirect? | Se sim → Redirection |
| 5 | Instagram | Integrar feed real agora ou placeholder? | Pode ficar para v2 |
| 6 | Conteúdo seed | Você escreve ou uso textos placeholder? | Placeholder OK para teste |

---

## Sessões Cursor — roteiro pronto para executar

Copie e cole em novas conversas:

### Sessão 1 — Clientes + QA
```
Implemente page-clientes.php conforme liderban /clientes.html.
Rode QA nas páginas Home, Serviços, Clientes, Quem Somos, BanBan e Blog.
Corrija bugs encontrados.
```

### Sessão 2 — SEO + Performance
```
Implemente SEO conforme decisão [A ou B].
Comprima imagens > 1 MB em assets/images/.
Remova meta duplicada da home se usar Rank Math.
```

### Sessão 3 — Limpeza + Deploy prep
```
Execute Fase 7 da migração: limpeza liderban /, redirects 301 documentados,
atualize docs. Gere guia do cliente para publicar no blog.
```

### Sessão 4 — Pós-migração (se necessário)
```
Site migrado para [URL]. Verifique URLs quebradas, mixed content HTTPS,
e ajustes de wp-config. Corrija o que encontrar.
```

---

## Checklist go-live (imprimível)

### Desenvolvimento
- [ ] `page-clientes.php` criada e testada
- [ ] QA desktop + mobile em todas as páginas
- [ ] Imagens otimizadas
- [ ] SEO configurado (plugin ou tema)
- [ ] Redirects 301 documentados
- [ ] Pasta `liderban /` arquivada fora do tema
- [ ] Zero erros no console do navegador

### WordPress Admin (local)
- [ ] Tema Liderban ativo
- [ ] Páginas criadas (Home, Serviços, Clientes, Quem Somos, BanBan, Blog)
- [ ] Leitura → Home estática + Blog
- [ ] Permalinks → Nome do post
- [ ] Menu principal configurado
- [ ] 2–3 posts publicados com imagem e excerpt

### Produção
- [ ] Hospedagem contratada
- [ ] Site migrado do Local
- [ ] Domínio apontado
- [ ] HTTPS ativo
- [ ] Redirection com regras `.html`
- [ ] Rank Math preenchido
- [ ] Search Console + sitemap enviado
- [ ] Analytics instalado
- [ ] Backup automático ativo
- [ ] Teste WhatsApp e links do menu/footer
- [ ] Guia entregue ao cliente

---

## O que posso começar agora (sem bloqueios)

Estas tarefas **não dependem** de decisão sua nem de hospedagem:

1. ✅ Criar `page-clientes.php`
2. ✅ Otimizar imagens pesadas
3. ✅ Documento de redirects 301
4. ✅ QA técnico + correções
5. ✅ Guia do cliente (blog)
6. ✅ Atualizar status nos docs de migração
7. ✅ Limpeza Fase 7 (symlink → pasta física)

**Depende da sua decisão:**
- SEO via Rank Math (preciso que instale o plugin localmente) **ou** SEO no tema (posso fazer direto)

---

## Referências

| Documento | Uso |
|-----------|-----|
| `docs/configuracao-wordpress.md` | Setup do admin |
| `docs/migracao-html-wordpress.md` | Fases técnicas + QA visual |
| `docs/blog-desenvolvimento.md` | Blog (concluído) |
| `liderban /clientes.html` | Referência visual Clientes |
| `liderban /DEPLOY.md` | ⚠️ Obsoleto (Netlify estático) |

---

## Próximo passo recomendado

**Sessão 1:** Implementar `page-clientes.php` + rodar QA nas 6 páginas principais.

Diga: *"Executa a Sessão 1"* — ou responda as decisões pendentes (SEO, domínio, hospedagem) para eu adaptar o plano.
