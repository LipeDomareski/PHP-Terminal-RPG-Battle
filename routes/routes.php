<?php

//==========| CONFIG |=============
require_once __DIR__ .'/../config.php';

//==============| CHARACTER |==================================
require_once __DIR__ . '/../character/character.php';
require_once __DIR__ . '/../battle/factory.php';

//=====================| CLASS |===============================
require_once __DIR__ . '/../class/Bandit.php';
require_once __DIR__ . '/../class/Cleric.php';
require_once __DIR__ . '/../class/Deprived.php';
require_once __DIR__ . '/../class/Hunter.php';
require_once __DIR__ . '/../class/Knight.php';
require_once __DIR__ . '/../class/Pyromancer.php';
require_once __DIR__ . '/../class/Sorcerer.php';
require_once __DIR__ . '/../class/Thief.php';
require_once __DIR__ . '/../class/Wanderer.php';
require_once __DIR__ . '/../class/Warrior.php';
//=============================================================


//===============| BATTLE |=====================
require_once __DIR__ . '/../battle/battle.php';
require_once __DIR__ . '/../battle/battleManager.php';
require_once __DIR__ . '/../battle/battleUi.php';
