Este é um aplicativo web bem sisplificado, que serve para unir arquivos .csv e .xlsx ele junta vários arquivos, mostra na tela como vai ficar e depois te dá a opção de fazer downlod em um unico arquivo com todos os dados juntos

Pré-requisito:

PHP 8.2
Gerenciador de pacote Composer
Extensão do php gd habilitada

ou usar o docker com as imgens:

PHP 8.2
Gerenciador de pacote Composer
Extensão do php gd habilitada
Nginx

Para iniciar o aplicativo depois que tiver tudo instalado rode os comandos:

git clone https://github.com/thiagohlf/union.git

copie o arquivo .env.example e crie o arquivo .env

e depois rode o comando:

php arquisan key:generate

depois inicie o servidor:

php artisan serve

e abra no navegador com este endereço:
http://localhost:8000