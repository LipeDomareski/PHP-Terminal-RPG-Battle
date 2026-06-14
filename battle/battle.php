<?php
// 1. Carrega as rotas que fazem o "include" de todas as suas classes
require_once __DIR__ . '/../routes/routes.php';

// 2. Instancia o Gerenciador de Batalha
$batalha = new BattleManager();

// 3. AGORA SIM: Chama o método que inicia a luta (o `startBattle` que criamos)
$batalha->startBattle();

//php battle/battle.php