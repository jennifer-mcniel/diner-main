<?php

/* This is the data layer
    it belongs to the model
    */
class DataLayer
{
// get meals for diner app
    static function getMeals()
    {
        return array('breakfast', 'snack', 'lunch', 'dinner', 'dessert');
    }

    static function getCondiments()
    {
        return array('mustard', 'mayo', 'ketchup', 'siracha');
    }
}