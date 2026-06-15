<?php
require_once __DIR__ . '/../routes/routes.php';

$batalha = new BattleManager();

$batalha->startBattle();

//Para iniciar o aquivo só colar
//php battle/battle.php