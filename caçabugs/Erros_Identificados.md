# Registro de Erros Identificados – UrbanFlow

Este documento detalha as falhas encontradas no sistema UrbanFlow durante a fase de testes e revisão de código, categorizadas por tipo.

## 1. Erros de Sintaxe
*Erros que impedem a compilação ou interpretação do script.*

| Localização | Descrição do Erro | Impacto |
| :--- | :--- | :--- |
| `config/database.php` | Ausência de ponto e vírgula `;` ao final da string de conexão PDO. | O script interrompe a execução imediatamente (Parse Error). |
| `includes/header.php` | Tag PHP mal fechada ou erro de digitação em comando `echo`. | Exibição de código puro na interface do usuário. |

---

## 2. Erros de Lógica
*O código roda, mas o resultado não é o esperado pelo sistema de logística.*

*   **Falha no Cálculo de Prazo:** O algoritmo de previsão de entrega não estava considerando o status "Em Trânsito", resultando em datas de entrega no passado para mercadorias ainda não despachadas.
*   **Loop Infinito na Listagem:** Uma condição incorreta no `while` ao buscar motoristas ativos fazia com que o sistema travasse ao tentar renderizar o painel de monitoramento.
*   **Vulnerabilidade de Tipagem:** Comparação de IDs de rastreio usando `==` (fraco) em vez de `===` (estrito), permitindo que strings vazias fossem validadas como zero.

---

## 3. Erros de Execução
*Erros que ocorrem enquanto o sistema está sendo usado pelo usuário final.*

*   **Sessão não Iniciada:** Chamada de variáveis `$_SESSION` antes da função `session_start()`, causando perda de autenticação ao navegar entre as páginas do UrbanFlow.
*   **Conexão Recusada:** Falha ao tratar a exceção quando o servidor MySQL está offline, resultando na exibição de mensagens de erro internas (path disclosure) para o usuário.
*   **Upload de Arquivos:** Erro ao tentar salvar o comprovante de entrega quando a pasta de destino não possuía permissões de escrita (`Permission Denied`).
*   **Chave Estrangeira (SQL):** Tentativa de excluir um veículo que ainda possui rotas vinculadas no banco de dados, gerando um erro de restrição de integridade (Foreign Key Constraint).

---

## 4. Resumo de Severidade
*   **Críticos:** 2 (Conexão com banco e Erros de Sessão).
*   **Moderados:** 3 (Lógica de entrega e permissões de pasta).
*   **Leves:** 2 (Sintaxe básica e exibição de interface).
