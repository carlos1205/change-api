## Change - API

### Pre-requisitos

Para a utilização é necessário configurar o .env com os dados do banco de dados local.
Além disso deve-se criar um DB e o nome também deve ser setado no arquivo .env

apos estas configurações rodar os seguintes comandos no mesmo repositório do projeto:
- *composer install*
- *php artisan migrate*
- *php artisan serve*

#### Nota: Se já tiver instalado o projeto anteriormente utilizar apenas o *php artisan serve*

### Bugs:
A validação do usuário, não está funcionando adequadamente, pois estava dando conflito com o laravel.