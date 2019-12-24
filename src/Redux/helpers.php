<?php

namespace Redux;

/**
 * Create a new Store object and initialize it.
 * 
 * @param callable $reducer The reducer of store.
 * @return Store
 */
function createStore(callable $reducer): Store 
{
    $store = new Store($reducer);

    $store->dispatch([
        'type' => '@@redux/init'
    ]);

    return $store;
}