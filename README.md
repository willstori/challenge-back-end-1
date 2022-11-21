## Alura Challenge Back-end

Este é um desafio proposto pela equipe da alura para praticar os conhecimentos de programação adiquiridos em seus cursos. Ele consiste na implementação de uma API Rest para compartilhamento de vídeos.

## Tecnologias utilizadas

- PHP versão 8.1
- Laravel 9
- MySql

## Instalação

Para executar esta aplicação você deve seguir os seguintes passos:

1º - Copiar o projeto para sua máquina.

```
git clone https://github.com/willstori/challenge-back-end-1.git
```

2º - Instalar as dependências do projeto.

```
composer install
```

3º - Criar uma base de dados mysql.

4° - Preencehr o arquivo .env na raíz do projeto.

5° - Criar as tabelas do banco de dados através do comando.

```
php artisan migrate
```

6º - Preencher o banco de dados através do comando.
```
php artisan db:seed
```

7º - Inicializar a aplicação em um servidor local através do comando.

```
php artisan serve --host='localhost' --port='8000'
```

8º - Acessar o endereço http://localhost:8000

# Rotas

Logo abaixo estão listadas todas as rotas da aplicação, vale lembrar que todas elas devem conter o parametro api_token que autoriza o cliente a realizar consultas a api. 

Obs.: O token padrão é "KWeLeFatUzFVif1NOWgDeEDinxvvfAKUOyUvCzzhMh2r8B6NPrzK5BUV6A685AEkFw3KC5lQAd0xRoXH" gerado no passo 6 da inicialização.

um exemplo de solicitação seria:

http://localhost/categorias?api_token=KWeLeFatUzFVif1NOWgDeEDinxvvfAKUOyUvCzzhMh2r8B6NPrzK5BUV6A685AEkFw3KC5lQAd0xRoXH

## Categorias

**GET** /categorias --- Retorna a lista de todas as categorias.  
**Parametros:** Nenhum.  
**Resposta:** Lista de todas as categorias.  

**GET** /categorias/{id} --- Retorna apenas uma categoria.  
**Parametros:** {id : "int"}  
**Resposta:** {id: "int", titulo : "string", cor : "string"}  

**GET** /categorias/{id}/videos --- Retorna uma lista de vídeos por categoria.  
**Parametros:** {id: "int"}  
**Resposta:** [{id : "int", categoriaId : "int", titulo : "string", descricao : "string", url : "string"}]  

**POST** /categorias --- Cadastra uma nova categoria.  
**Parametros:** {titulo : "string", cor : "string"}  
**Resposta:** {id : "int", titulo : "string", cor : "string"}  

**PUT** /categorias/{id} --- Altera uma categoria.  
**Parametros:** {id : "int", titulo : "string", cor : "string"}  
**Resposta:** {id : "int", titulo : "string", cor : "string"}  

**DELETE** /categorias/{id} --- Remove uma categoria.  
**Parametros:** {id : "int"}  
**Resposta:** {mensagem : "string"}  

## Vídeos

**GET** /videos?search=sua_busca --- Retorna a lista de todos os vídeos ou filtrando por título.  
**Parametros:** {search : "string"}  
**Resposta:** [{id : "int", categoriaId : "int", titulo : "string", descricao : "string", url : "string"}]  

**GET** /videos --- Retorna apenas um vídeo.  
**Parametros:** {id : "int"}  
**Resposta:** {id : "int", categoriaId : "int", titulo : "string", descricao : "string", url : "string"}  

**POST** /videos --- Cadastra um novo vídeo.  
**Parametros:** {categoriaId : "int", titulo : "string", descricao : "string", url : "string"}  
**Resposta:** {id : "int", categoriaId : "int", titulo : "string", descricao : "string", url : "string"}  

**PUT** /videos --- Altera um vídeo.  
**Parametros:** {id : "int", categoriaId : "int", titulo : "string", descricao : "string", url : "string"}  
**Resposta:** {id : "int", categoriaId : "int", titulo : "string", descricao : "string", url : "string"}  

**DELETE** /videos/{id} --- Remove um vídeo.  
**Parametros:** {id : "int"}  
**Resposta:** {mensagem : "string"}  

## Usuários

**POST** /usuarios --- Cadastra um novo usuário.  
**Parametros:** {nome : "string", email : "string", senha : "string"}  
**Resposta:** {id : "int", nome : "string", email : "string", senha : "string"}  

**PUT** /usuarios/{id} --- Altera um usuário.  
**Parametros:** {id : "int", nome : "string", email : "string"}  
**Resposta:** {id : "int", nome : "string", email : "string"}  

**PUT** /usuarios/alterar-senha/{id} --- Altera a senha de um usuário.  
**Parametros:** {id : "int", senha : "string"}  
**Resposta:** {id : "int", nome : "string", email : "string", senha : "string"}  

**PUT** /usuarios/alterar-token/{id} --- Altera o token de um usuário.  
**Parametros:** {id : "int"}  
**Resposta:** {token : "string"}  

**DELETE** /usuarios/{id} --- Remove um usuário.  
**Parametros:** {id : "int"}  
**Resposta:** {mensagem : "string"}  
