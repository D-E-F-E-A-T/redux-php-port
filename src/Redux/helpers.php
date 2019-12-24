<?php

namespace Redux;

/**
 * Create a new Store object.
 * 
 * @param callable $reducer The reducer of store.
 * @return Store
 */
function createStore(callable $reducer): Store 
{
    return new Store($reducer);
}