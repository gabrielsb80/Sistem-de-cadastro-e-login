# Sistema de Cadastro e Login

Um sistema web com sessão,HTML,CSS(Bootstrap),guardando os cadastros do usuários no banco de dados MYSQL através do PDO e PHP orientado a objetos e realizando login de usuários para acessar um painel onde o usuário poderá visualizar algumas informações cadastrada e também poderá editar essas informações.

### Tecnologias utilizadas

- HTML
- Bootstrap
- PHP
- MYSQL

### Configuração

As credenciais do banco de dados estão no arquivo `./app/Db/Database.php` e você deve alterar para as configurações do seu ambiente (HOST, NAME, USER e PASS).

### Composer

Para a aplicação funcionar, é necessário rodar o Composer para que sejam criados os arquivos responsáveis pelo autoload das classes.

Para rodar o composer, basta acessar a pasta do projeto e executar o comando abaixo em seu terminal:

```
composer install
```

Após essa execução uma pasta com o nome vendor será criada na raiz do projeto e você já poderá acessar pelo seu navegador.
