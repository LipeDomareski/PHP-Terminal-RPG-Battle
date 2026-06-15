<?php

class Pyromancer extends Character {

    public function __construct(
        string $name, int $vitality, int $attunement, int $endurance, 
        int $strength, int $dexterity, int $resistance, int $intelligence, int $faith
    ) {
        $hp = $vitality * 10;
        $defense = $resistance * 3;
        $stamina = $endurance * 5;
        parent::__construct($name, $vitality, $attunement, $endurance, $strength, $dexterity, $resistance, $intelligence, $faith, $hp, $defense, $stamina, false);
    }

public function attack(): int {
    return 20 + (int)(($this->intelligence * 1.5) + ($this->faith * 1.5));
}

    public function immolation(): void {
        $danoProprio = (int)($this->hp * 0.1);
        $this->takeDamage($danoProprio);
        
        echo "{$this->getName()} It gets engulfed in flames! Reduced HP, but increased power.\n";
    }

    public function getSpecialName(): string {
        return "immolation";
    }
        
    public function useSpecial(): int {
        return $this->immolation();
        return 0;
    }
}