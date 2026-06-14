<?php

class Cleric extends Character {

    public function __construct(
        string $name, int $vitality, int $attunement, int $endurance, 
        int $strength, int $dexterity, int $resistance, int $intelligence, int $faith
    ) {

        $hp = $vitality * 10;
        $stamina = $endurance * 5;
        $defense = $resistance * 2;

        parent::__construct(
            $name, $vitality, $attunement, $endurance,
             $strength, $dexterity, $resistance, $intelligence, $faith,
             $hp, $defense, $stamina, false
             );
    }

public function attack(): int {
    $power = (int)(($this->faith * 2.0) + ($this->strength * 0.5));
    return $power + 15 + rand(0, 8);
}

public function heal(): void {
        $custo = 30;
        if ($this->stamina >= $custo) {
            $this->stamina -= $custo;
            $cura = (int)($this->faith * 2.5);
            $this->hp += $cura;
            echo "{$this->getName()} He invoked a miracle! HP +{$cura}\n";
        } else {
            echo "{$this->getName()} He's out of stamina!\n";
        }
    }
}