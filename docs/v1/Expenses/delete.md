## Apagar uma Despesa

Essa rota tem o intuito de excluir uma despesa.

Obs: essa rota é necessário o Berear Token gerado na rota de login.


```http
  DELETE /v1/expenses/{ID}
```

**Possíveis códigos de erro**


| Código HTTP   | Explicação                                   |
| :---------- | :------------------------------------------ |
| `403`   | Usuário não tem permissão para alterar essa despesa, o usuário só pode alterar uma despesa criada por ele. |
| `404`   | Despesa não encontrada |


