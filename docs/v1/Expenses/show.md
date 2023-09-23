
## Exibir uma despesa em específico

Essa rota tem o intuito de uma despesa em específico.

Obs: essa rota é necessário o Berear Token gerado na rota de login.


```http
  GET /v1/expenses/{id}
```

**Possíveis códigos de erro**


| Código HTTP | Explicação                                                                                         |
| :---------- | :------------------------------------------------------------------------------------------------- |
| `403`       | Usuário não tem permissão para ver essa despesa, o usuário só pode ver uma despesa criada por ele. |
| `404`       | Despesa não encontrada                                                                             |



**Exemplo de JSON recebido**

```json
{
	"data": {
		"id": 20,
		"description": "Essa é uma despesa de teste",
		"value": 50,
		"date": "2023-08-12",
		"updatedAt": "2023-09-21T01:25:57.000000Z",
		"createdAt": "2023-09-21T01:25:57.000000Z",
		"creator": {
			"id": 1,
			"name": "Lucas Oliveira"
		}
	}
}

```