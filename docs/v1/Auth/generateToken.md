
## Autenticação

Para se autenticar na aplicação deve gerar o token e incluilo em toda requisição a api.

```http
  POST /v1/login
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `userMail`      | `string` | **Obrigatório**. Deverá ser enviado o usuário no qual deseja logar |
| `password`      | `string` | **Obrigatório**. Senha do usuário informado |


**Possíveis códigos de erro**


| Código HTTP   | Explicação                                   |
| :---------- | :------------------------------------------ |
| `401`    | Usuário ou senha inválidos |
| `422`   | Erro de validação: campos obrigatórios, conferir tabela acima. |
| `422`   | Usuário inexistente |





**Exemplo de JSON enviado: (Usuário criado por Seeder "php artisan db:seed --class=UserSeeder")**

```json
{
	"userMail": "lucasoliveiralops@gmail.com",
	"password": "lucasoliveiralops@gmail.com"
}

```



**Exemplo de retorno:**

```json
{
	"data": {
		"accessToken": "7|N3x2bS8lZj4bJbsNavZvmR3GAnzvaYzfOaaN1oXc454e54df",
		"tokenType": "Bearer"
	}
}
```
