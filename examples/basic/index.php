<?php

/**
 * Import files.
 */
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/reducers/index.php';
require __DIR__ . '/actions/index.php';

/**
 * Import Redux functions.
 */
use function Redux\{
    createStore, bindActionCreators, combineReducers
};

/**
 * Create root reducer and store.
 */
$store = createStore(
    combineReducers([
        'counter' => 'counterReducer'
    ])
);

/**
 * Log state changes.
 */
$store->subscribe(function () use($store) {
    echo "Contador: {$store->getState()['counter']}\n";
});

/**
 * Bind dispatch on action creators.
 */
[$increment, $decrement] = bindActionCreators(
    ['increment', 'decrement'], 
    [$store, 'dispatch']
);

/**
 * Tests.
 */
$increment(1);
$increment(2);
$decrement(3);