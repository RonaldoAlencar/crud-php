# CRUD
>
> Projeto de crud com o backend desenvolvido com php e frontend com html, css e javascript. Ambiente de desenvolvimento com docker

## Tecnologias

- ![PHP](https://img.shields.io/badge/PHP-8.0-777BB4.svg?style=flat-square&logo=php) backend com docker e apache server para rodar o php
- ![Docker](https://img.shields.io/badge/Docker-%230db7ed.svg?style=flat-square&logo=docker) para rodar o ambiente de desenvolvimento
- ![HTML5](https://img.shields.io/badge/HTML5-%23E34F26.svg?style=flat-square&logo=html5&logoColor=white) frontend
- ![CSS3](https://img.shields.io/badge/CSS3-%231572B6.svg?style=flat-square&logo=css3&logoColor=white) frontend
- ![JavaScript](https://img.shields.io/badge/JavaScript-%23F7DF1E.svg?style=flat-square&logo=javascript&logoColor=black) frontend
- ![MySQL](https://img.shields.io/badge/MySQL-%2300f.svg?style=flat-square&logo=mysql&logoColor=white) banco de dados
- ![Apache](https://img.shields.io/badge/Apache-%23D42029.svg?style=flat-square&logo=apache&logoColor=white) servidor web

## Dependências
>
> Para rodar o projeto é necessário ter o docker instalado na máquina e o docker compose
> Caso não tenha o docker instalado, siga o tutorial de instalação no site oficial: <https://docs.docker.com/get-docker/>
> Todas as tabelas do banco de dados são criadas automaticamente ao rodar o docker compose

## Instalação do backend

Linux:

```sh
git clone <url do repositório>
cd backend
docker compose up -d --build
```

## Exemplo de uso

O projeto é um crud simples com as operações de criar, ler, atualizar e deletar.
O endpoint para acessar o projeto é: <http://localhost:8080>

## Observações

O projeto está em desenvolvimento e tem como intuito estudar e praticar os conceitos de crud em php e gerenciamento de ambientes em docker.
Atualizações serão feitas conforme o desenvolvimento for avançando.
