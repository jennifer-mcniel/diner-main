<?php

/* This is the data layer
    it belongs to the model
    */

// get meals for diner app
function getMeals(){
    return array('breakfast', 'snack', 'lunch', 'dinner', 'dessert');
}

function getCondiments() {
    return array('mustard', 'mayo', 'ketchup', 'siracha');
}