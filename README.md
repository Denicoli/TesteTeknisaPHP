# Teste Técnico - Teknisa

## API Lumen desenvolvida para simular envio de emails utilizando a rota POST.

### Features

- [x] Rota que recebe uma lista de emails, faz a validação e os inclui em um arquivo de texto.
- [x] Rota que simula o envio dos emails, gerando arquivos log para os arquivos enviados e não enviados.

## Instalando a API

### API

A API foi desenvolvida utilizando a micro framework [Lumen](https://lumen.laravel.com/), e usa a biblioteca [Monolog](https://github.com/Seldaek/monolog) para gerar arquivos log.

* Para baixar o projeto siga as instruções abaixo:

```
1. git clone https://github.com/Denicoli/TesteTeknisaPHP
2. cd TesteTeknisaPHP

```
* A API necessita que o [Composer](https://getcomposer.org/) esteja instalado na máquina.

Renomeie o arquivo `.env.example` para `.env`.


* Observação:

Os logs gerados encontram-se no diretório `/storage/logs`.

## Iniciando a API

* Basta executar o comando:

```
php -S localhost:8000 -t public

```

Pronto! A aplicação já está rodando e já podem ser feitas as requisições.

## Requisições

### POST - Rota /add

Utilizando um aplicativo para realizar requisições, como o [Insomnia](https://insomnia.rest/), basta acessar a URL  http://127.0.0.1:8000 seguido de '/add'. (Ex: http://127.0.0.1:8000/add).

O envio para rota é um JSON contendo a lista de emails.

![](/screenshots/rota-add.png?raw=true "POST - Add")

### POST - Rota /send

Pelo aplicativo de requisições, basta acessar a URL e enviar a requisição pela rota http://127.0.0.1:8000/send.

![](/screenshots/rota-send.png?raw=true "POST - Send")

## Autor