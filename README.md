# Teste Ateliware

### Instruções

Para rodar o projeto é preciso ter instalado os seguintes itens:

- Composer
- PHP >=7.2
- Mysql

Para Configurar o projeto, é necessário rodar os seguintes comandos

`` cp .env.example .env``<br>
``composer install``<br>
``php artisan key:generate``<br>

Altere as linhas ``13`` e ``14`` do arquivo .env para configurar o banco de dados
<br>

Rode o seguinte comando para gerar as tabelas<br>
``php artisan migrate``

Pronto! Agora é só rodar o comando ``php artisan serve`` e o projeto já estará funcionando.