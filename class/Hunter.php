<?php


class Hunter extends Character {

    public function __construct(
        string $name, int $vitality, int $attunement, int $endurance, 
        int $strength, int $dexterity, int $resistance, int $intelligence, int $faith
    ) {
        $hp = $vitality * 9;
        $defense = $resistance * 2;
        $stamina = $endurance * 7;
        parent::__construct($name, $vitality, $attunement, $endurance, $strength, $dexterity, $resistance, $intelligence, $faith, $hp, $defense, $stamina, false);
    }

public function attack(): int {
    $damage = (int)($this->dexterity * 2.2) + 12;
    $isCritical = rand(1, 10) > 8;
    return $isCritical ? (int)($damage * 1.5) : $damage;
}

    public function trapShot(): int {
        echo "{$this->getName()} He fires a precise arrow that traps the enemy!\n";
        $this->stamina -= 10;

        return (int)($this->dexterity * 2.5);
    }

    public function getSpecialName(): string {
        return "trapShot";
    }
        
    public function useSpecial(): int {
        return $this->trapShot();
    }
}