# Desafio_crud_Laravel_11

#Passo a Passo para executar o sistema:

#Clone o repositório:
git clone https://github.com/WeslleyRhaonny/Desafio_crud_Laravel_11.git

#Crie o container Docker (Certifique-se de ter o Docker instalado):
docker compose up -d

#Entre no container:
docker compose exec app bash

#Gere uma key para o seu projeto:
php artisan key:generate

#atualize as dependencias:
composer update

#crie o banco de dados no seu phpmyadmin:
Por padrão do projeto você pode acessar o phpmyadmin no: http://localhost:8081/ mas você pode alterar isso no seu .env

#execute os migrations das tabelas do banco de dados e execute a seed de usuário e dos status das transações:
php artisan migrate:fresh --seed

com isso, seu projeto vai estar rodando e você pode acesá-lo na rota: 
http://localhost:8000/
