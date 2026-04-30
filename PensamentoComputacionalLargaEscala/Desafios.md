# Desafios Técnicos e Soluções: UrbanFlow

Este documento descreve os principais desafios encontrados durante a concepção do sistema **UrbanFlow** e as estratégias de engenharia de software aplicadas para superá-los, garantindo a integridade e a performance em larga escala.

---

## 1. Gargalo na Ingestão de Dados (Data Ingestion Peak)
**O Desafio:** 
Em horários de pico (ex: início de turnos logísticos), milhares de dispositivos IoT enviam pacotes de dados simultaneamente. Uma arquitetura síncrona (onde o servidor espera o banco de dados salvar para responder) causaria travamentos e perda de dados.

**A Solução:**
*   **Implementação de Backpressure:** Uso de um Message Broker (RabbitMQ/Kafka) para atuar como um "pulmão". O dado é recebido, confirmado e enfileirado em milissegundos.
*   **Escalonamento Automático (Auto-scaling):** Configuração de réplicas do serviço de ingestão que aumentam conforme o uso da CPU atinge 70%.

---

## 2. Consistência vs. Disponibilidade (Teorema CAP)
**O Desafio:**
Em sistemas distribuídos, é impossível garantir Consistência, Disponibilidade e Tolerância a Partição simultaneamente. Para um sistema de rastreamento, o usuário não pode ver o mapa "congelado".

**A Solução:**
*   **Consistência Eventual:** Priorizamos a **Disponibilidade**. O sistema mostra a última posição conhecida imediatamente, mesmo que o processamento do histórico completo leve alguns segundos a mais para ser consolidado no banco principal.
*   **Uso de In-Memory DB:** Implementação de Redis para armazenar o "Estado Atual" dos veículos, garantindo leitura instantânea.

---

## 3. Segurança e Privacidade de Dados Sensíveis
**O Desafio:**
Roteamento logístico envolve dados estratégicos e posições em tempo real que não podem ser interceptadas. Precisamos seguir os princípios de **Saltzer & Schroeder**.

**A Solução:**
*   **Economia de Mecanismo:** Design de segurança simples e testável, evitando camadas desnecessárias que criam vulnerabilidades.
*   **Mediação Completa:** Todo acesso a rotas específicas passa por um serviço de autorização que verifica as permissões (RBAC) em cada requisição, não apenas no login.
*   **Criptografia Homomórfica (Parcial):** Dados de identificação de motoristas são anonimizados nos módulos de IA, protegendo a privacidade individual.

---

## 4. Latência no Cálculo de Rotas Dinâmicas
**O Desafio:**
Calcular o menor caminho em um grafo urbano com milhares de nós (ruas) e pesos variáveis (trânsito) é computacionalmente caro.

**A Solução:**
*   **Decomposição Geográfica:** O mapa é dividido em "Células" ou setores. O sistema calcula rotas locais dentro da célula antes de processar o trajeto global.
*   **Heurística de A* (A-Star):** Otimização do algoritmo de Dijkstra com funções heurísticas para reduzir o espaço de busca e entregar o resultado em tempo real.

---

## 5. Integração com APIs de Terceiros (Resiliência)
**O Desafio:**
O UrbanFlow depende de APIs externas (Clima, Mapas). Se o provedor de mapas ficar offline, o sistema não pode parar.

**A Solução:**
*   **Padrão Circuit Breaker:** Se a API externa falhar consecutivamente, o sistema corta a conexão e ativa um modo de contingência com dados locais/estáticos para evitar que a fila de requisições trave o servidor.
*   **Failover Automático:** Alternância imediata entre provedores (ex: de Google Maps para OpenStreetMap) detectada por monitoramento de saúde (*Health Checks*).

---

## 📈 Lições Aprendidas
O desenvolvimento deste projeto demonstrou que o **Pensamento Computacional** é a base para a **Arquitetura de Software**. Decompor um problema não é apenas dividir tarefas, mas entender como os componentes se comunicam sob pressão para manter um sistema de larga escala operacional e seguro.
