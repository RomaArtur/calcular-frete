# Calculadora de Frete - API RESTful

Projeto desenvolvido como teste técnico para demonstrar competências em arquitetura de back-end, banco de dados e lógica de programação orientada a objetos.

O núcleo da aplicação reside na estrutura de pastas src, desenvolvida com PHP puro. Para este desafio, optei por não utilizar frameworks robustos como Laravel, a fim de focar na lógica e arquitetura do código.

Quanto aos dados, utilizei o PostgreSQL hospedado na nuvem (NeonDB), onde utilizei PDO para consultas seguras.

Junto a isso, a interface do usuário foi criada com HTML, CSS e JavaScript puro, optei por desenvolver algo simples e funcional para uma experiência mais agrádavel. A lógica de cálculo cruza faixas de CEP e peso para determinar o valor e prazo de entrega. Todo o desenvolvimento foi guiado por IA atuando como tutora, focando no diagnóstico de erros complexos de ambiente e na compreensão profunda da arquitetura, garantindo que cada linha de código fosse escrita e validada por mim.

## Tecnologias Utilizadas

- **Linguagem:** PHP.
- **Banco de Dados:** PostgreSQL, NeonDB.
- **Gerenciamento de Dependências:** Composer.

## Como Executar o Projeto

1.  ```
    git clone https://github.com/RomaArtur/calcular-frete.git
    cd calcular-frete

    ```

2.  ```
     composer install
    ```
3.  ```
     php -S localhost:8000 -t public
    ```
4.  ```
    curl -X POST http://localhost:8000/calcular_frete \
    -H "Content-Type: application/json" \
    -d '{"cep": "13165176", "peso": 2.5}'
    -->
    ```
