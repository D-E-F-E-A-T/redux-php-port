<?php

namespace Redux;

class Store 
{
    /**
     * The root reducer.
     * 
     * @var callable
     */
    private $reducer;

    /**
     * The state.
     * 
     * @var mixed
     */
    private $state;

    /**
     * The listeners.
     * 
     * @var array
     */
    private $listeners = [];

    /**
     * @param callable $reducer The root reducer.
     */
    public function __construct(callable $reducer)
    {
        $this->reducer = $reducer;
    }

    /**
     * Dispatches an action.
     * 
     * @param array $action The action.
     */
    public function dispatch(array $action) 
    {
        $this->state = ($this->reducer)($this->state, $action);

        foreach ($this->listeners as $listener) {
            $listener();
        }
    }

    /**
     * Get the state.
     * 
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Subscribe to state changes.
     * 
     * @return callable Unsubscribe from store.
     */
    public function subscribe(callable $listener): callable 
    {
        $listeners =& $this->listeners;

        $listeners[] = $listener;
        
        $id = count($this->listeners) - 1;

        return function () use($listener, $id, &$listeners): callable {
            unset($listeners[$id]);
            
            return $listener;
        };
    }

    /**
     * Replace the root reducer.
     * 
     * @param callable $nextReducer
     * @return callable The previous reducer.
     */
    public function replaceReducer(callable $nextReducer): callable
    {
        $previousReducer = $this->reducer;

        $this->reducer = $nextReducer;
    
        return $previousReducer;
    }
}