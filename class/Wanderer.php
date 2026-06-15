<?php

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
        $damage = ($this->dexterity * 2.2) + ($this->strength * 0.3);
        
        // Critical hit chance
        if (rand(1, 100) <= 20) {
            echo "Critical Hit! ";
            return (int)($damage * 1.5);
        }
        
        return (int)$damage;
    }

    // Logic for dodging
    public function dodge(): bool {
        $dodgeChance = $this->dexterity * 2;
        return (rand(1, 100) <= $dodgeChance);
    }

    public function getSpecialName(): string {
        return "Dodge";
    }
        
    public function useSpecial(): int {
        $isSuccessful = $this->dodge();
        
        if ($isSuccessful) {
            echo "{$this->getName()} performed a perfect dodge!\n";
        } else {
            echo "{$this->getName()} tried to dodge but failed!\n";
        }

        // Returns 0 damage because dodging does not attack the opponent
        return 0;
    }
}