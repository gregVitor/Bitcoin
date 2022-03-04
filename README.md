# Teste de Dev Backend

> API de investimento em bitcoins

- Link para download da da coleção do postman ```https://www.getpostman.com/collections/17e8807dfc36812b1bd2```
- Link para vizualiação da documentação ```https://documenter.getpostman.com/view/13807544/TVzViGL6```

## Linguagem de Programação
- Desenvolvido em PHP (Lumen)
- Mysql

### Como rodar o projeto

```bash
# Instalando dependencias
composer install

# Executando o servidor de desenvolvimento
php -S localhost:8080 -t ./public

# Rodando as migrates do banco de dados
php artisan migrate

#Rodando os crons manualmente

#Cron para buscar e salvar o historico de preços do bitcoin
php artisan cron:historic-bitcoin

#Cron para apagar os historico com mais de 90 dias salvos
php artisan cron:clear-historic

```
