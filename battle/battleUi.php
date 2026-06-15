<?php

class BattleUI {
    private const RED = "\033[31m";
    private const GREEN = "\033[32m";
    private const BLUE = "\033[34m";
    private const RESET = "\033[0m";
    private const YELLOW = "\033[33m";

    public static function displayStatus(Character $p1, Character $p2, array $stamina, array $isDefending): void {
        echo "\n╔" . str_repeat("═", 58) . "╗\n";
        self::lineStatus($p1, $stamina[$p1->getName()], $isDefending[$p1->getName()]);
        echo "║" . str_pad(" ⚔ VS ⚔ ", 58, " ", STR_PAD_BOTH) . "║\n";
        self::lineStatus($p2, $stamina[$p2->getName()], $isDefending[$p2->getName()]);
        echo "╚" . str_repeat("═", 58) . "╝\n";
    }

    private static function lineStatus(Character $c, int $stm, bool $defending): void {
        // Barras visuais
        $hpBar  = self::RED . str_repeat('█', (int)($c->getHp() / 15)) . self::RESET;
        $stmBar = self::GREEN . str_repeat('░', (int)($stm / 10)) . self::RESET;
        
        $defIcon = $defending ? self::BLUE . "🛡️" . self::RESET : "  ";

        printf("║ %-10s %s HP: %-20s | STM: %-20s ║\n", 
            $c->getName(), 
            $defIcon, 
            $hpBar, 
            $stmBar
        );
    }

    public static function box(string $msg): void {
        echo "\n" . self::YELLOW . "╭" . str_repeat("─", 50) . "╮\n";
        echo "  $msg\n";
        echo "╰" . str_repeat("─", 50) . "╯" . self::RESET . "\n";
    }
}