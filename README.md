# BuscaCEP

### Buscador de CEP
Classe que pesquisa CEP no site dos Correios e retorna o endereço completo se encontrar.

O retorno é feito em JSON, assim:

```
{
    "Logradouro" : "Avenida, Rua, Praça, etc",
    "Bairro" : "Bairro",
    "Cep" : "12345678",
    "Cidade" : "Cidade",
    "UF" : "UF"
}
```


## Instruções

### Instalação
```
composer require "brunowerneck/buscacep"
```

Ou edite seu composer.json e adicione

```
require : {
    "brunowerneck/buscacep" : "dev-master"
}
```
### Execução
Para executar o sistema, basta chamar a classe:

> use BVW\Correios\BuscaCEP;
> 
> BuscaCep::busca($cep);

Você pode pesquisar o CEP nos formatos **00000-000** ou **00000000**