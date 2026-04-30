# Projeto: UrbanFlow – Sistema de Monitoramento Logístico de Larga Escala

## 📌 Descrição do Projeto
Este projeto foi desenvolvido como parte da disciplina **Pensamento Computacional**, sob orientação da **Profa. Kadidja Valéria**. O foco consiste em aplicar os quatro pilares do pensamento computacional no design arquitetural de um sistema distribuído capaz de gerenciar frotas logísticas em metrópoles, garantindo baixa latência e alta resiliência.

---

## 🎯 Objetivos Estratégicos
*   **Integração Sistêmica:** Conectar os fundamentos da Engenharia de Software ao raciocínio algorítmico do Pensamento Computacional.
*   **Escalabilidade Horizontal:** Projetar uma estrutura capaz de suportar o crescimento exponencial de requisições e dados.
*   **Gestão de Complexidade:** Identificar gargalos técnicos em sistemas distribuídos e propor soluções via padrões de projeto (*Design Patterns*).
*   **Agilidade Operacional:** Utilizar frameworks ágeis para a gestão de entregas e mitigação de riscos.

---

## 🚀 Sistema Proposto: UrbanFlow
O **UrbanFlow** é uma plataforma de monitoramento em tempo real para frotas de entrega urbana. O sistema processa dados geográficos (GPS), telemetria de veículos e otimização de rotas simultaneamente.

### Módulos Principais:
1.  **Ingestão de Dados (IoT Gateway):** Recebe sinais de milhares de dispositivos simultaneamente via protocolo MQTT/HTTP.
2.  **Motor de Roteamento Dinâmico:** Algoritmos que recalculam trajetos baseados em tráfego e clima.
3.  **Analytics & Predição (IA):** Módulo de Machine Learning para prever atrasos e sugerir realocação de carga.
4.  **Dashboard de Controle:** Interface de alta performance para gestores logísticos.

---

## 🧠 Pensamento Computacional Aplicado

### 1. Decomposição (Breakdown)
O problema macro "Monitoramento Urbano" foi dividido em micro-problemas independentes:
*   **Gerenciamento de Estado:** Persistência da última posição conhecida do veículo.
*   **Processamento de Eventos:** Filtro e tratamento de alertas (ex: excesso de velocidade).
*   **Segurança e Acesso:** Controle de permissões baseado em funções (RBAC).

### 2. Reconhecimento de Padrões
*   **Arquitetura Orientada a Eventos (EDA):** Utilização de filas de mensagens (Pub/Sub) para desacoplar módulos, padrão comum em sistemas como Uber e Netflix.
*   **Cache de Dados:** Implementação de camadas de cache (Redis) para consultas frequentes de coordenadas, similar a sistemas de geolocalização de alta performance.

### 3. Abstração
*   Modelagem de entidades através de **Diagramas de Classes UML** e **Diagramas de Sequência**, focando nas interações críticas e ocultando detalhes de implementação de hardware.
*   Uso de interfaces para permitir a troca de provedores de mapas (Google Maps/Mapbox) sem alterar o core do sistema.

### 4. Algoritmos
*   **Dijkstra Adaptado:** Para cálculo de menor caminho em grafos de tráfego dinâmico.
*   **Janelamento (Sliding Window):** Algoritmo para cálculo de velocidade média e consumo de combustível em janelas de tempo reais.

---

## 🛠 Metodologia e Ferramentas
*   **Framework:** Scrum (Sprints quinzenais com cerimônias de Review e Retrospective).
*   **Gestão Visual:** Kanban avançado via GitHub Projects.
*   **Versionamento:** Git Flow (Main, Develop, Feature, Hotfix).
*   **Infraestrutura Sugerida:** Docker para conteinerização e Kubernetes para orquestração.

---

## ⚠️ Desafios de Larga Escala e Soluções
*   **Disponibilidade (99.9%):** Implementação de redundância e *Circuit Breaker* para evitar falhas em cascata.
*   **Consistência de Dados:** Aplicação do **Teorema CAP**, priorizando Disponibilidade e Particionamento.
*   **Segurança:** Criptografia de ponta a ponta e auditoria de logs conforme os princípios de **Saltzer & Schroeder** para proteção de dados sensíveis de clientes e rotas.

---
**Desenvolvido como requisito acadêmico para o curso de Engenharia de Software.**
