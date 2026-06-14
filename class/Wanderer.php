<?php

require_once 'routes/routes.php';

class Wanderer extends Character {

    public function __construct(
        string $name, int $vitality, int $attunement, int $endurance, 
        int $strength, int $dexterity, int $resistance, int $intelligence, int $faith
    ) {
        $hp = $vitality * 10;
        $defense = $resistance * 3;
        $stamina = $endurance * 6;
        parent::__construct($name, $vitality, $attunement, $endurance, $strength, $dexterity, $resistance, $intelligence, $faith, $hp, $defense, $stamina, false);
    }

    public function attack(): int {
        $dano = ($this->dexterity * 2.2) + ($this->strength * 0.3);
        if (rand(1, 100) <= 20) {
            echo "Ataque Crítico! ";
            return (int)($dano * 1.5);
        }
        
        return (int)$dano;
    }

    public function dodge(): bool {
        $chanceEsquiva = $this->dexterity * 2;
        return (rand(1, 100) <= $chanceEsquiva);
    }
}