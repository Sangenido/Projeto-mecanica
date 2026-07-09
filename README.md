# Box 377 Oficina 🔧

Site institucional com painel administrativo completo, desenvolvido como trabalho final da disciplina de **Programação para Web** (Tecnólogo em Análise e Desenvolvimento de Sistemas — UniSenac RS).

Projeto baseado em um cenário real: será implementado na oficina mecânica Box 377, em Porto Alegre/RS ([@oficina_box377](https://www.instagram.com/oficina_box377)).

## Tecnologias

- **PHP 8** (sem frameworks)
- **MySQL** (via mysqli)
- **HTML5 / CSS3** (responsivo, sem bibliotecas externas)
- **XAMPP** como ambiente de desenvolvimento

## Funcionalidades

### Site público
- 6 páginas: Home, Serviços, Sobre, Contato, Agendamento e Depoimentos
- Layout modular com `require` (head, header e footer compartilhados)
- Serviços e depoimentos carregados dinamicamente do banco de dados
- Formulário de contato que grava as mensagens no banco

### Painel administrativo
- Login com senha criptografada (`password_hash` / `password_verify`)
- Acesso protegido por sessão — páginas do painel redirecionam para o login se não autenticado
- CRUD completo de usuários com upload de foto (validação de tamanho, extensão e tipo MIME)
- Gerenciamento de serviços e depoimentos exibidos no site
- Caixa de entrada das mensagens do formulário, com status lida/não lida

### Segurança aplicada
- Senhas com hash bcrypt (nunca em texto puro)
- `mysqli_real_escape_string` em entradas de texto (proteção contra SQL Injection)
- Cast `(int)` em IDs recebidos via URL
- `htmlspecialchars` em toda exibição de dados (proteção contra XSS)
- Bloqueio de exclusão da própria conta logada

## Como rodar

1. Clone o repositório dentro do `htdocs` do XAMPP:
   ```bash
   git clone https://github.com/Sangenido/Projeto-mecanica.git
   ```
2. Inicie **Apache** e **MySQL** no XAMPP Control Panel
3. No phpMyAdmin, importe o arquivo `banco.sql` (cria o banco `bd_mecanica` com dados iniciais)
4. Acesse `http://localhost/Projeto-mecanica/`

### Acesso ao painel

O link **"Área restrita"** fica no rodapé do site.

| Campo  | Valor                        |
|--------|------------------------------|
| E-mail | admin@box377oficina.com.br   |
| Senha  | admin123                     |

## Estrutura do projeto

```
├── includes/          # head, header, footer e conexão com o banco
├── admin/             # painel administrativo (protegido por sessão)
├── resources/css/     # estilos e imagens do site
├── css/               # estilos do login e do painel
├── uploads/           # fotos dos usuários (geradas em runtime)
└── banco.sql          # estrutura e dados iniciais do banco
```

## Autor

**Lucas Rodrigues Sangenido**
[GitHub](https://github.com/Sangenido) · [LinkedIn](https://www.linkedin.com/in/lucas-rodrigues-sangenido-138b19318)
