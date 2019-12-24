<?php

function increment($count = 1)
{
    return [
        'type' => 'counter/INCREMENT',
        'count' => $count
    ];
}

function decrement($count = 1)
{
    return [
        'type' => 'counter/DECREMENT',
        'count' => $count
    ];
}