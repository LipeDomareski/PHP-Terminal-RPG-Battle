<?php

class CharacterFactory {
    public static function create(): Character {
        echo "\n" . str_repeat("-", 30) . "\n";
        echo "    SELECT YOUR CLASS\n";
        echo str_repeat("-", 30) . "\n";
        
        echo "1-Bandit  2-Cleric   3-Knight   4-Warrior  5-Thief\n";
        echo "6-Deprived 7-Hunter  8-Pyromancer 9-Sorcerer 10-Wanderer\n";
        
        $name = readline("Enter character name: ");
        $choice = readline("Choose your class (1-10): ");

        switch ($choice) {
            case '1':  return new Bandit($name, 12, 8, 14, 15, 9, 11, 8, 10);
            case '2':  return new Cleric($name, 11, 11, 10, 11, 8, 11, 8, 14);
            case '3':  return new Knight($name, 14, 10, 12, 11, 11, 10, 9, 11);
            case '4':  return new Warrior($name, 11, 8, 12, 13, 13, 11, 9, 9);
            case '5':  return new Thief($name, 9, 11, 10, 9, 15, 10, 12, 11);
            case '6':  return new Deprived($name, 11, 11, 11, 11, 11, 11, 11, 11);
            case '7':  return new Hunter($name, 11, 9, 12, 11, 14, 11, 9, 9);
            case '8':  return new Pyromancer($name, 10, 12, 11, 12, 9, 12, 10, 8);
            case '9':  return new Sorcerer($name, 8, 15, 8, 9, 11, 8, 15, 8);
            case '10': return new Wanderer($name, 10, 11, 10, 10, 14, 12, 11, 8);
            default:
                echo "Invalid choice. Defaulting to Warrior.\n";
                return new Warrior($name, 11, 8, 12, 13, 13, 11, 9, 9);
        }
    }
}
    // Ordem: (Name, Vit, Att, End, Str, Dex, Res, Int, Faith)