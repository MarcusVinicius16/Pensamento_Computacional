<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanFlow - Sistema de Monitoramento Logístico</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0b0f17; color: #e2e8f0; }
        .bg-card { background-color: #111827; }
        .sidebar-item-active { background-color: #1e293b; border-left: 4px solid #3b82f6; }
        .map-bg { background: radial-gradient(circle, #1e293b 0%, #0f172a 100%); }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <!-- Barra Lateral (Sidebar) -->
    <aside class="w-64 bg-card flex flex-col border-r border-gray-800">
        <div class="p-6 flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <i data-lucide="layout-grid" class="text-white"></i>
            </div>
            <div>
                <h1 class="font-bold text-lg leading-tight">UrbanFlow</h1>
                <p class="text-[10px] text-gray-500 uppercase tracking-tighter">Sistema de Monitoramento</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1 overflow-y-auto custom-scrollbar">
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg sidebar-item-active text-blue-400">
                <i data-lucide="home" class="w-5 h-5"></i> Visão Geral
            </a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:bg-gray-800 transition">
                <i data-lucide="map" class="w-5 h-5"></i> Mapa
            </a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:bg-gray-800 transition">
                <i data-lucide="truck" class="w-5 h-5"></i> Frota
            </a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:bg-gray-800 transition">
                <i data-lucide="activity" class="w-5 h-5"></i> Telemetria
            </a>
            <div class="flex items-center justify-between p-3 rounded-lg text-gray-400 hover:bg-gray-800 transition cursor-pointer">
                <div class="flex items-center gap-3">
                    <i data-lucide="bell" class="w-5 h-5"></i> Alertas
                </div>
                <span class="bg-orange-500 text-white text-[10px] px-1.5 py-0.5 rounded-full font-bold">7</span>
            </div>
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:bg-gray-800 transition">
                <i data-lucide="navigation" class="w-5 h-5"></i> Rotas
            </a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:bg-gray-800 transition">
                <i data-lucide="file-text" class="w-5 h-5"></i> Relatórios
            </a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:bg-gray-800 transition">
                <i data-lucide="bar-chart-2" class="w-5 h-5"></i> Analíticos
            </a>
            <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:bg-gray-800 transition">
                <i data-lucide="settings" class="w-5 h-5"></i> Configurações
            </a>
        </nav>

        <div class="p-4 border-t border-gray-800">
            <div class="flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=374151&color=fff" class="w-10 h-10 rounded-full border border-gray-700" alt="Avatar">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate">Usuário Admin</p>
                    <p class="text-[10px] text-gray-500 truncate">admin@urbanflow.com.br</p>
                </div>
                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
            </div>
        </div>
    </aside>

    <!-- Conteúdo Principal -->
    <main class="flex-1 flex flex-col overflow-hidden p-6 gap-6">
        
        <!-- Cabeçalho -->
        <header class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold">Visão Geral</h2>
                <p class="text-sm text-gray-500">Monitoramento de frota e analíticos em tempo real</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative p-2 bg-card rounded-lg border border-gray-800">
                    <i data-lucide="bell" class="w-5 h-5 text-gray-400"></i>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-yellow-500 rounded-full"></span>
                </div>
                <div class="flex gap-2 bg-card border border-gray-800 rounded-lg p-1">
                    <button class="px-3 py-1 text-sm text-gray-300">24 de Maio, 2025</button>
                    <button class="px-3 py-1 text-sm bg-gray-800 rounded-md">Última 1 hora</button>
                </div>
                <button class="flex items-center gap-2 bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                    <i data-lucide="filter" class="w-4 h-4"></i> Filtros
                </button>
            </div>
        </header>

        <!-- Grade do Dashboard -->
        <div class="flex-1 grid grid-cols-12 gap-6 overflow-hidden">
            
            <!-- Coluna Esquerda: Mapa e Status -->
            <div class="col-span-8 flex flex-col gap-6">
                <!-- Área do Mapa -->
                <div class="flex-1 bg-[#0f172a] rounded-2xl border border-gray-800 relative overflow-hidden shadow-2xl">
                    
                    <!-- Desenho das Rotas (SVG) -->
                    <svg class="absolute inset-0 w-full h-full opacity-40" viewBox="0 0 800 500" fill="none">
                        <path d="M0 150H800M0 350H800M250 0V500M550 0V500M0 400L800 100" stroke="#1e293b" stroke-width="1.5"/>
                        <path d="M150 150 L350 250 L450 420 L530 450" stroke="#3b82f6" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M550 100 L450 250 L350 250" stroke="#3b82f6" stroke-width="3" stroke-linecap="round" />
                        <path d="M150 150 L350 250 L450 420 L530 450" stroke="#3b82f6" stroke-width="6" class="opacity-20 blur-sm" />
                    </svg>

                    <!-- Nomes das Regiões -->
                    <div class="absolute top-[20%] left-[45%] text-[10px] font-bold text-gray-600 tracking-widest uppercase">LAKEVIEW</div>
                    <div class="absolute top-[35%] left-[25%] text-[10px] font-bold text-gray-600 tracking-widest uppercase">RIVERSIDE</div>
                    <div class="absolute top-[50%] left-[42%] text-[10px] font-bold text-blue-500/40 tracking-widest uppercase">CENTRO</div>
                    <div class="absolute top-[60%] right-[15%] text-[10px] font-bold text-gray-600 tracking-widest uppercase">EASTWOOD</div>

                    <!-- Badge Superior -->
                    <div class="absolute top-6 left-6 bg-black/60 backdrop-blur-md p-3 rounded-xl border border-white/10 z-10">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-xs font-semibold">Rastreamento Vivo</span>
                        </div>
                        <p class="text-[10px] text-gray-400">128 Veículos Online</p>
                    </div>

                    <!-- Caminhões com efeito Glow -->
                    <div class="absolute top-[140px] left-[140px] group cursor-pointer">
                        <div class="absolute -inset-4 bg-blue-500/20 rounded-full blur-xl"></div>
                        <div class="relative bg-blue-600 p-1.5 rounded-lg border border-blue-400">
                            <i data-lucide="truck" class="w-4 h-4 text-white"></i>
                        </div>
                    </div>
                    <div class="absolute top-[240px] left-[340px]">
                        <div class="absolute -inset-4 bg-orange-500/20 rounded-full blur-xl"></div>
                        <div class="relative bg-orange-500 p-1.5 rounded-lg border border-orange-300">
                            <i data-lucide="truck" class="w-4 h-4 text-white"></i>
                        </div>
                    </div>
                    <div class="absolute top-[410px] left-[440px]">
                        <div class="absolute -inset-4 bg-red-500/20 rounded-full blur-xl"></div>
                        <div class="relative bg-red-600 p-1.5 rounded-lg border border-red-400">
                            <i data-lucide="truck" class="w-4 h-4 text-white"></i>
                        </div>
                    </div>

                    <!-- Legenda Inferior Esquerda -->
                    <div class="absolute bottom-6 left-6 bg-black/40 backdrop-blur-md p-3 rounded-lg border border-white/5 text-[10px] space-y-1.5">
                        <div class="flex items-center gap-2 text-gray-300">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Normal
                        </div>
                        <div class="flex items-center gap-2 text-gray-300">
                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span> Aviso
                        </div>
                        <div class="flex items-center gap-2 text-gray-300">
                            <span class="w-2 h-2 bg-red-500 rounded-full"></span> Crítico
                        </div>
                    </div>

                    <!-- Controles -->
                    <div class="absolute bottom-6 right-6 flex flex-col gap-2">
                        <button class="w-8 h-8 bg-gray-800/80 rounded flex items-center justify-center border border-gray-700 text-gray-400"><i data-lucide="maximize" class="w-4 h-4"></i></button>
                        <button class="w-8 h-8 bg-gray-800/80 rounded flex items-center justify-center border border-gray-700 text-gray-400"><i data-lucide="plus" class="w-4 h-4"></i></button>
                        <button class="w-8 h-8 bg-gray-800/80 rounded flex items-center justify-center border border-gray-700 text-gray-400"><i data-lucide="minus" class="w-4 h-4"></i></button>
                    </div>
                </div>

                <!-- Métricas Inferiores -->
                <div class="grid grid-cols-2 gap-6 h-60">
                    <div class="bg-card rounded-2xl border border-gray-800 p-6 flex flex-col justify-between">
                        <h3 class="font-semibold text-sm">Status da Frota</h3>
                        <div class="flex items-center justify-between">
                            <div class="relative flex items-center justify-center">
                                <svg class="w-28 h-28 transform -rotate-90">
                                    <circle cx="56" cy="56" r="45" stroke="#1f2937" stroke-width="10" fill="transparent" />
                                    <circle cx="56" cy="56" r="45" stroke="#3b82f6" stroke-width="10" fill="transparent" stroke-dasharray="282" stroke-dashoffset="70" />
                                </svg>
                                <div class="absolute text-center">
                                    <p class="text-xl font-bold">128</p>
                                    <p class="text-[9px] text-gray-500 uppercase">Total</p>
                                </div>
                            </div>
                            <div class="space-y-3 text-xs pr-4">
                                <div class="flex items-center gap-2 text-gray-400"><span class="w-2 h-2 bg-blue-500 rounded-full"></span> 102 Em Rota</div>
                                <div class="flex items-center gap-2 text-gray-400"><span class="w-2 h-2 bg-orange-500 rounded-full"></span> 18 Inativos</div>
                                <div class="flex items-center gap-2 text-gray-400"><span class="w-2 h-2 bg-red-500 rounded-full"></span> 8 Atrasados</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-card rounded-2xl border border-gray-800 p-6">
                        <div class="flex justify-between mb-4">
                            <h3 class="font-semibold text-sm">Otimização de Rotas</h3>
                            <span class="text-blue-400 text-[10px] font-bold cursor-pointer uppercase">Ver completo</span>
                        </div>
                        <div class="flex gap-6 mb-4">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase">Distância Salva</p>
                                <p class="text-lg font-bold">1,248 km <span class="text-green-500 text-xs ml-1">↑18%</span></p>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase">Redução CO₂</p>
                                <p class="text-lg font-bold">845 kg <span class="text-green-500 text-xs ml-1">↑15%</span></p>
                            </div>
                        </div>
                        <div class="w-full h-12 flex items-end gap-1 overflow-hidden">
                            <div class="flex-1 bg-blue-600/20 h-[30%] rounded-t"></div>
                            <div class="flex-1 bg-blue-600/40 h-[60%] rounded-t"></div>
                            <div class="flex-1 bg-blue-600/60 h-[45%] rounded-t"></div>
                            <div class="flex-1 bg-blue-600/30 h-[90%] rounded-t"></div>
                            <div class="flex-1 bg-blue-600/80 h-[70%] rounded-t"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna Direita: Telemetria e Alertas -->
            <div class="col-span-4 flex flex-col gap-6">
                <!-- Telemetria Viva -->
                <div class="bg-card rounded-2xl border border-gray-800 p-5 space-y-4">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold text-sm">Telemetria em Tempo Real</h3>
                        <a href="#" class="text-blue-400 text-xs font-bold uppercase">Ver tudo</a>
                    </div>
                    <div class="space-y-4 text-sm">
                        <div class="flex items-center justify-between border-b border-gray-800 pb-2">
                            <div class="flex items-center gap-3 text-gray-400"><i data-lucide="truck" class="w-4 h-4"></i> Total de Veículos</div>
                            <span class="font-bold">128 <span class="text-[10px] text-blue-500 ml-1">(94%)</span></span>
                        </div>
                        <div class="flex items-center justify-between border-b border-gray-800 pb-2">
                            <div class="flex items-center gap-3 text-gray-400"><i data-lucide="gauge" class="w-4 h-4"></i> Velocidade Média</div>
                            <span class="font-bold">62 km/h</span>
                        </div>
                        <div class="flex items-center justify-between border-b border-gray-800 pb-2">
                            <div class="flex items-center gap-3 text-gray-400"><i data-lucide="fuel" class="w-4 h-4"></i> Eficiência de Comb.</div>
                            <span class="text-green-500 font-bold">Excelente</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 text-gray-400"><i data-lucide="milestone" class="w-4 h-4"></i> Distância Total</div>
                            <span class="font-bold">5,420 km</span>
                        </div>
                    </div>
                </div>

                <!-- Alertas de Velocidade -->
                <div class="bg-card rounded-2xl border border-gray-800 p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-sm">Alertas de Velocidade</h3>
                        <a href="#" class="text-blue-400 text-xs font-bold uppercase">Ver todos</a>
                    </div>
                    <div class="space-y-3 flex-1 overflow-y-auto custom-scrollbar">
                        <div class="p-3 bg-red-500/10 border border-red-500/20 rounded-xl flex items-center gap-3">
                            <div class="bg-red-500 p-2 rounded-lg text-white"><i data-lucide="zap" class="w-4 h-4"></i></div>
                            <div class="flex-1">
                                <p class="text-xs font-bold text-red-400">Excesso Detectado</p>
                                <p class="text-[10px] text-gray-500">Caminhão TRK-1023</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-bold text-red-500">120 km/h</p>
                                <p class="text-[9px] text-gray-600">há 2 min</p>
                            </div>
                        </div>
                        <div class="p-3 bg-orange-500/10 border border-orange-500/20 rounded-xl flex items-center gap-3">
                            <div class="bg-orange-500 p-2 rounded-lg text-white"><i data-lucide="alert-triangle" class="w-4 h-4"></i></div>
                            <div class="flex-1">
                                <p class="text-xs font-bold text-orange-400">Excesso Detectado</p>
                                <p class="text-[10px] text-gray-500">Caminhão TRK-0876</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-bold text-orange-500">95 km/h</p>
                                <p class="text-[9px] text-gray-600">há 5 min</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Atividade Recente -->
                <div class="bg-card rounded-2xl border border-gray-800 p-5">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-sm text-gray-300">Atividade Recente</h3>
                        <a href="#" class="text-blue-400 text-xs font-bold uppercase">Ver tudo</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 text-[11px]">
                            <i data-lucide="check-circle" class="w-3.5 h-3.5 text-blue-500"></i>
                            <span class="flex-1 text-gray-400">TRK-1023 concluiu entrega</span>
                            <span class="text-gray-600">2 min</span>
                        </div>
                        <div class="flex items-center gap-3 text-[11px]">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5 text-orange-500"></i>
                            <span class="flex-1 text-gray-400">Novo alerta de velocidade</span>
                            <span class="text-gray-600">5 min</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
