<?php

require __DIR__ . '/../vendor/autoload.php';

use function Redux\{createStore};

$store = createStore(function ($state = 0, array $action) {
    switch ($action['type']) {
        case 'INCREMENT':
            return $state + 1;

        case 'DECREMENT':
            return $state - 1;

        default:
            return $state;
    }
});

$store->subscribe(function () use ($store) {
    echo "[state/new] " . $store->getState() . "\n";
});

for ($i = 1; $i <= 20; $i++) {
    $store->dispatch([
        'type' => 'INCREMENT'
    ]);
}

$nextReducer = $store->replaceReducer(function ($state, $action) {
    return $state - 1;
});

for ($i = 1; $i <= 10; $i++) {
    $store->dispatch([
        'type' => 'INCREMENT'
    ]);
}

$store->replaceReducer($nextReducer);

for ($i = 1; $i <= 10; $i++) {
    $store->dispatch([
        'type' => 'INCREMENT'
    ]);
}