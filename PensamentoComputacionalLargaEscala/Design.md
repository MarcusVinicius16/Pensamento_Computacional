# Design do Sistema: UrbanFlow – Arquitetura de Larga Escala

Este documento detalha as decisões de design baseadas nos pilares do Pensamento Computacional, focando na infraestrutura necessária para suportar alta carga de dados e usuários.

---

## 🏗️ 1. Decomposição (Decomposition)
Para garantir a escalabilidade e a manutenção independente, o sistema foi decomposto em subdomínios funcionais através de uma **Arquitetura de Microsserviços**:

### 1.1 Ingestão e Telemetria (Ingestion Service)
*   **Responsabilidade:** Receber coordenadas GPS e sensores de telemetria via protocolo MQTT.
*   **Justificativa:** Isolar a recepção de dados pesada do restante das regras de negócio, evitando que picos de tráfego derrubem a interface do usuário.

### 1.2 Processamento de Rotas (Routing Engine)
*   **Responsabilidade:** Calcular e otimizar trajetos em tempo real.
*   **Justificativa:** Módulo computacionalmente intensivo que exige escalabilidade horizontal (adicionar mais servidores conforme a demanda cresce).

### 1.3 Notificações e Alertas (Event Dispatcher)
*   **Responsabilidade:** Identificar eventos críticos (ex: desvio de rota, atraso iminente) e disparar alertas via WebSockets ou Push.

### 1.4 Persistência e Histórico (Storage Service)
*   **Responsabilidade:** Gerenciar o banco de dados geográfico e o histórico de viagens.

---

## 🧩 2. Abstração (Abstraction)
A abstração foi aplicada para simplificar a complexidade da infraestrutura urbana e garantir flexibilidade tecnológica:

### 2.1 Modelagem de Entidades Técnicas
*   **Abstração de Veículo:** Independentemente do modelo (caminhão, van ou moto), o sistema trata o objeto como um `Provider`, que possui atributos de `lat`, `long`, `speed` e `payload_capacity`.
*   **Abstração de Mapa:** Criamos uma camada de interface (Adapter) para o serviço de mapas. Isso permite que o UrbanFlow mude do Google Maps para o OpenStreetMap sem alterar o código principal.

### 2.2 Camada de Persistência Poliglota
*   O sistema não enxerga o banco de dados diretamente. Ele utiliza uma **Camada de Repositório** que abstrai se os dados estão em um banco Relacional (PostgreSQL para dados financeiros) ou NoSQL (MongoDB para logs de rastreamento).

---

## 🎨 3. Reconhecimento de Padrões (Pattern Recognition)
Aplicamos padrões de projeto (*Design Patterns*) e arquiteturais consagrados em sistemas de larga escala:

### 3.1 Padrão Pub/Sub (Publish-Subscribe)
*   **Aplicação:** O serviço de Ingestão publica a localização do veículo em uma fila (Message Broker). Outros módulos "assinam" essa fila para atualizar o mapa ou calcular a previsão de chegada.
*   **Benefício:** Desacoplamento total entre os módulos.

### 3.2 Padrão Circuit Breaker
*   **Aplicação:** Se a API externa de tráfego falhar, o sistema "abre o circuito" e utiliza dados históricos em vez de travar esperando uma resposta.
*   **Benefício:** Resiliência e tolerância a falhas.

### 3.3 Padrão Singleton para Gerenciamento de Configurações
*   **Aplicação:** Garante que a configuração global do sistema de larga escala (variáveis de ambiente, limites de API) seja instanciada uma única vez, economizando memória.

---

## 📊 4. Algoritmos e Lógica de Fluxo
A lógica central do sistema baseia-se em dois fluxos críticos:

1.  **Processamento Stream:** 
    *   `Entrada de Dados -> Validação de Schema -> Normalização -> Publicação no Broker`.
2.  **Cálculo de ETA (Estimated Time of Arrival):**
    *   Uso de algoritmos de grafos que ponderam o peso das arestas (ruas) com base na densidade de tráfego atual informada pelos sensores.

---

## 🛡️ Considerações de Segurança (Design-first)
*   **Least Privilege:** Cada microsserviço opera com o mínimo de acesso necessário aos dados dos outros.
*   **Criptografia em Trânsito:** Todo dado de geolocalização é trafegado via TLS 1.3 para evitar ataques de *Man-in-the-Middle*.
