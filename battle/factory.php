<?php

class CharacterFactory {
    public static function create(): Character {
        self::displayHeader();
        
        $name = readline("👤 Enter character name: ");
        $choice = readline("⚔️  Choose your class [1-10]: ");

        return self::mapChoiceToClass($name, $choice);
    }

    private static function displayHeader(): void {
        echo "\n" . str_repeat("=", 40) . "\n";
        echo " =   SELECT YOUR CHARACTER CLASS   =\n";
        echo str_repeat("=", 40) . "\n";
        
        $classes = [
            "1. Bandit    ", "2. Cleric    ", "3. Knight    ", 
            "4. Warrior   ", "5. Thief     ", "6. Deprived  ",
            "7. Hunter    ", "8. Pyromancer", "9. Sorcerer  ", 
            "10. Wanderer "
        ];

        for ($i = 0; $i < count($classes); $i += 2) {
            echo str_pad($classes[$i], 20) . ($classes[$i+1] ?? "") . "\n";
        }
        echo str_repeat("-", 40) . "\n";
    }

    private static function mapChoiceToClass(string $name, string $choice): Character {
        $classes = [
            '1' => fn() => new Bandit($name, 12, 8, 14, 15, 9, 11, 8, 10),
            '2' => fn() => new Cleric($name, 11, 11, 10, 11, 8, 11, 8, 14),
            '3' => fn() => new Knight($name, 14, 10, 12, 11, 11, 10, 9, 11),
            '4' => fn() => new Warrior($name, 11, 8, 12, 13, 13, 11, 9, 9),
            '5' => fn() => new Thief($name, 9, 11, 10, 9, 15, 10, 12, 11),
            '6' => fn() => new Deprived($name, 11, 11, 11, 11, 11, 11, 11, 11),
            '7' => fn() => new Hunter($name, 11, 9, 12, 11, 14, 11, 9, 9),
            '8' => fn() => new Pyromancer($name, 10, 12, 11, 12, 9, 12, 10, 8),
            '9' => fn() => new Sorcerer($name, 8, 15, 8, 9, 11, 8, 15, 8),
            '10' => fn() => new Wanderer($name, 10, 11, 10, 10, 14, 12, 11, 8)
        ];

        if (isset($classes[$choice])) {
            return $classes[$choice]();
        }

        echo "⚠️ Invalid choice. Defaulting to Warrior.\n";
        return new Warrior($name, 11, 8, 12, 13, 13, 11, 9, 9);
    }
}