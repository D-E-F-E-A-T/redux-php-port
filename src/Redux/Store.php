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
}