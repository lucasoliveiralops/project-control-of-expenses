#  Documentação da API do Projeto de Controle de Despesas


>## Recursos autenticados 

>Enviar o access_token durante as requisições através do parâmetro header, juntamente com o prefixo 'Authorization: Bearer '.
Rotas Autenticados terão o seguinte icon :lock:

##### headers
- Accept application/json
- content-type application/json

## Summary

  ### API 1.0

Icones: 
- :lock: Rotas Autenticadas 
- :house: Rotas que não são necessárias autenticação
    - :house: Autenticação
      - [:house: `Logar com Token`](./docs/v1/Auth/generateToken.md)
    - :lock: Despesas 
     - [:lock: `Exibir Todas Despesas`](./docs/v1/Expenses/index.md)
     - [:lock: `Exibir uma despesa em específico`](./docs/v1/Expenses/show.md)
     - [:lock: `Cadastrar Despesas`](./docs/v1/Expenses/create.md)
     - [:lock: `Atualizar Despesas`](./docs/v1/Expenses/update.md)
     - [:lock: `Deletar Despesas`](./docs/v1/Expenses/delete.md)

