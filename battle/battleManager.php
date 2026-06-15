<?php

class BattleManager {

    private array $stamina = [];
    private array $isDefending = [];
    private array $logs = [];
    private int $maxStamina = 100;

    public function startBattle(): void {
        $p1 = CharacterFactory::create();
        $p2 = CharacterFactory::create();

        $this->stamina[$p1->getName()] = $this->maxStamina;
        $this->stamina[$p2->getName()] = $this->maxStamina;
        $this->isDefending = [$p1->getName() => false, $p2->getName() => false];

        echo "\n>> Battle started! {$p1->getName()} vs {$p2->getName()}\n";
        readline('Press ENTER to start...');

        $this->battleLoop($p1, $p2);
    }

    private function battleLoop(Character $p1, Character $p2): void {
        $turn = 1;

        while ($p1->getHp() > 0 && $p2->getHp() > 0) {
            echo "\n--- TURN $turn ---\n";
            $this->regenerateStamina($p1, $p2, $turn);
            
            BattleUI::displayStatus($p1, $p2, $this->stamina, $this->isDefending);
            
            $this->executeTurn($p1, $p2, $turn);
            if ($p2->getHp() > 0) $this->executeTurn($p2, $p1, $turn);

            $turn++;
        }
        $this->saveLog($p1->getName(), $p2->getName());
    }

    private function executeTurn(Character $attacker, Character $defender, int $turn): void {
        echo "\n{$attacker->getName()}'s turn (" . get_class($attacker) . ")\n";
        echo "1-Attack | 2-Special ({$attacker->getSpecialName()}) | 3-Defend\n";
        
        $action = readline("Choose [1/2/3]: ");

        switch ($action) {
            case '2':
                $this->handleSpecial($attacker, $defender, $turn);
                break;
            case '3':
                $this->isDefending[$attacker->getName()] = true;
                echo "{$attacker->getName()} is in defensive stance!\n";
                $this->logs[] = "Turn $turn: {$attacker->getName()} defended.";
                break;
            default:
                $this->handleNormalAttack($attacker, $defender, $turn);
        }
    }

    private function handleNormalAttack(Character $attacker, Character $defender, int $turn): void {
        $damage = $attacker->attack();
        
        if ($this->isDefending[$defender->getName()]) {
            $damage = (int)($damage * 0.5);
            echo "Blocked! Damage reduced to $damage.\n";
            $this->isDefending[$defender->getName()] = false;
        }

        $defender->takeDamage($damage);
        echo "Normal Attack! Damage: $damage\n";
        $this->logs[] = "Turn $turn: {$attacker->getName()} dealt $damage damage.";
    }

    private function handleSpecial(Character $attacker, Character $defender, int $turn): void {
        $cost = 20;
        if ($this->stamina[$attacker->getName()] >= $cost) {
            $this->stamina[$attacker->getName()] -= $cost;
            $damage = $attacker->useSpecial(); 
            $defender->takeDamage($damage);
            echo "Special Ability used! Damage: $damage\n";
            $this->logs[] = "Turn $turn: {$attacker->getName()} used special. Damage: $damage";
        } else {
            echo "Not enough stamina! Defaulting to normal attack.\n";
            $this->handleNormalAttack($attacker, $defender, $turn);
        }
    }

    private function regenerateStamina(Character $p1, Character $p2, int $turn): void {
        if ($turn % 2 === 0) {
            foreach ([$p1, $p2] as $char) {
                if ($this->stamina[$char->getName()] < $this->maxStamina) {
                    $this->stamina[$char->getName()]++;
                    echo "🔥 {$char->getName()} recovered stamina!\n";
                }
            }
        }
    }

    private function saveLog(string $p1Name, string $p2Name): void {
        $dir = __DIR__ . '/../battle/logs';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        
        $filename = $dir . '/battle_' . date('Ymd_His') . ".txt";
        file_put_contents($filename, implode("\n", $this->logs));
        echo "\n📜 Battle finished. Log saved: $filename\n";
    }
}