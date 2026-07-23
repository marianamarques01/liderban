# Configuração manual do WordPress — Liderban

Após ativar o tema **Liderban Theme**, configure o admin conforme abaixo.

## 1. Criar páginas

| Título       | Slug          | Template (quando disponível) |
|--------------|---------------|------------------------------|
| Home         | `home`        | — (será página estática)     |
| Serviços     | `solucoes`    | Serviços                     |
| Clientes     | `clientes`    | Clientes                     |
| Quem Somos   | `quem-somos`  | Quem Somos                   |
| BanBan       | `banban`      | BanBan                       |
| Blog         | `blog`        | — (será página de posts)     |

## 2. Página inicial e blog

**Configurações → Leitura**

- Selecione **Uma página estática**
- Página inicial: **Home**
- Página de posts: **Blog**

> Sem a página de posts configurada, `/blog/` não listará os posts do tema.

## 3. Categorias do blog

**Posts → Categorias**

Criar categorias iniciais (ajustar conforme necessidade):

| Nome           | Slug           |
|----------------|----------------|
| Novidades      | `novidades`    |
| Eventos        | `eventos`      |
| Institucional  | `institucional`|

## 4. Posts de exemplo

**Posts → Adicionar novo**

Publicar pelo menos 1 post para testes:

| Campo            | Valor sugerido |
|------------------|----------------|
| Título           | Título         |
| Resumo (excerpt) | Texto curto de preview |
| Categoria        | Novidades      |
| Imagem destacada | Obrigatória    |
| Post fixo        | Marcar 1 post como fixo (aparece no destaque da listagem) |

## 5. Permalinks

**Configurações → Links permanentes**

- Estrutura: **Nome do post** (`/%postname%/`)

## 6. Menu principal

**Aparência → Menus**

1. Criar menu **Menu Principal**
2. Adicionar páginas: Serviços, Clientes, Quem Somos, **Blog**, BanBan
3. Atribuir à localização **Menu principal**

Ordem e rótulos (igual ao HTML + blog):

1. Serviços → `/solucoes/`
2. Clientes → `/clientes/`
3. Quem Somos → `/quem-somos/`
4. Blog → `/blog/`
5. BanBan → `/banban/`

> Se o menu não for configurado, o tema exibe um fallback com os mesmos links (inclui Blog).

## 7. Ativar tema

**Aparência → Temas** → Ativar **Liderban Theme**
