# Guia de Deploy - Liderban

## 🚀 Deploy no Netlify

### Opção 1: Deploy via Interface Web (Mais Fácil)

1. **Acesse o Netlify**
   - Vá para [netlify.com](https://www.netlify.com)
   - Faça login ou crie uma conta gratuita

2. **Faça o Deploy**
   - Arraste e solte a pasta do projeto na área de deploy do Netlify
   - OU clique em "Add new site" > "Deploy manually" > escolha a pasta
   - O site estará no ar em segundos!

3. **URL Temporária**
   - Você receberá uma URL tipo: `seu-site-aleatorio.netlify.app`
   - Esta URL já funciona e pode ser compartilhada

### Opção 2: Deploy via Git (Recomendado para atualizações)

1. **Crie um repositório Git**
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   ```

2. **Envie para GitHub/GitLab/Bitbucket**
   - Crie um repositório no GitHub
   - Conecte e faça push:
   ```bash
   git remote add origin https://github.com/seu-usuario/liderban.git
   git push -u origin main
   ```

3. **Conecte no Netlify**
   - No Netlify: "Add new site" > "Import an existing project"
   - Escolha seu repositório Git
   - Configure:
     - Build command: (deixe vazio - site estático)
     - Publish directory: `.` (ponto)
   - Clique em "Deploy site"

## 🌐 Configurar Domínio Personalizado

### Quando você tiver acesso ao domínio:

1. **No Netlify Dashboard**
   - Vá em: Site settings > Domain management
   - Clique em "Add custom domain"
   - Digite o domínio (ex: `liderban.com.br`)

2. **Configurar DNS**
   
   **Opção A: Usar DNS do Netlify (Mais Fácil)**
   - No Netlify, vá em: Domain settings > DNS
   - Adicione os registros DNS que o Netlify fornecer
   - No seu provedor de domínio, altere os nameservers para os do Netlify
   
   **Opção B: Configurar DNS Manualmente**
   - No Netlify, você receberá um registro A ou CNAME
   - No seu provedor de domínio (Registro.br, GoDaddy, etc.):
     - Adicione um registro A apontando para o IP do Netlify
     - OU adicione um registro CNAME apontando para `seu-site.netlify.app`
   
   **Exemplo de configuração:**
   ```
   Tipo: A
   Nome: @ (ou deixe em branco)
   Valor: 75.2.60.5
   
   Tipo: CNAME
   Nome: www
   Valor: seu-site.netlify.app
   ```

3. **Aguardar Propagação**
   - Pode levar de alguns minutos até 48 horas
   - Geralmente funciona em 1-2 horas

4. **SSL Automático**
   - O Netlify fornece certificado SSL gratuito automaticamente
   - Seu site terá HTTPS sem configuração adicional!

## 📋 Checklist para Configuração de Domínio

- [ ] Ter acesso ao painel do registro de domínio
- [ ] Adicionar domínio no Netlify
- [ ] Configurar registros DNS (A ou CNAME)
- [ ] Aguardar propagação DNS
- [ ] Verificar SSL ativado automaticamente
- [ ] Testar acesso via domínio personalizado

## 🔧 Configurações Importantes

### Arquivo `netlify.toml`
Já está criado com configurações básicas de segurança e redirecionamento.

### Variáveis de Ambiente (se necessário)
Se precisar adicionar variáveis:
- Site settings > Environment variables
- Adicione chave-valor conforme necessário

## 🆘 Problemas Comuns

**Domínio não está funcionando?**
- Verifique se os registros DNS estão corretos
- Use ferramentas como `nslookup` ou `dig` para verificar
- Aguarde mais tempo para propagação

**Site não atualiza?**
- Se usar Git: faça commit e push novamente
- Se usar drag-and-drop: faça upload novamente
- Limpe o cache do navegador (Ctrl+Shift+R)

**Erro 404 em páginas?**
- Verifique se todos os arquivos HTML estão na raiz
- Confirme que os links estão corretos

## 📞 Suporte

- Documentação Netlify: [docs.netlify.com](https://docs.netlify.com)
- Suporte Netlify: [netlify.com/support](https://www.netlify.com/support)
