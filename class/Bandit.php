<?php

class Bandit extends Character {

    public function __construct(
        string $name, int $vitality, int $attunement, int $endurance, 
        int $strength, int $dexterity, int $resistance, int $intelligence, int $faith
    ) {
        $hp = $vitality * 10;
        $stamina = $endurance * 3;
        $defense = $resistance * 7;

        parent::__construct($name, $vitality, $attunement, $endurance, $strength, $dexterity, $resistance, $intelligence, $faith, $hp, $defense, $stamina, false);
    }

    public function attack(): int {
        $baseDamage = (int)($this->strength * 2.5);
        $finalDamage = $baseDamage + 15; 
        return $finalDamage + rand(0, 10);
    }



    public function wildSwing(): int {
        echo "{$this->getName()} He lets out a wild cry and delivers a brutal blow!\n";
        
        $this->stamina -= 10;
        return (int)($this->strength * 3.5);
    }
    
    public function getSpecialName(): string {
        return "Wild Swing";
    }
        
    public function useSpecial(): int {
        return $this->wildSwing(); // Chama o original aqui
    }
            
}