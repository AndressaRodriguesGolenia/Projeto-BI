# Business Intelligence (BI) Dashboard

Este projeto consiste em um Dashboard de Business Intelligence (BI) para visualização e análise de vendas, utilizando uma arquitetura MVC com Laravel (PHP) e um frontend em Vue.js.

## Estrutura do Projeto

O projeto está dividido em duas partes principais: backend e frontend.

### Backend

O backend é desenvolvido em Laravel 

### Frontend

O frontend é desenvolvido em Vue.js e é responsável por exibir o dashboard e detalhes das vendas.

- **Componentes**: Dashboard com vários gráficos (Total Sales By Customer, Sales By Status, Sales By City, Sales By Day, Sales Heatmap) e tela de detalhes.
- **Estilo**: Utiliza CSS customizado para layout responsivo e agradável.

## Instalação

Para executar este projeto localmente, siga os passos abaixo:

### Pré-requisitos

Certifique-se de ter instalado em seu ambiente de desenvolvimento:

- Docker

### Passos para Instalação

1. **Clone o repositório**

   ```bash
   git clone <URL_DO_SEU_REPOSITÓRIO>
   cd <NOME_DO_DIRETÓRIO_CLONADO>
   ```

2. **Configuração do Docker**

    ```bash
    docker-compose up -d
    ```

3. **Migrações e Seeders**

    ```bash
    docker exec -it app bash
    php artisan migrate --force
    php artisan db:seed --class=VendasSeeder 
    ```
## Uso

Após configurar e iniciar o projeto, você pode acessar o dashboard BI através do navegador:

- **Backend API**: `http://127.0.0.1:8000/api/vendas` (Laravel)
- **Frontend**: `http://127.0.0.1:8000` (Vue.js)

### Funcionalidades

- **Dashboard**: Visualização de gráficos conforme filtros aplicados (Total Vendas por Situação,Valor Vendas por Cliente,Total de Venda por Cliente,Vendas por Cidade,Vendas por dia,Vendas por dia da semana).
- **Detalhes**: Visualização detalhada de vendas conforme filtros aplicados.

## Contribuição

Contribuições são bem-vindas. Sinta-se à vontade para abrir um pull request com melhorias, correções de bugs ou novas funcionalidades.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---

Esse documento fornece uma visão geral e guia básico para configurar, instalar e usar o BI Dashboard. Para mais detalhes ou informações específicas, consulte a documentação dos componentes individuais (Laravel, Vue.js).
