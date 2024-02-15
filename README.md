# Projeto

[![](https://img.shields.io/badge/vue.js-v3.2.36-04C690.svg)](https://vuejs.org/)
[![](https://img.shields.io/badge/Laravel-v10.8-ff2e21.svg)](https://laravel.com)

Projeto está sendo desenvolvido em Laravel https://laravel.com/ juntamente com vue.js https://vuejs.org/

Esse projeto inicial é para ser usado em novos projetos, pois nele já temos muitas coisas configuradas como o Horizon, Pulse, Websockect, Login entre outros recursos.

## Docker

Para subir o projeto no docker utilizar o doc do laravel sail

```bash
  https://laravel.com/docs/10.x/sail
```

Comandos para executar no dokcer

```bash
  ./vendor/bin/sail up --build
```

```bash
  ./vendor/bin/sail artisan storage:link
```

```bash
  ./vendor/bin/sail artisan migrate --seed
```

Acredito que com o laravel sail não precise rodar nada referente ao composer, mas caso haja necessidade rode o seguinte comando

```bash
  composer install
```

## Configuração Front

Para instalar todos as dependências utilize o comando abaixo

```bash
  yarn install
```

## Exe Front no ambiente de dev

Executando o Front no ambiente de desenvolvimento

```bash
  npx vite --port=4000
```

ou

```bash
  yarn dev
```

## Variáveis de Ambiente

Para rodar esse projeto, você vai precisar adicionar as seguintes variáveis de ambiente no seu .env

`HORIZON_BASIC_AUTH_USERNAME`

`HORIZON_BASIC_AUTH_PASSWORD`

`MAIL_NOTIFY_BACKUP`

```bash
  BROADCAST_DRIVER=pusher
  CACHE_DRIVER=redis
  FILESYSTEM_DISK=local
  QUEUE_CONNECTION=redis
  SESSION_DRIVER=redis
  SESSION_LIFETIME=120

  PUSHER_HOST=soketi
  PUSHER_PORT=6001
  PUSHER_SCHEME=http
  PUSHER_APP_ID=app-id
  PUSHER_APP_KEY=app-key
  PUSHER_APP_SECRET=app-secret
  PUSHER_APP_CLUSTER=mt1

  MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
  MIX_PUSHER_HOST="${PUSHER_HOST}"
  MIX_PUSHER_PORT="${PUSHER_PORT}"
```

## E-mail

Configure o mailtrap em seu ambiente de desenvolvimento para não disparar um e-mail para cliente por acidente

```bash
  https://mailtrap.io/?gad_source=1
```

## Frameworks de front

Utilizamos o tailwindcss

```bash
  https://tailwindcss.com/
```

Os icones estamos usando o heroicons

```bash
  https://heroicons.com
```

## Criando bando de dados

Ao executar o comando `migrate --seed` com o env `APP_ENV=local` todos os usuários criados viram com a senha `123123123` por padrão

```bash
  ./vendor/bin/sail artisan migrate --seed
```

## Frameworks do laravel instalados

Utilizamos o horizon para gerenciar os jobs do projeto

```bash
  https://laravel.com/docs/10.x/horizon
```

Para acessar na plaraforma

```bash
  http://localhost/management/horizon
```

Utilizamos o pulse para gerenciar o servidor como um todo

```bash
  https://laravel.com/docs/10.x/pulse
```

Para acessar na plaraforma

```bash
  http://localhost/management/pulse
```

## Websocket

```bash
  https://laravel.com/docs/10.x/broadcasting
```

```bash
  https://docs.soketi.app/getting-started/installation/laravel-sail-docker
```

```bash
  https://docs.soketi.app/getting-started/client-configuration/laravel-echo
```

# Organização de pastas do projeto

#### Back-end:

Todas as classes do backend devem ter somente uma responsabilidade.

1. Actions

-   Responsável por executar uma query
-   Caso ela receba várias variáveis utilize methods sets
-   Caso várias actions compartilhem a mesma funcionalidade ou where, utilize Trait para centralizar esse código

2. Apis

-   Onde se encontra todas as APIs que a plataforma consome
-   Caso ela receba várias variáveis utilize methods sets

3. Enums

-   Onde se encontra todos os enum da plataforma

4. Events

-   Utilizado para acionar o websocket, e mandar notificação pra front

5. Exports

-   Responsável por gerar arquivos de excel, utilizando o Maatwebsite

6. Controllers

-   Responsável por controlar a requisição do usuário e validar se ele tem permissão de acessar a mesma
-   Tente deixar ela o mais clean possível

7. Request

-   Todas as validações de request devem ser feitos em arquivo desse

8. Jobs

-   Responsável por gerenciar as filas
-   Toda regra de negócio que não precisa ser executada em 'real time' deve ser executada por um jobs, como por exemplo um disparo de e-mail, uma geração de excel, etc

9. Listeners

-   Ainda não estamos utilizando eventos

10. Mail

-   Ainda não estamos utilizando eventos, pois usamos o notify por hora

11. Model

-   Responsável por se comunicar com o banco de dados

12. Notifications

-   Responsável por encaminhar notificações ao usuário

13. Observers

-   Ele é responsável por escutar os Model e gravar o log de ação de INSERT, UPDATE e DELETE de cada tabela

14. Services

-   Caso a regra de negócio seja muito complexa podemos criar um service para deixar o controller mais clean

15. Middleware ->

#### Front-end

O front se encontra dentro de resources/js/

1. Assets

-   Onde deve ser armazenados os arquivos, fotos, etc

2. Components

-   Todos os componentes da aplicação
-   Caso algum componente é chamado em várias telas como por exemplo um Combobox de Cidade, a regra de carregamento dele deve estar dentro do componente

3. Helpers

-   Arquivos js de ajuda

4. Layouts

-   Onde fica os componente de layout da página, como menu, navbar, loading

5. Pages

-   Todas as páginas de aplicação
-   Para fazer a validação dos dados utilizamos o 'yup'

5. Plugins

-   Todas as configurações dos plugins utilizados

6. Router

-   Rotas do vue.js, é necessário também colocar essas rotas no laravel.web para ele conseguir se localizar caso o usuário dê um F5

7. Store

-   Onde fica o vuex

## Documentação de cores

As configuração de cores ficam no arquivo "tailwind.config.js"

<!-- | Cor             | Hexadecimal                                                      |
| --------------- | ---------------------------------------------------------------- |
| primary         | ![#081466](https://via.placeholder.com/10/081466?text=+) #081466 |
| primary-light   | ![#0E49B5](https://via.placeholder.com/10/0E49B5?text=+) #0E49B5 |
| secondary       | ![#05C60E](https://via.placeholder.com/10/05C60E?text=+) #05C60E |
| secondary-light | ![#54E346](https://via.placeholder.com/10/54E346?text=+) #54E346 |
| gray-light      | ![#E6E7E8](https://via.placeholder.com/10/E6E7E8?text=+) #E6E7E8 | -->
