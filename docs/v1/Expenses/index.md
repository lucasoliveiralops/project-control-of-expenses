
## Exibir todas Despesas

Essa rota tem o intuito de exibir todas despesas cadastradas pelo usuário.

Obs: essa rota é necessário o Berear Token gerado na rota de login.


```http
  GET /v1/expenses
```



**Exemplo de JSON recebido**

```json
{
	"data": [
		{
			"id": 1,
			"description": "Essa é uma despesa de teste",
			"value": 50,
			"date": "2023-08-12",
			"updatedAt": "2023-09-20T19:32:03.000000Z",
			"createdAt": "2023-09-20T19:32:03.000000Z",
			"creator": {
				"id": 1,
				"name": "Lucas Oliveira"
			}
		},
		{
			"id": 2,
			"description": "Essa é uma despesa de teste",
			"value": 50,
			"date": "2023-08-12",
			"updatedAt": "2023-09-20T19:33:10.000000Z",
			"createdAt": "2023-09-20T19:33:10.000000Z",
			"creator": {
				"id": 1,
				"name": "Lucas Oliveira"
			}
		}
	]
}

```