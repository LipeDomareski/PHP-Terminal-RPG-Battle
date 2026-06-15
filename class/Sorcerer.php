<?php

class Sorcerer extends Character {

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
    $magicDamage = (int)(($this->intelligence * 3.0) + ($this->attunement * 0.8));
    return $magicDamage + 20 + rand(0, 10);
}

    public function castSpell(): int {
        if ($this->stamina >= 25) {
            $this->stamina -= 25;
            echo "{$this->getName()} Conjure an Arcane Blast!\n";
            return (int)($this->intelligence * 4.0);
        } else {
            echo "{$this->getName()} It doesn't have enough magical energy!\n";
            return 0;
        }
    }
    public function getSpecialName(): string {
        return "castSpell";
    }
        
    public function useSpecial(): int {
        return $this->castSpell();
    }
}