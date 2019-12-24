<?php

/**
 * Versão do PHP miníma: 7.1
 */

require __DIR__ . '/../vendor/autoload.php';

use function Redux\{
    createStore, combineReducers, bindActionCreators, dd
};

function counterReducer($state, array $action)
{
    switch ($action['type']) {
        case 'INCREMENT':
            return $state + $action['payload']['count'];
        
        case 'DECREMENT':
            return $state - $action['payload']['count'];

        default:
            return $state ?? 0;
    }
}

function statusReducer($state, array $action)
{
    switch ($action['type']) {
        case 'UPDATE_STATUS':
            return $action['payload']['status'];

        default:
            return $state ?? '';
    }
}

function increment($count = 1) 
{
    return [
        'type' => 'INCREMENT',
        'payload' => [
            'count' => $count
        ]
    ];
}

function decrement($count = 1) 
{
    return [
        'type' => 'DECREMENT',
        'payload' => [
            'count' => $count
        ]
    ];
}

function updateStatus($status)
{
    return [
        'type' => 'UPDATE_STATUS',
        'payload' => [
            'status' => $status
        ]
    ];
}

$store = createStore(
    combineReducers([
        'counter' => 'counterReducer',
        'status'  => 'statusReducer'  
    ])
);

$store->subscribe(function () use ($store) {
    dd($store->getState());
});

$creators = bindActionCreators(
    [
        'increment',
        'decrement',
        'updateStatus'
    ],
    [$store, 'dispatch']
);

[$increment, $decrement, $updateStatus] = $creators;

$updateStatus(':rocket: Aprendendo Redux');
$updateStatus(':rocket: Recriando o Redux no PHP');
$increment(1);
$increment(5);
$decrement();