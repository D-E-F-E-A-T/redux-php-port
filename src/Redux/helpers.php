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

/**
 * Combine reducers.
 * 
 * @param array $reducers
 * @return callable
 */
function combineReducers(array $reducers): callable 
{
    return function ($state, array $action) use($reducers) : array {
        foreach ($reducers as $key => $reducer) {
            $reducers[$key] = $reducer($state[$key], $action);        
        }

        return $reducers;
    };
}

/**
 * Bind action creators.
 * 
 * @param array $creators
 * @param callable $dispatch
 * @return array
 */
function bindActionCreators(array $creators, callable $dispatch): array 
{
    foreach ($creators as $key => $creator) {
        $creators[$key] = function () use($dispatch, $creator) {
            return $dispatch(
                $creator(
                    ...func_get_args()
                )
            );
        };
    }

    return $creators;
}