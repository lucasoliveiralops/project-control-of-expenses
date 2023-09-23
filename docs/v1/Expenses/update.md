
## Atualizar uma Despesa

Essa rota tem o intuito de realizar a atualização de uma despesa cadastrada.

Obs: essa rota é necessário o Berear Token gerado na rota de login.


```http
  PUT|PATCH /v1/expenses/{ID}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `description`      | `string` | **Opcional**. Nova descrição da despesa, essa descrição poderá ter no máximo 191 caracteres. |
| `date`      | `date` | **Opcional**. Nova data da despesa, essa data não pode ser uma data futura.|
| `value`      | `double` | **Opcional**. Novo valor da despesa, deverá ser informado qual o valor dessa despesa, o valor deverá ser maior que zero.|


**Possíveis códigos de erro**


| Código HTTP   | Explicação                                   |
| :---------- | :------------------------------------------ |
| `403`   | Usuário não tem permissão para alterar essa despesa, o usuário só pode alterar uma despesa criada por ele. |
| `404`   | Despesa não encontrada |
| `422`   | Erro de validação: campos obrigatórios, conferir tabela acima. |





**Exemplo de JSON enviado: (Usuário criado por Seeder "php artisan db:seed --class=UserSeeder")**

```json
{
	"description": "Essa é uma despesa de teste",
	"value": "500.00"
}

```