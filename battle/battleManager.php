<?php

class BattleManager {

    private array $stamina = [];
    private int $maxStamina = 100;
    private array $isDefending = [];
    private array $logs = [];

    public function startBattle(): void {
        $p1 = CharacterFactory::create();
        $p2 = CharacterFactory::create();

        $this->stamina[$p1->getName()] = $this->maxStamina;
        $this->stamina[$p2->getName()] = $this->maxStamina;

        echo "\n>> A batalha começou! {$p1->getName()} vs {$p2->getName()}\n";
        readline('Pressione ENTER para começar...');

        $this->startBattleLoop($p1, $p2);
    }
        
    private function startBattleLoop(Character $p1, Character $p2): void {
        $turn = 1;
        $this->isDefending = [$p1->getName() => false, $p2->getName() => false];

        while ($p1->getHp() > 0 && $p2->getHp() > 0) {
            echo "\n--- TURNO $turn ---\n";

            if ($turn % 2 === 0) {
                foreach ([$p1, $p2] as $char) {
                    if ($this->stamina[$char->getName()] < $this->maxStamina) {
                        $this->stamina[$char->getName()]++;
                        echo "🔥 {$char->getName()} recuperou estamina!\n";
                    }
                }
            }

            // Chamada correta do método fora do loop
            $this->exibirStatus($p1, $p2, $this->stamina);
            
            $this->turno($p1, $p2, $turn);
            if ($p2->getHp() > 0) $this->turno($p2, $p1, $turn);

            $turn++;
        }
        $this->salvarLog($p1->getName(), $p2->getName());
    }

    // O método exibirStatus agora está no lugar correto (fora do loop)
    private function exibirStatus(Character $p1, Character $p2, array $stamina): void {
        BattleUI::displayStatus($p1, $p2, $stamina);
    }

    private function turno(Character $atk, Character $def, int $turn): void {
        echo "\nTurn of {$atk->getName()} (" . get_class($atk) . ")\n";
        echo "1-Attack | 2-Special (" . $this->getSpecialName(get_class($atk)) . ") | 3-Defend\n";
        
        $action = readline("Choose [1/2/3]: ");
        
        if ($action == '2') {
            $cost = 20;
            if ($this->stamina[$atk->getName()] >= $cost) {
                $this->stamina[$atk->getName()] -= $cost;
                $this->executarEspecial($atk, $def, $turn);
            } else {
                echo "Not enough stamina! Performing normal attack.\n";
                $this->performNormalAttack($atk, $def, $turn);
            }
        } elseif ($action == '3') {
            echo "{$atk->getName()} enters a defensive stance!\n";
            $this->isDefending[$atk->getName()] = true;
            $this->logs[] = "Turn $turn: {$atk->getName()} is defending.";
        } else {
            $this->performNormalAttack($atk, $def, $turn);
        }
    }

    private function performNormalAttack(Character $atk, Character $def, int $turn): void {
        $dano = $atk->attack();
        
        if ($this->isDefending[$def->getName()]) {
            $dano = (int)($dano * 0.5);
            echo "Blocked! Damage reduced to $dano.\n";
            $this->isDefending[$def->getName()] = false;
        }

        $def->takeDamage($dano);
        echo "Normal Attack! Damage: $dano\n";
        $this->logs[] = "Turn $turn: {$atk->getName()} dealt $dano damage.";
    }

    private function executarEspecial(Character $atk, Character $def, int $turn): void {
        $especiais = [
            'Bandit' => 'wildSwing', 'Warrior' => 'heavyAttack', 
            'Knight' => 'ironFlesh', 'Sorcerer' => 'castSpell'
        ];
        
        $metodo = $especiais[get_class($atk)] ?? 'attack';
        $dano = $atk->$metodo();
        
        if ($dano > 0) $def->takeDamage($dano);
        echo "Habilidade Especial usada! Dano: $dano\n";
        $this->logs[] = "Turno $turn: {$atk->getName()} usou especial. Dano: $dano";
    }

    private function getSpecialName(string $class): string {
        $map = ['Bandit'=>'Wild Swing', 'Warrior'=>'Heavy Attack', 'Knight'=>'Iron Flesh', 'Sorcerer'=>'Cast Spell'];
        return $map[$class] ?? 'Especial';
    }

    private function salvarLog(string $p1Name, string $p2Name): void {
        $dir = __DIR__ . '/../battle/logs';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $filename = $dir . '/battle_' . date('Ymd_His') . "_" . $p1Name . "_vs_" . $p2Name . ".txt";
        file_put_contents($filename, implode("\n", $this->logs));
        echo "\n📜 Batalha finalizada. Log salvo em: $filename\n";
    }
}