<?php

require_once 'routes/routes.php';

class Warrior extends Character {
    
public function __construct(
        string $name, int $vitality, int $attunement, int $endurance, 
        int $strength, int $dexterity, int $resistance, int $intelligence, int $faith
    ) {
        $hp = $vitality * 11;
        $defense = $resistance * 3;
        $stamina = $endurance * 6;
        parent::__construct($name, $vitality, $attunement, $endurance, $strength, $dexterity, $resistance, $intelligence, $faith, $hp, $defense, $stamina, false);
    }
    
    public function attack(): int {
        $baseDamage = ($this->strength * 2) + ($this->dexterity * 0.5);   
        $randomFactor = rand(1, 10);        
        return (int)($baseDamage + $randomFactor);
    }

    public function heavyAttack(): int {
        if ($this->stamina >= 20) {
            $this->stamina -= 20;
            echo "{$this->getName()} Execute a Heavy Attack!\n";
            return $this->attack() * 2;
        } else {
            echo "Insufficient stamina for Heavy Attack!\n";
            return 0;
        }
    }
}