<?php

class BattleUI {
    private static array $invasionLore = [
        "The fog wall rises...\nA dark phantom crosses into your world.",
        "You sense a malevolent presence.\nFrom the shadows, your enemy emerges.",
    ];

    public static function displayInvasion(string $name): void {
        $msg = str_replace('{name}', strtoupper($name), self::$invasionLore[array_rand(self::$invasionLore)]);
        self::box($msg);
    }

    public static function displayStatus(Character $p1, Character $p2, array $stamina): void {
        echo "\n┌──────────────────────────────────────────────────────────┐\n";
        self::lineStatus($p1, $stamina[$p1->getName()]);
        echo "│                        ⚔  VS  ⚔                        │\n";
        self::lineStatus($p2, $stamina[$p2->getName()]);
        echo "└──────────────────────────────────────────────────────────┘\n";
    }

    private static function lineStatus(Character $c, int $stamina): void {
        // Bar length of 10 for HP, 20 for Stamina
        $hpBar  = str_repeat('#', (int)($c->getHp() / 10));
        $stmBar = str_repeat('|', (int)($stamina / 5)); 

        printf("│ %-10s HP:[%-10s] %3d | STM:[%-20s] %3d │\n", 
            $c->getName(), $hpBar, $c->getHp(), $stmBar, $stamina);
    }

    public static function box(string $msg): void {
        echo "\n▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓\n";
        echo "  $msg\n";
        echo "▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓\n";
    }
}