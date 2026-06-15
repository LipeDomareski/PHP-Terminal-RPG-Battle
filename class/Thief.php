<?php


class Thief extends Character {

    public function __construct(
        string $name, int $vitality, int $attunement, int $endurance, 
        int $strength, int $dexterity, int $resistance, int $intelligence, int $faith
    ) {
        $hp = $vitality * 9;
        $defense = $resistance * 2;
        $stamina = $endurance * 8;
        parent::__construct($name, $vitality, $attunement, $endurance, $strength, $dexterity, $resistance, $intelligence, $faith, $hp, $defense, $stamina, false);
    }

public function attack(): int {
    $damage = (int)($this->dexterity * 2.0) + 12;
    $isCritical = rand(1, 10) > 6; 
    return $isCritical ? (int)($damage * 1.5) : $damage;
}

    public function backstab(Character $target): int {
        echo "{$this->getName()} He executes a backstab!\n";
        $dano = ($this->strength * 0.5) + ($this->dexterity * 2.5);
        $this->stamina += 15;   
        return (int)$dano;
    }
        public function getSpecialName(): string {
        return "backstab";
    }
        
    public function useSpecial(): int {
        return $this->backstab(); // Chama o original aqui
    }
}