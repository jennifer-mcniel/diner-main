<?php

/** Order class represents a diner order */

class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    /**
     * Returns the selected food
     * @return string food in the object
     */
    public function getFood()
    {
        return $this->_food;
    }

    /**
     * @param string $food
     */
    public function setFood($food)
    {
        $this->_food = $food;
    }

    /**
     * @return string
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * @param string $meal
     */
    public function setMeal($meal)
    {
        $this->_meal = $meal;
    }

    /**
     * @return string
     */
    public function getCondiments()
    {
        return $this->_condiments;
    }

    /**
     * @param string $condiments
     */
    public function setCondiments($condiments)
    {
        $this->_condiments = $condiments;
    }

    /**
     * constructor creats an order object
     * @param $_food  food user ordered
     * @param $_meal selected meal
     * @param $_condiments selected condiments
     */
    public function __construct($_food="", $_meal="", $_condiments="")
    {
        $this->_food = $_food;
        $this->_meal = $_meal;
        $this->_condiments = $_condiments;
    }
}

//$order = new Order('pad thai', 'lunch', ['soy sauce']);
//
//echo "<pre>";
//var_dump($order);
//echo "</pre>";
