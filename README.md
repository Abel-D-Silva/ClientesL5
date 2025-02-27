# API RESTful com CodeIgniter 4

## Descrição:

Esta é uma API RESTful desenvolvida com CodeIgniter 4, que implementa autenticação JWT, paginação, filtros e um CRUD completo para os recursos `Clientes`, `Produtos` e `Pedidos`.

---

## Tecnologias Utilizadas:

- PHP 8+
- CodeIgniter 4
- MariaDB/MySQL
- JWT (Json Web Token)
- Composer
- Postman (para testes de API)

---

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/Abel-D-Silva/ClientesL5.git
   ```

2. Acesse o diretório do projeto:
   ```bash
   cd ClientesL5
   ```

3. Instale as dependências com o Composer:
   ```bash
   composer install
   ```

4. Configure o arquivo `.env`:
   ```bash
   cp env .env
   ```
   - Edite o `.env` e configure a conexão com o banco de dados:
     ```
     database.default.hostname = localhost
     database.default.database = clientesl5
     database.default.username = root
     database.default.password = 
     database.default.DBDriver = MySQLi
     ```

5. Execute as migrações para criar as tabelas:
   ```bash
   php spark migrate
   ```

6. Inicie o servidor local:
   ```bash
   php spark serve
   ```
   - A API estará rodando em `http://localhost:8080`

---

## Autenticação JWT

Para acessar os recursos protegidos da API, é necessário obter um token JWT.

1. **Obter Token:**
   - Endpoint: `POST /login`
   - Corpo da requisição (JSON):
     ```json
     {
       "parametros": {
         "email": "admin@email.com",
         "password": "123456"
       }
     }
     ```
   - Resposta:
     ```json
     {
       "cabecalho": {
         "status": 200,
         "mensagem": "Login realizado com sucesso"
       },
       "retorno": {
         "token": "token-jwt-aqui"
       }
     }
     ```

2. **Usar Token para Autenticação:**
   - Para acessar os endpoints protegidos, envie o token no cabeçalho `Authorization`:
     ```
     Authorization: Bearer token-jwt-aqui
     ```

---

## Endpoints Disponíveis

### Clientes
- `GET /clientes` → Lista todos os clientes
- `GET /clientes/{id}` → Retorna um cliente específico
- `POST /clientes` → Cadastra um novo cliente
- `PUT /clientes/{id}` → Atualiza um cliente existente
- `DELETE /clientes/{id}` → Remove um cliente

### Produtos
- `GET /produtos` → Lista todos os produtos
- `GET /produtos/{id}` → Retorna um produto específico
- `POST /produtos` → Cadastra um novo produto
- `PUT /produtos/{id}` → Atualiza um produto existente
- `DELETE /produtos/{id}` → Remove um produto

### Pedidos
- `GET /pedidos` → Lista todos os pedidos
- `GET /pedidos/{id}` → Retorna um pedido específico
- `POST /pedidos` → Cadastra um novo pedido
- `PUT /pedidos/{id}` → Atualiza um pedido existente
- `DELETE /pedidos/{id}` → Remove um pedido

---

## Exemplo de Requisição

### Criar um novo cliente
- **Requisição:**
  ```http
  POST /clientes
  Content-Type: application/json
  Authorization: Bearer token-jwt-aqui
  ```
  ```json
  {
    "parametros": {
      "nome": "Maria Souza",
      "cpf": "12345678901"
    }
  }
  ```

- **Resposta:**
  ```json
  {
    "cabecalho": {
      "status": 201,
      "mensagem": "Cliente cadastrado com sucesso"
    },
    "retorno": {
      "id_cliente": 1
    }
  }
  ```

### Criar um novo produto
- **Requisição:**
  ```http
  POST /produtos
  Content-Type: application/json
  Authorization: Bearer token-jwt-aqui
  ```
  ```json
  {
    "parametros": {
      "nome": "Celular XYZ",
      "descricao": "Smartphone de última geração",
      "preco": 1999.99
    }
  }
  ```

- **Resposta:**
  ```json
  {
    "cabecalho": {
      "status": 201,
      "mensagem": "Produto cadastrado com sucesso"
    },
    "retorno": {
      "id_produto": 4
    }
  }
  ```

### Criar um novo pedido
- **Requisição:**
  ```http
  POST /pedidos
  Content-Type: application/json
  Authorization: Bearer token-jwt-aqui
  ```
  ```json
  {
    "parametros": {
      "id_cliente": 1,
      "itens": [
        { 
          "id_produto": 1, 
        "quantidade": 2,
        "status": //"Em Aberto", "Pago", "Cancelado"
        }
      ]
    }
  }
  ```

- **Resposta:**
  ```json
  {
    "cabecalho": {
      "status": 201,
      "mensagem": "Pedido cadastrado com sucesso"
    },
    "retorno": {
      "id_pedido": 10
    }
  }
  ```

---

## Manutenção e Testes

- Para resetar o banco de dados e rodar novamente as migrações:

  ```bash
  php spark migrate:refresh
  ```

- Para testar os endpoints, utilize o **Postman** ou **Insomnia**.

---

## Licença
Este projeto está licenciado sob a [MIT License](LICENSE).

