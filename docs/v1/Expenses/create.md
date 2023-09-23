
## Cadastro de Despesa

Essa rota tem o intuito de realizar o cadastro de uma despesa.

Obs: essa rota é necessário o Berear Token gerado na rota de login.


```http
  POST /v1/expenses
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `description`      | `string` | **Obrigatório**. Deverá ser enviado uma descrição para a despesa cadastrada, essa descrição poderá ter no máximo 191 caracteres. |
| `date`      | `date` | **Obrigatório**. Deverá ser informado qual a data que a despesa foi gerada, essa data não pode ser uma data futura.|
| `value`      | `double` | **Obrigatório**. Deverá ser informado qual o valor dessa despesa, o valor deverá ser maior que zero.|


**Possíveis códigos de erro**


| Código HTTP   | Explicação                                   |
| :---------- | :------------------------------------------ |
| `422`   | Erro de validação: campos obrigatórios, conferir tabela acima. |





**Exemplo de JSON enviado: (Usuário criado por Seeder "php artisan db:seed --class=UserSeeder")**

```json
{
	"description": "Essa é uma despesa de teste",
	"date": "2023-08-12",
	"value": "50.00"
}

```

