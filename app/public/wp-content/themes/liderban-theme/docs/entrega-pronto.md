# Liderban — Entrega de Desenvolvimento

> **Status:** site funcional no ambiente local, pronto para migração à produção.  
> **Data:** 08/07/2026  
> **Escopo:** tema `liderban-theme` + plugin Instagram + CPT Na mídia

---

## Pronto

Itens concluídos no código e validados tecnicamente:

### QA nas páginas principais + template 404

| Página / tela | Template | Status |
|---------------|----------|--------|
| Home | `front-page.php` | ✅ |
| Serviços | `page-solucoes.php` | ✅ |
| Quem Somos | `page-quem-somos.php` | ✅ |
| BanBan | `page-banban.php` | ✅ |
| Blog (listagem) | `home.php` / `page-blog.php` | ✅ |
| Blog (detalhe) | `single.php` | ✅ |
| Busca | `search.php` | ✅ |
| Na mídia (arquivo) | `archive-liderban_imprensa.php` | ✅ |
| 404 | `404.php` | ✅ |

**O que foi verificado no código:**

- Header e footer presentes em todos os templates (`get_header()` / `get_footer()`)
- `wp_head()` e `wp_footer()` no layout base
- Menu principal com fallback (Serviços, Quem Somos, Blog, BanBan)
- Clientes exibidos na **seção `#clientes` da Home** (não há página separada; `/clientes/` redireciona para `/#clientes`)
- WhatsApp flutuante e CTAs apontando para `wa.me/553125367500`
- Header sólido na 404 (`.header--solid`) + links rápidos para páginas principais
- Blog: filtros, paginação, post destaque, relacionados e compartilhamento
- CPT **Na mídia** editável no admin com matérias seed de exemplo

**Confirmação visual recomendada (você):** abrir cada URL no navegador local e validar desktop + mobile (≤768px).

---

### SEO no tema

Implementado em `inc/seo.php` — **sem plugin obrigatório**.

| Recurso | Cobertura |
|---------|-----------|
| Meta description | Home, Serviços, Quem Somos, BanBan, Blog, Na mídia, posts, busca, 404 |
| Canonical URL | Todas as telas acima |
| Open Graph | `og:title`, `og:description`, `og:url`, `og:image`, `og:type`, `og:locale`, `og:site_name` |
| Twitter Cards | `summary_large_image` com título, descrição e imagem |
| JSON-LD | `Organization`, `WebSite` (+ `SearchAction`), `Article` em posts do blog |
| Título do documento | Ajustado via `document_title_parts` |

Imagens sociais por página usam os backgrounds do tema (ex.: `bg1.jpg` na home, `solutions_bg.jpg` em Serviços).

> **Opcional em produção:** instalar Rank Math ou Yoast para metas editáveis pelo admin. O tema já funciona de forma autônoma.

---

### Otimização de imagens

Arquivos **efetivamente usados** pelo site foram comprimidos. Arquivos legados não referenciados (ex.: `design.png` 5,2 MB) permanecem na pasta de referência e **não são carregados** nas páginas.

| Arquivo | Antes | Depois | Redução |
|---------|-------|--------|---------|
| `banban_bg.png` | ~241 KB | ~60 KB | **~75%** |
| `solutions_img1.png` | ~374 KB | ~166 KB | **~56%** |
| `solutions_img2.png` | ~287 KB | ~125 KB | **~56%** |
| `solutions_img3.png` | ~403 KB | ~239 KB | **~40%** |
| `solutions_img4.png` | ~437 KB | ~211 KB | **~52%** |
| `banban_bg.jpeg` | ~288 KB | ~196 KB | **~32%** |
| `img.jpg` | ~309 KB | ~201 KB | **~35%** |
| `quemsomos_img.jpg` | ~210 KB | ~135 KB | **~36%** |
| Backgrounds JPG (bg1–3, solutions, quemsomos, clientes) | ~460 KB total | ~302 KB total | **~34%** |

**Total das imagens em uso:** ~1,3 MB (adequado para hospedagem com ~100 MB+ de espaço para mídia).

> O arquivo `banban_bg.jpeg` original chegou a **~5 MB** em versões anteriores do projeto — redução acumulada de **~96%** nesse asset.

---

## Pendências — Liderban

Estas tarefas dependem do **cliente** ou de **configuração em produção**:

| Item | Responsável | Observação |
|------|-------------|------------|
| Plugin Instagram (token/credenciais Meta) | Cliente | Plugin `liderban-instagram-feed` instalado; feed real exige App ID + token de longa duração |
| Liderban na mídia (links reais) | Cliente | Substituir links `#` das matérias seed por URLs reais das publicações |
| Posts do blog | Cliente | Publicar notícias definitivas com imagem destacada e resumo |
| Search Console / Analytics | Serviço à parte | Configurar após domínio em produção com HTTPS |
| Hospedagem + domínio | Cliente | Ver seção abaixo |
| Validação visual final | Cliente | Aprovar layout em desktop e mobile antes do go-live |

---

## Hospedagem

**Provedores sugeridos:** Hostinger ou HostGator.

**Requisitos mínimos do plano:**

