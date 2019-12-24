<?php

const INITIAL_STATE = 0;

function counterReducer($state, array $action): int {
    switch ($action['type']) {
        case 'counter/INCREMENT':
            return $state + $action['count'];
        
        case 'counter/DECREMENT':
            return $state + $action['count'];
        
        default:
            return $state ?? INITIAL_STATE;
    }
}