<?php

class Knight extends Character {

    public function __construct(
        string $name, int $vitality, int $attunement, int $endurance, 
        int $strength, int $dexterity, int $resistance, int $intelligence, int $faith
    ) {
        $hp = $vitality * 12;
        $defense = $resistance * 4;
        $stamina = $endurance * 5;
        parent::__construct($name, $vitality, $attunement, $endurance, $strength, $dexterity, $resistance, $intelligence, $faith, $hp, $defense, $stamina, false);
    }

public function attack(): int {
    $damage = (int)(($this->strength * 3.0) + 15); 
    return $damage + rand(0, 10);
}

    public function ironFlesh(): void {
        echo "{$this->getName()} It assumes an impenetrable defensive posture!\n";
        $this->isBlocking = true; 
    }
}