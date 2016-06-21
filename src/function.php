<?php

/**
 * Return Reference for the collection
 *
 * @return mixed
 */
function ref($collection) {
    return new \FrenchFrogs\Models\Reference($collection);
}