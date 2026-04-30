<?php
/**
 * URBANFLOW - Protótipo de Sistema de Larga Escala
 * Disciplina: Pensamento Computacional
 */

// --- 1. ABSTRAÇÃO E DOMÍNIO ---
// Definimos o que é um evento de telemetria no nosso sistema
class TelemetryEvent {
    public $vehicleId;
    public $lat;
    public $lng;
    public $speed;

    public function __construct($id, $lat, $lng, $speed) {
        $this->vehicleId = $id;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->speed = $speed;
    }
}

// --- 2. PADRÕES E ALGORITMOS (Simulação de Larga Escala) ---
class UrbanFlowEngine {
    private $logs = [];

    public function process($event) {
        // Reconhecimento de Padrão: Verificação de excesso de velocidade
        $status = ($event->speed > 80) ? "⚠️ ALERTA: Velocidade Alta" : "✅ Normal";
        
        // Simulação de Decomposição: O dado seria enviado para uma fila (ex: RabbitMQ)
        // Aqui apenas simulamos o armazenamento em memória
        $this->logs[] = [
            "time" => date("H:i:s"),
            "vehicle" => $event->vehicleId,
            "pos" => "{$event->lat}, {$event->lng}",
            "speed" => $event->speed . " km/h",
            "status" => $status
        ];
    }

    public function getLogs() {
        return $this->logs;
    }
}

// --- 3. EXECUÇÃO DO PROTÓTIPO ---
$engine = new UrbanFlowEngine();

// Simulando a chegada de dados de diferentes fontes (Decomposição do tráfego)
$engine->process(new TelemetryEvent("CAMINHAO-01", -23.5505, -46.6333, 65));
$engine->process(new TelemetryEvent("MOTO-04", -23.5510, -46.6340, 92));
$engine->process(new TelemetryEvent("VAN-12", -23.5520, -46.6350, 40));

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>UrbanFlow - Dashboard Protótipo</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f9; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #3498db; color: white; }
        .alert { color: #e74c3c; font-weight: bold; }
        .badge { background: #ecf0f1; padding: 5px 10px; border-radius: 4px; font-size: 0.8em; }
    </style>
</head>
<body>

<div class="container">
    <h1>UrbanFlow <small style="font-size: 0.5em; color: #7f8c8d;">Larga Escala Engine v1.0</small></h1>
    <p><strong>Status do Sistema:</strong> <span style="color: #27ae60;">Monitorando frotas em tempo real...</span></p>

    <table>
        <thead>
            <tr>
                <th>Horário</th>
                <th>Veículo</th>
                <th>Coordenadas</th>
                <th>Velocidade</th>
                <th>Status (IA)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($engine->getLogs() as $log): ?>
            <tr>
                <td><span class="badge"><?php echo $log['time']; ?></span></td>
                <td><strong><?php echo $log['vehicle']; ?></strong></td>
                <td><?php echo $log['pos']; ?></td>
                <td><?php echo $log['speed']; ?></td>
                <td class="<?php echo strpos($log['status'], '⚠️') !== false ? 'alert' : ''; ?>">
                    <?php echo $log['status']; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top: 30px; font-size: 0.9em; color: #95a5a6; border-top: 1px solid #eee; pt: 10px;">
        <strong>Conceitos Aplicados:</strong> 
        Abstração de Entidades | Reconhecimento de Padrões de Risco | Processamento Assíncrono Simulado.
    </div>
</div>

</body>
</html>
