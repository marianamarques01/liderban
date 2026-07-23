# Migração Liderban: HTML → WordPress

> Documento de referência para migrar o site estático em `liderban /` para o tema WordPress `liderban-theme`.
> **Fonte da verdade:** arquivos HTML/CSS/JS da pasta `liderban /`.
> **Última atualização:** 2026-06-08

---

## Índice

1. [Diagnóstico](#diagnóstico)
2. [Arquitetura do tema](#arquitetura-do-tema)
3. [Mapeamento de URLs](#mapeamento-de-urls)
4. [Decisões de projeto](#decisões-de-projeto)
5. [Fases e prompts](#fases-e-prompts)
6. [Checklist de QA](#checklist-de-qa)
7. [Estimativa de esforço](#estimativa-de-esforço)

---

## Diagnóstico

### Site HTML (`liderban /`)

| Página     | Arquivo           | Conteúdo principal                                      |
|------------|-------------------|---------------------------------------------------------|
| Home       | `index.html`      | Hero carousel, seção água, atuação, soluções, serviços |
| Serviços   | `solucoes.html`   | Hero, 4 cards, 4 modais com CTA WhatsApp                |
| Clientes   | `clientes.html`   | Hero, grid de 13 logos de parceiros                     |
| Quem Somos | `quemsomos.html`  | Hero, texto, valores, timeline (8 marcos)               |
| BanBan     | `banban.html`     | Hero, apresentação, 5 eventos, 3 diferenciais          |

**Assets:** ~49 imagens em `liderban /assets/images/` (~55 MB)

**Interatividade (`script.js`):**
- Header fixo com mudança de estilo no scroll
- Menu hamburger mobile
- Carrossel do hero (apenas home)
- Modais de soluções (apenas página Serviços)
- Animações Intersection Observer
- Botão "Saiba mais" → WhatsApp
- Ícone flutuante WhatsApp

### Tema WordPress atual

| Arquivo            | Estado                                                         |
|--------------------|----------------------------------------------------------------|
| `functions.php`    | Básico — sem JS, sem Google Fonts, menu desalinhado            |
| `header.php`       | Estrutura diferente do HTML (classes, menu, CTA extra)         |
| `footer.php`       | Rodapé minimalista, diferente do HTML                          |
| `index.php`        | Template genérico vazio                                        |
| `page-solucoes.php`| **Conteúdo diferente** do `solucoes.html` (design antigo)      |
| `style.css`        | ~570 linhas, paleta e layout diferentes do HTML                |

**Conclusão:** o tema WP precisa ser reconstruído usando o HTML como referência visual e estrutural.

---

## Arquitetura do tema

```
liderban-theme/
├── style.css                         # Metadados WP obrigatórios + @import do main.css
├── assets/
│   ├── css/
│   │   └── main.css                  # styles.css do HTML
│   ├── js/
│   │   └── main.js                   # script.js do HTML
│   └── images/                       # Cópia de liderban /assets/images/
├── inc/
│   ├── setup.php                     # Theme supports, menus
│   ├── enqueue.php                   # CSS, JS, Google Fonts
│   └── helpers.php                   # liderban_asset(), etc.
├── template-parts/
│   ├── header/
│   │   └── site-header.php
│   ├── footer/
│   │   └── site-footer.php
│   ├── floating/
│   │   └── whatsapp.php
│   └── hero/
│       ├── hero-carousel.php         # Home
│       └── hero-page.php             # Páginas internas
├── front-page.php                    # index.html
├── page-solucoes.php                 # solucoes.html (reescrever)
├── page-clientes.php                 # clientes.html
├── page-quem-somos.php               # quemsomos.html
├── page-banban.php                   # banban.html
├── header.php
├── footer.php
├── functions.php
└── index.php                         # Fallback
```

### Helper de assets (referência)

```php
function liderban_asset( $path ) {
    return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}
```

---

## Mapeamento de URLs

| HTML            | WordPress (slug) | Template              |
|-----------------|------------------|-----------------------|
| `index.html`    | `/`              | `front-page.php`      |
| `solucoes.html` | `/solucoes/`     | `page-solucoes.php`   |
| `clientes.html` | `/clientes/`     | `page-clientes.php`   |
| `quemsomos.html`| `/quem-somos/`   | `page-quem-somos.php` |
| `banban.html`   | `/banban/`       | `page-banban.php`     |

### Configuração WordPress (admin)

1. Criar páginas: Home, Serviços, Clientes, Quem Somos, BanBan
2. **Configurações → Leitura** → Página estática = Home
3. **Configurações → Permalinks** → Nomes de post (`/%postname%/`)
4. **Aparência → Menus** → Menu principal com: Serviços, Clientes, Quem Somos, BanBan

### Redirects 301 (produção)

```
/solucoes.html   → /solucoes/    301
/clientes.html   → /clientes/    301
/quemsomos.html  → /quem-somos/  301
/banban.html     → /banban/      301
/index.html      → /             301
```

---

## Decisões de projeto

| Decisão | Escolha | Motivo |
|---------|---------|--------|
| Design de referência | HTML (`liderban /`) | É o site aprovado pelo cliente |
| Tema WP atual | Substituir CSS e templates | Diverge do HTML |
| Conteúdo editável | Hardcoded nos templates (fase 1) | Paridade com HTML; ACF/Gutenberg fica para fase 2 |
| Page builders | Não usar | Tema customizado, sem Elementor/Divi |
| Menu | Serviços, Clientes, Quem Somos, BanBan | Igual ao HTML (sem CTA "Solicite Orçamento") |
| Pasta `liderban /` | Remover após migração validada | Evitar duplicação de assets |

---

## Fases e prompts

Use cada prompt abaixo em uma sessão separada do agente. Sempre referencie este documento e a pasta `liderban /` como fonte.

### Status das fases

| Fase | Status     | Notas |
|------|------------|-------|
| 0    | ✅ Concluída | Imagens via symlink (ver nota abaixo) |
| 1    | ✅ Concluída | Header, footer, WhatsApp, nav walker   |
| 2    | ✅ Concluída | front-page.php + template-parts home   |
| 3    | ✅ Concluída | page-solucoes.php, hero-page.php, modals.php |
| 4–7  | ⏳ Pendente  | — |

> **Nota Fase 0:** `assets/images` é um symlink para `liderban /assets/images` (evita duplicar ~55 MB). Na Fase 7, mover imagens para `assets/images/` físico e remover `liderban /`.

---

### Fase 0 — Preparação

**Objetivo:** Organizar assets, estrutura de pastas e configuração base do WordPress.

**Arquivos a criar/modificar:**
- `assets/css/main.css` (cópia de `liderban /styles.css`)
- `assets/js/main.js` (cópia de `liderban /script.js`)
- `assets/images/` (cópia de `liderban /assets/images/`)
- `inc/helpers.php`
- `inc/setup.php`
- `inc/enqueue.php`
- `functions.php` (refatorar para incluir `inc/`)

**Prompt:**

```
Execute a Fase 0 da migração Liderban HTML → WordPress conforme docs/migracao-html-wordpress.md.

Contexto:
- Tema: wp-content/themes/liderban-theme
- HTML de referência: liderban / (index.html, solucoes.html, clientes.html, quemsomos.html, banban.html)
- O HTML é a fonte da verdade visual

Tarefas:
1. Criar estrutura de pastas: assets/css, assets/js, assets/images, inc/, template-parts/
2. Copiar liderban /styles.css → assets/css/main.css
3. Copiar liderban /script.js → assets/js/main.js
4. Copiar liderban /assets/images/ → assets/images/
5. Criar inc/helpers.php com função liderban_asset($path)
6. Criar inc/setup.php (title-tag, post-thumbnails, html5, menu 'primary')
7. Criar inc/enqueue.php (Google Fonts Poppins, main.css, main.js com filemtime para cache bust)
8. Refatorar functions.php para require dos arquivos inc/
9. Atualizar style.css do tema: manter cabeçalho WP obrigatório e importar assets/css/main.css
10. Documentar no README ou comentário quais páginas criar no admin WP (Home, Serviços/solucoes, Clientes, Quem Somos, BanBan)

Não migrar templates de página ainda. Não remover a pasta liderban / ainda.
Ao final, liste o que foi criado e o que falta configurar manualmente no admin WordPress.
```

---

### Fase 1 — Fundação (Header, Footer, Functions)

**Objetivo:** Header, footer e partes reutilizáveis idênticos ao HTML.

**Arquivos a criar/modificar:**
- `header.php`
- `footer.php`
- `template-parts/floating/whatsapp.php`
- `inc/setup.php` (fallback de menu)
- `index.php` (mínimo funcional)

**Prompt:**

```
Execute a Fase 1 da migração Liderban HTML → WordPress conforme docs/migracao-html-wordpress.md.

Pré-requisito: Fase 0 concluída (assets e inc/ existem).

Tarefas:
1. Reescrever header.php espelhando liderban /index.html:
   - <header class="header" id="header">
   - Logo "LIDERBAN." linkando para home_url('/')
   - Botão .menu-toggle com 3 spans e aria-label
   - Nav .nav com wp_nav_menu (theme_location: primary)
   - Fallback do menu com links: Serviços (/solucoes/), Clientes (/clientes/), Quem Somos (/quem-somos/), BanBan (/banban/)
   - Usar wp_head() e language_attributes()
   - NÃO incluir CTA "Solicite Orçamento" (não existe no HTML)

2. Reescrever footer.php espelhando liderban /index.html:
   - <footer class="footer solutions-footer" id="contato">
   - Nav footer com 5 links: Home, Serviços, Clientes, Quem somos, BanBan
   - Bloco "Fale conosco" com telefone (31) 2536-7500 e horário
   - Copyright com ano dinâmico
   - wp_footer() antes de </body>

3. Criar template-parts/floating/whatsapp.php com o ícone SVG do WhatsApp (wa.me/553125367500)

4. Garantir que header.php e footer.php usem get_template_part() para o whatsapp flutuante

5. Atualizar index.php como fallback simples (get_header, main vazio, get_footer)

Critério de aceite:
- Header e footer renderizam com as classes CSS do HTML
- Menu fallback funciona sem menu configurado no admin
- WhatsApp flutuante aparece em todas as páginas
- Nenhuma regressão nos assets enfileirados da Fase 0
```

---

### Fase 2 — Página Home

**Objetivo:** `front-page.php` com paridade visual total com `index.html`.

**Arquivos a criar:**
- `front-page.php`
- `template-parts/hero/hero-carousel.php`
- `template-parts/home/water-section.php` (opcional)
- `template-parts/home/atuacao-section.php` (opcional)
- `template-parts/home/solucoes-preview.php` (opcional)
- `template-parts/home/servicos-cards.php` (opcional)

**Prompt:**

```
Execute a Fase 2 da migração Liderban HTML → WordPress conforme docs/migracao-html-wordpress.md.

Pré-requisito: Fases 0 e 1 concluídas.

Tarefas:
1. Criar front-page.php convertendo TODO o conteúdo de liderban /index.html (entre header e footer)

2. Seções obrigatórias:
   - Hero carousel: 3 slides (bg1.png, bg2.png, bg3.png) + overlay + título + subtítulo + indicadores
   - Seção "A água está no centro de tudo" (.water-section) com img.svg
   - Seção "Atuação da Liderban" (.atuacao-section) com wave2.svg e img.jpg
   - Seção "Soluções" (.solucoes-section) com img1.png e img2.png
   - Seção cards de serviços (.servicos-section): 4 cards + botão #solicite-mais "Saiba mais"

3. Substituir TODOS os paths de imagem por liderban_asset('images/...')
4. Usar esc_url(), esc_attr(), esc_html() onde aplicável
5. Manter IDs e classes CSS idênticos ao HTML (hero, hero-slide, indicator, servico-card, etc.)
6. Botão "Saiba mais" deve manter id="solicite-mais" para o JS funcionar

7. Adicionar meta description da home via hook em inc/setup.php ou inc/enqueue.php:
   "Liderban - Soluções de saneamento móvel e gestão de resíduos..."

Critério de aceite:
- front-page.php é pixel-par com index.html
- Carrossel do hero funciona (slides, indicadores, auto-play 5s)
- Animações de scroll funcionam na home
- Botão "Saiba mais" abre WhatsApp
- Imagens carregam via liderban_asset()
```

---

### Fase 3 — Página Serviços

**Objetivo:** Substituir `page-solucoes.php` pelo conteúdo de `solucoes.html`.

**Arquivos a criar/modificar:**
- `page-solucoes.php` (reescrever completamente)
- `template-parts/solucoes/modals.php`
- `template-parts/hero/hero-page.php` (reutilizável)

**Prompt:**

```
Execute a Fase 3 da migração Liderban HTML → WordPress conforme docs/migracao-html-wordpress.md.

Pré-requisito: Fases 0, 1 e 2 concluídas.

Tarefas:
1. APAGAR o conteúdo atual de page-solucoes.php (design antigo) e reescrever baseado em liderban /solucoes.html

2. Criar template-parts/hero/hero-page.php reutilizável:
   - Parâmetros: $bg_image (nome do arquivo), alt opcional
   - Estrutura: .solutions-hero > .solutions-hero-bg + overlay + .wave-bottom

3. Conteúdo da página:
   - Hero com background solutions_bg.png
   - Seção .solutions-cards-section com 4 .solution-card[data-modal]
   - 4 modais em template-parts/solucoes/modals.php:
     * modal-banheiros, modal-estruturas, modal-transporte, modal-saneamento
   - Cada modal com ícone, título, subtítulo, lista e botão WhatsApp com texto personalizado

4. Template Name: Serviços | Template Post Type: page

5. Substituir paths por liderban_asset()
6. Manter data-modal, IDs dos modais e classes para o JS funcionar

Critério de aceite:
- Página idêntica a solucoes.html
- Clique nos cards abre modais corretos
- Fechar modal: X, clique fora, tecla ESC
- Links WhatsApp dos modais funcionam
- Hero reutilizável criado para as próximas fases
```

---

### Fase 4a — Página Clientes

**Objetivo:** `page-clientes.php` com grid de parceiros.

**Prompt:**

```
Execute a Fase 4a da migração Liderban HTML → WordPress conforme docs/migracao-html-wordpress.md.

Pré-requisito: Fases 0–3 concluídas (hero-page.php existe).

Tarefas:
1. Criar page-clientes.php baseado em liderban /clientes.html
2. Usar template-parts/hero/hero-page.php com background clientes_bg.png
3. Seção .clientes-section com título "Clientes" e grid .partners-grid-4
4. Definir array PHP $partners com todos os 13 parceiros:
   - img, alt, class (partner-card-large, partner-card-small, partner-card-xlarge, partner-card-center)
   - Parceiros: Vale, Patrol, MIP, Metso, Mineirão, Cardan, Geosol, Anglo American, Geocontrole, Milplan, Arena MRV, Itaminas, SCL
5. Loop PHP para renderizar .partner-card
6. Template Name: Clientes

Critério de aceite:
- Grid de 13 logos com classes corretas
- Animações de scroll nos partner-cards funcionam
- Paridade visual com clientes.html
```

---

### Fase 4b — Página Quem Somos

**Objetivo:** `page-quem-somos.php` com timeline e valores.

**Prompt:**

```
Execute a Fase 4b da migração Liderban HTML → WordPress conforme docs/migracao-html-wordpress.md.

Pré-requisito: Fases 0–3 e 4a concluídas.

Tarefas:
1. Criar page-quem-somos.php baseado em liderban /quemsomos.html
2. Hero com background quemsomos_bg.png
3. Seção .quemsomos-section: texto (3 parágrafos) + imagem quemsomos_img.jpg
4. Seção .valores-section: 7 badges em 2 grids (.valor-badge)
5. Seção .timeline-section: 8 entradas da timeline
   - Array PHP: year, text, side ('left'|'right')
   - Anos: 1997, 2004, 2012, 2014, 2019, 2021, 2024, 2026
   - Classes: timeline-entry-left / timeline-entry-right
6. Template Name: Quem Somos | slug esperado: quem-somos

Critério de aceite:
- Timeline alternada left/right idêntica ao HTML
- Badges de valores com quebra de linha em "Responsabilidade social e ambiental"
- Paridade visual com quemsomos.html
```

---

### Fase 4c — Página BanBan

**Objetivo:** `page-banban.php` com eventos e diferenciais.

**Prompt:**

```
Execute a Fase 4c da migração Liderban HTML → WordPress conforme docs/migracao-html-wordpress.md.

Pré-requisito: Fases 0–3 e 4a–4b concluídas.

Tarefas:
1. Criar page-banban.php baseado em liderban /banban.html
2. Hero com background banban_bg.png
3. Seção .banban-section: imagem banban.png + texto (título "banban.", subtítulo, 2 parágrafos)
4. Seção .eventos-section: card com título, descrição, label "Eventos atendidos:" e grid de 5 eventos
   - Array PHP: img (banban1-5.png), nome (Carnaval de BH, O Embaixador, Numanice, Ensaios da Anitta, Sensacional)
5. Seção .diferenciais-section: 3 cards (Sustentabilidade, Segurança, Gestão digital)
6. Template Name: BanBan | slug: banban

Critério de aceite:
- Paridade visual com banban.html
- Grid de eventos com imagens e nomes corretos
- 3 cards de diferenciais renderizados
```

---

### Fase 5 — JavaScript e interatividade

**Objetivo:** Garantir que toda interatividade do HTML funcione no WordPress.

**Prompt:**

```
Execute a Fase 5 da migração Liderban HTML → WordPress conforme docs/migracao-html-wordpress.md.

Pré-requisito: Fases 0–4c concluídas (todas as páginas existem).

Tarefas:
1. Verificar enqueue de assets/js/main.js no footer (in_footer: true)
2. Testar seletores JS em cada página:
   - Todas: #header scroll, .menu-toggle, .nav
   - Home: .hero-slide, .indicator, .water-illustration, #solicite-mais
   - Serviços: .solution-card[data-modal], .solucao-modal-overlay
   - Clientes: .partner-card (animações)
   - Quem Somos / BanBan: animações genéricas
3. Corrigir qualquer seletor quebrado por diferença de HTML gerado
4. (Opcional) Condicionar scripts pesados por página com is_front_page(), is_page('solucoes')
5. Garantir que menu mobile fecha ao clicar link e ao clicar fora

Critério de aceite:
- Carrossel home: auto-play, indicadores, pause on hover
- Modais serviços: abrir, fechar (X, overlay, ESC)
- Header: transparente → branco no scroll
- Menu hamburger funciona em mobile
- Sem erros no console do navegador
```

---

### Fase 6 — SEO, acessibilidade e performance

**Objetivo:** Meta tags, favicon, otimização de imagens.

**Prompt:**

```
Execute a Fase 6 da migração Liderban HTML → WordPress conforme docs/migracao-html-wordpress.md.

Pré-requisito: Fases 0–5 concluídas.

Tarefas:
1. Favicon: enfileirar assets/images/logo.png via wp_head ou site_icon
2. Meta description por página (hook wp_head ou filtro document_title_parts):
   - Home: description do index.html
   - Demais: descriptions curtas baseadas no conteúdo
3. Adicionar loading="lazy" em imagens abaixo da dobra (não no hero)
4. Identificar imagens > 1MB e documentar/comprimir:
   - banban_bg.jpeg (30MB!), bg1-3.png, banban1-5.png, design.png
5. Manter alt text de todas as imagens (já no HTML)
6. Verificar contraste e aria-labels (menu-toggle, whatsapp)

Critério de aceite:
- Favicon visível na aba do navegador
- Meta description na home
- Imagens críticas comprimidas ou convertidas para WebP
- Lighthouse performance melhor que baseline (documentar scores)
```

---

### Fase 7 — QA final e limpeza

**Objetivo:** Validação completa e remoção de arquivos temporários.

**Prompt:**

```
Execute a Fase 7 da migração Liderban HTML → WordPress conforme docs/migracao-html-wordpress.md.

Pré-requisito: Fases 0–6 concluídas.

Tarefas:
1. Percorrer checklist de QA deste documento (seção abaixo) em desktop e mobile
2. Comparar visualmente cada página WP com seu HTML correspondente
3. Verificar todos os links do menu e footer
4. Verificar WhatsApp em modais e botão "Saiba mais"
5. Configurar redirects 301 (documentar regras para .htaccess ou plugin Redirection)
6. Remover ou mover pasta liderban / para fora do tema (ex: _reference/liderban-html/)
7. Remover page-solucoes.php antigo se ainda houver código residual
8. Atualizar este documento marcando fases como concluídas

Critério de aceite:
- Todas as linhas do checklist QA marcadas como OK
- Pasta liderban / removida do tema
- Documento de redirects pronto para deploy
- Nenhum 404 nos links internos
```

---

## Checklist de QA

### Visual (comparar HTML vs WordPress)

| Página     | Desktop | Mobile (≤768px) | Menu | JS específico      |
|------------|---------|-----------------|------|--------------------|
| Home       | ☐       | ☐               | ☐    | Carrossel ☐        |
| Serviços   | ☐       | ☐               | ☐    | Modais ☐           |
| Clientes   | ☐       | ☐               | ☐    | Animações ☐        |
| Quem Somos | ☐       | ☐               | ☐    | Timeline ☐         |
| BanBan     | ☐       | ☐               | ☐    | —                  |

### Funcional

- [ ] Links do menu: Serviços, Clientes, Quem Somos, BanBan
- [ ] Links do footer: Home, Serviços, Clientes, Quem somos, BanBan
- [ ] WhatsApp flutuante: `wa.me/553125367500`
- [ ] Modais Serviços: 4 CTAs WhatsApp com mensagens distintas
- [ ] Botão "Saiba mais" na home abre WhatsApp
- [ ] Header transparente → branco após scroll
- [ ] Menu hamburger abre/fecha corretamente
- [ ] Permalinks sem `.html`
- [ ] Favicon carrega
- [ ] Sem erros no console do navegador
- [ ] `wp_head()` e `wp_footer()` presentes

### WordPress Admin

- [ ] Tema Liderban ativo
- [ ] Página estática = Home
- [ ] Permalinks = Nomes de post
- [ ] Menu principal configurado
- [ ] Cada página usa o template correto

---

## Estimativa de esforço

| Fase   | Descrição              | Tempo     |
|--------|------------------------|-----------|
| 0      | Preparação             | 30 min    |
| 1      | Header/Footer          | 1–2 h     |
| 2      | Home                   | 2–3 h     |
| 3      | Serviços               | 2 h       |
| 4a–4c  | Clientes, Quem Somos, BanBan | 3–4 h |
| 5      | JavaScript             | 1 h       |
| 6      | SEO/Performance        | 1–2 h     |
| 7      | QA e limpeza           | 2 h       |
| **Total** |                    | **12–16 h** |

---

## Ordem de execução

```
Fase 0 → Fase 1 → Fase 2 → Fase 3 → Fase 4a → Fase 4b → Fase 4c → Fase 5 → Fase 6 → Fase 7
```

Cada fase deve ser validada antes de iniciar a próxima.

---

## Plugins recomendados (produção)

| Plugin        | Uso                                      |
|---------------|------------------------------------------|
| Redirection   | Redirects 301 de URLs `.html`            |
| Yoast SEO     | Meta tags avançadas (opcional)           |
| WP Super Cache| Cache em produção (opcional)             |

---

## Fase 2+ (futuro, fora do escopo atual)

- Campos editáveis via ACF (timeline, parceiros, modais)
- Blocos Gutenberg customizados
- Formulário de contato (substituir só WhatsApp)
- Páginas extras: Onde Estamos, LB News, Contato (se solicitadas)
