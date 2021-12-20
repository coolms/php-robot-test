<?php

spl_autoload_register(function($class) {
    $resolved = $class . '.php';
    if (file_exists($resolved)) {
        require_once $resolved;
    }
});

// Run app from CLI

const COMMANDS = [
    'PLACE',
    'MOVE',
    'LEFT',
    'RIGHT',
    'REPORT'
];
$command[0] = '';
$main = null;

echo 'Please enter command: ';

while ($command[0] !== 'REPORT') {

    $handle = fopen ("php://stdin",'r');
    $line = strtoupper(fgets($handle));
    fclose($handle);

    $command = array_map('trim', preg_split('/\s+?/', $line, 2));
    if (!in_array($command[0], COMMANDS)) {
        echo "Unsupported command {$command[0]}\nSupported commands are: " . implode(', ', COMMANDS) . "\n";
        break;
    }

    if (!empty($command[1])) {
        $args = array_map('trim', explode(',', $command[1]));
        if ($command[0] === 'PLACE') {

            try {
                $position = new InitPosition(
                    (int)$args[0] ?? 0,
                    (int)$args[1] ?? 0,
                    $args[2] ?? current(FacingDirectionInterface::DIRECTIONS)
                );
                $main = new Main($position);
            } catch (Exception $e) {
                // Ignoring exceptions according to spec
                break;
            }

        }
    }

    if (!$main) {
        break;
    }

    switch ($command[0]) {
        case 'MOVE':
            $main->move();
            break;
        case 'REPORT':
            echo $main . "\n";
            break 2;
        case 'LEFT':
        case 'RIGHT':
            $main->applyTurnCommand(new Turn($command[0]));
    }
}
