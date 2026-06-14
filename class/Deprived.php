<?php

class Deprived extends Character {

    public function __construct(
        string $name, int $vitality, int $attunement, int $endurance, 
        int $strength, int $dexterity, int $resistance, int $intelligence, int $faith
    ) {
        $hp = $vitality * 8;
        $defense = $resistance * 2;
        $stamina = $endurance * 5;
        parent::__construct($name, $vitality, $attunement, $endurance, $strength, $dexterity, $resistance, $intelligence, $faith, $hp, $defense, $stamina, false);
    }

public function attack(): int {
    return (int)(($this->strength + $this->dexterity) * 0.8) + 10;
}

    public function adapt(string $atributo): void {
        echo "{$this->getName()} Focus on your survival instincts!\n";
        
        if (property_exists($this, $atributo)) {
            $this->$atributo += 10;
        }
    }
}