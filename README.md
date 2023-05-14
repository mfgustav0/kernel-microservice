## Instalação
```shell
composer install
copy .env.example .env
php artisan key:generate
```

## Edite o arquivo .env
- Configure a url do projeto na variavel APP_URL

- Configure a conexão do banco no arquivo, após isso execute o comando
```shell
php artisan migrate --seed
```