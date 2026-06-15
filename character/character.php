<?php

abstract class Character {
    private string $name; // nome
    protected int $vitality; // vitalidade
    protected int $attunement; // conhecimento
    protected int $endurance; // fortitude
    protected int $strength; // força
    protected int $dexterity; // destreza
    protected int $resistance; // resistencia
    protected int $intelligence; // inteligencia
    protected int $faith; // fé
    protected int $hp; // hp
    protected int $defense; // defesa
    protected int $stamina; // estamina
    protected bool $isBlocking = false; //defesa

    public function __construct(
        string $name, int $vitality, int $attunement, int $endurance, 
        int $strength, int $dexterity, int $resistance, int $intelligence, int $faith, 
        int $hp, int $defense, int $stamina, bool $isBlocking
    ) {
        $this->name = $name;
        $this->vitality = $vitality;
        $this->attunement = $attunement;
        $this->endurance = $endurance;
        $this->strength = $strength;
        $this->dexterity = $dexterity;
        $this->resistance = $resistance;
        $this->intelligence = $intelligence;
        $this->faith = $faith;
        $this->hp = $hp;
        $this->defense = $defense;
        $this->stamina = $stamina;
        $this->isBlocking = $isBlocking;
    }

abstract public function attack(): int;

public function takeDamage(int $damage): void {
        $totaldefense = $this->resistance * 2;
        
        if ($this->isBlocking) {
            $drenStamina = (int)($damage * 0.3);
            
            if ($this->stamina >= $drenStamina) {
                $this->stamina -= $drenStamina;
                $damage = (int)($damage * 0.1);
                echo "{$this->name} bloqueou com sucesso, mas perdeu {$drenStamina} de estamina!\n";
            } else {
                echo "{$this->name} tentou bloquear, mas não tinha estamina suficiente!\n";
            }
        }

        $finalDamage = max(0, $damage - $totaldefense);
        $this->hp -= $finalDamage;
        $this->isBlocking = false;
}

public function recuperarEstamina(): void {
    $this->stamina += 10;
    if ($this->stamina > 100) $this->stamina = $this->endurance * 2;
}

// -- GETTERS --

    public function getName(): string{ return $this->name; }
    public function getVitality(): int { return $this->vitality; }
    public function getAttunement(): int{ return $this->attunement; }
    public function getEndurance(): int{ return $this->endurance; }
    public function getStrength(): int{ return $this->strength; }
    public function getDexterity(): int{return $this->dexterity;}
    public function getResistance(): int{return $this->resistance;}
    public function getIntelligence(): int{return $this->intelligence;}
    public function getFaith(): int{return $this->faith;}
    public function getHp(): int{return $this->hp;}
    public function getDefense(): int{return $this->defense;}
    public function getStamina(): int{return $this->stamina;}
    public function getIsBlocking(): bool{return $this->isBlocking;}


}