- SSL gratuito (HTTPS)
- Backup automático
- Suporte a WordPress (PHP 8.x + MySQL/MariaDB)
- Espaço suficiente para mídia (**~100 MB+** de imagens; o tema usa ~1,3 MB; posts e uploads precisam de margem)

**Apontar o domínio**

1. Contratar hospedagem e anotar os **nameservers** ou o **IP** fornecidos
2. No painel onde o domínio foi registrado (Registro.br, GoDaddy, etc.):
   - Atualizar DNS para os nameservers da hospedagem **ou**
   - Criar registro **A** apontando `@` e `www` para o IP do servidor
3. Aguardar propagação (24–48 h)
4. Ativar SSL na hospedagem (Let's Encrypt)
5. Migrar o site do Local WP (plugin **All-in-One WP Migration** ou similar)
6. Atualizar URLs de `local` para o domínio final

---

## Como editar

Todas as páginas principais do site podem ser editadas pelo admin do WordPress, sem precisar de plugins extras.

### Páginas do site (textos e imagens)

1. No admin: **Páginas →** selecione a página desejada
2. Role até o bloco **Conteúdo da página (Liderban)**
3. Edite os campos por seção (banner, textos, cards, imagens etc.)
4. Para trocar uma imagem: clique em **Selecionar imagem** (abre a biblioteca de mídia)
5. Clique em **Atualizar** para salvar

| Página | Onde editar |
|--------|-------------|
| Home | Páginas → Home (página inicial estática) |
| Serviços | Páginas → Serviços |
| Quem Somos | Páginas → Quem Somos |
| BanBan | Páginas → BanBan |
| Blog (banner e seções fixas) | Páginas → Blog |

> **Importante:** o conteúdo **não** fica no editor de blocos (área em branco no topo). Ele aparece no painel **"Conteúdo da página (Liderban)"** — o tema usa o editor clássico automaticamente nessas páginas.

> **Dica:** campos vazios mantêm o conteúdo padrão do tema. Para voltar ao original, apague o texto ou clique em **Remover** na imagem.

### Configurações globais

**Configurações → Conteúdo Liderban**

- Telefone e horário do rodapé
- Número do WhatsApp (usado em todos os botões)
- Textos da página 404

---

### Liderban na mídia

1. No admin: **Na mídia → Adicionar matéria** (ou editar uma existente)
2. Preencher:
   - **Título** — manchete da matéria
   - **Data** — data de publicação (define a ordem nos cards)
   - **Veículo / fonte** — ex.: Folha de S.Paulo
   - **Sigla do veículo** — ex.: FSP (aparece no ícone; se vazio, é gerada automaticamente)
   - **Link da matéria** — URL completa da publicação (`https://...`)
3. Clicar em **Publicar**

As matérias aparecem na seção **Liderban na mídia** do Blog e no arquivo `/imprensa/`.

> **Importante:** as matérias seed usam link `#`. Edite cada uma e substitua pelo link real da matéria.

---

### Blog

1. No admin: **Posts → Adicionar novo**
2. Preencher:
   - **Título** — título da notícia
   - **Conteúdo** — texto completo (suporta imagens, listas, links)
   - **Resumo** — texto curto de preview (campo *Resumo* / excerpt; aparece nos cards)
   - **Imagem destacada** — obrigatória para boa apresentação
   - **Categorias** — ex.: Novidades, Eventos, Institucional
3. (Opcional) Marcar como **Fixo** (*Post fixo*) para aparecer no destaque da listagem
4. Clicar em **Publicar**

**Configurações necessárias (uma vez):**

| Onde | O que configurar |
|------|------------------|
| Configurações → Leitura | Página inicial = **Home**; Página de posts = **Blog** |
| Configurações → Links permanentes | Estrutura: **Nome do post** |
| Posts → Categorias | Criar Novidades, Eventos, Institucional |

**URLs:**

- Listagem: `/blog/`
- Post individual: `/blog/nome-do-post/`
- Busca: ícone de lupa no header

---

## Checklist rápido antes do go-live

### Desenvolvimento (pronto)
- [x] Páginas principais implementadas
- [x] Template 404 com navegação
- [x] SEO (meta, OG, Twitter, JSON-LD)
- [x] Imagens do tema otimizadas
- [x] CPT Na mídia editável
- [x] Todas as páginas editáveis (textos e imagens via admin)
- [x] Plugin Instagram (estrutura; aguarda token)

### Cliente / produção (pendente)
- [ ] Contratar hospedagem + apontar domínio
- [ ] Migrar site do Local para produção
- [ ] Ativar HTTPS
- [ ] Publicar posts reais no blog
- [ ] Atualizar links reais em Na mídia
- [ ] Configurar token Instagram (opcional)
- [ ] Search Console + Analytics
- [ ] Backup automático confirmado no plano

---

## Referências técnicas

| Documento | Conteúdo |
|-----------|----------|
| `docs/configuracao-wordpress.md` | Setup inicial do admin |
| `docs/planejamento-publicacao.md` | Plano completo de migração |
| `docs/blog-desenvolvimento.md` | Detalhes técnicos do blog |
| `docs/migracao-html-wordpress.md` | Migração HTML → WordPress |
