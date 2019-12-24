<?php

require '../vendor/autoload.php';

use function Redux\{
    createStore
};

const INITIAL_STATE = 0;

function rootReducer($state = INITIAL_STATE, IAction $action)
{
    return 
}

$store = createStore($rootReducer);