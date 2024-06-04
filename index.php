<?php

// 328/diner/index.php
// This is my CONTROLLER!

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the necessary file
require_once ('vendor/autoload.php');

//var_dump(Validate::validFood('   x'));

/* Test validate class */


/* Test the data layer class */

//var_dump(Datalayer::getMeals());

/*Test order class */
//$order = new Order('pad thai', 'lunch', ['soy sauce']);
//
//echo "<pre>";
//var_dump($order);
//$order2 = new Order();
//$order2->setFood('nachos');
//
//var_dump($order2);
//echo "</pre>";


// Instantiate the F3 Base class
$f3 = Base::instance();

// Define a default route
// https://tostrander.greenriverdev.com/328/hello-fat-free/
$f3->route('GET /', function() {
    //echo '<h1>Hello from My Diner App!</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/home-page.html');
});

// Breakfast menu
$f3->route('GET /menus/breakfast', function() {
    //echo '<h1>My Breakfast Menu</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});

// Lunch menu
$f3->route('GET /menus/lunch', function() {
    //echo '<h1>My Breakfast Menu</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/lunch-menu.html');
});

// Dinner menu
$f3->route('GET /menus/dinner', function() {
    //echo '<h1>My Breakfast Menu</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/dinner-menu.html');
});

//Order Summary
$f3->route('GET /summary', function($f3) {

    //write data to database

    //var_dump( $f3->get('SESSION'));

    // Render a view page
    $view = new Template();
    echo $view->render('views/order-summary.html');
    session_destroy();
});

// Order Form Part I
$f3->route('GET|POST /order1', function($f3) {

    // initialize variables
    $food = "";
    $meal = "";

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //echo "<p>You got here using the POST method</p>";
        //var_dump ($_POST);

        // Get the data from the post array
        if(Validate::validFood($_POST['food'])){
            $food = $_POST['food'];
        }
        else {
            $f3->set('errors["food"]', "Please enter a valid food");
        }

        if (isset($_POST['meal']) and Validate::validMeal($_POST['meal'])) {
            $meal = $_POST['meal'];
        }else {
            $f3->set('errors["meal"]', "Please select valid meal");
        }

        //add data to session array
        $order = new Order($food, $meal);
        $f3->set('SESSION.order', $order);

        //send user to next form if no errors
        if(empty($f3->get('errors'))){
            $f3->reroute('order2');
        }
    }

    // get data from model and add to hive
    $meals = DataLayer::getMeals();
    $f3->set('meals', $meals);

    // Render a view page
    $view = new Template();
    echo $view->render('views/order1.html');
});


// Order Form Part II
$f3->route('GET|POST /order2', function($f3) {
    //echo '<h1>My Breakfast Menu</h1>';
    //var_dump( $f3->get('SESSION'));

    //if form is posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (isset($_POST['conds']))
            $condiments = implode(', ',$_POST['conds']);
        else
            $condiments = $_POST['conds'];


        if (true) {
            //add data to session array get order object from session then add condiments to order object
            $f3->get('SESSION.order')->setCondiments($condiments);

            //send user to next form
            $f3->reroute('summary');
        } else {
            //temporary (html belongs in views)
            echo "<p>Validation errors</p>";
        }
    }

    $condiments = DataLayer::getCondiments();
    $f3->set('condiments', $condiments);

    // Render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// Run Fat-Free
$f3->run();
