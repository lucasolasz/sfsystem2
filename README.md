## Projeto base PHP 7 e MVC

Aplicação base para montagem de aplicações PHP.
Já realiza login em hash.

## Configurações necessárias

Ajustar o app/config/configuracao.php com os seguintes dados:

```php
// 1- Conexão com o banco

define('DB_HOST', 'meu_host');
define('DB_USER', 'meu_user');
define('DB_PASS', 'meu_pass');
define('DB_NAME', 'meu_db');
define('DB_PORT', '3306'); //Porta padrão MySQL

// 2 - Url do Projeto
define('URL','http://meu_host/projetoBaseMVC');
```

Ajustar o path do .htaccess na pasta public, caso necessário: 

```php
<ifModule mod_rewrite.c>
Options -Multiviews
RewriteEngine On
RewriteBase /projetoBaseMVC/Public         <==========
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
</ifModule>
```

## Base de dados

Para a criação da base dados é necessário executar os scripts que estão localizados no diretório /BaseDados

## Tencologias

- PHP 7.4
- MySQL 
- Bootstrap 5.1
- Bootstrap Icons 1.8
- Jquery 3.6

## Login ADM

```
Email: admin@app.com
Senha: app@admin
```

## Créditos

Micro framework - Ronaldo Aires

https://youtube.com/playlist?list=PL0N5TAOhX5E-NZ0RRHa2tet6NCf9-7B5G
