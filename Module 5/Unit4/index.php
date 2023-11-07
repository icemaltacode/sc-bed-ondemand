<?php

// Simple function
function add($num1, $num2)
{
    return $num1 + $num2;
}

$result = add(5, 7);
echo "<p>The result is $result</p>";

// By value
function add10($num)
{
    $num += 10;
}

$a = 4;
echo "<p>Value before function call: $a";
add10($a);
echo "<p>Value after function call: $a";

// By reference
function add20(&$num)
{
    $num += 20;
}

$b = 4;
echo "<p>Value before function call: $b";
add20($b);
echo "<p>Value after function call: $b";

// Default parameters
function raiseToPower($num, $power = 2)
{
    return pow($num, $power);
}

printf('<p>Optional argument is specified: %d</p>', raiseToPower(10, 5));
printf('<p>Optional argument is not specified: %d</p>', raiseToPower(10));

// Multiple arguments
function sum()
{
    $total = 0;
    foreach (func_get_args() as $num) {
        $total += $num;
    }
    return $total;
}

printf('<p>Adding numbers together: %d</p>', sum(10, 87, 42, 56));

// Variadics
function sumVariadic(...$nums)
{
    $total = 0;
    foreach ($nums as $num) {
        $total += $num;
    }
    return $total;
}

printf('<p>Adding numbers together: %d</p>', sumVariadic(10, 87, 42, 56));

// Returning a reference
$garage = ['Kia', 'BMW', 'Tesla', 'Ford', 'GM'];

function &getVehicle($carNumber = 0)
{
    global $garage;
    return $garage[$carNumber];
}

echo '<p>Array before changes:</p>';
print_r($garage);
$car = getVehicle(1);
$car = 'Mercedes';
echo '<p>Array after changes:</p>';
print_r($garage);

// Variable scope
$userName = 'Alice';
$userSurname = 'Anderson';

function getFullName()
{
    global $userName, $userSurname;
    return $userName . ' ' . $userSurname;
}

echo '<p>Full Name: ' . getFullName() . '</p>';

// function setCarDetails() {
//     $carMake = 'Seat';
//     $carModel = 'Arona';
//     $carYear = 2018;
// }

// setCarDetails();
// printf('<p>It is a %d %s %s.</p>', $carMake, $carModel, $carYear);

// Nested functions
function showPrices(...$prices)
{
    function showAsEuro($value)
    {
        return '€' . number_format($value, 2, '.', ',');
    }

    echo '<ul>';
    foreach ($prices as $price) {
        echo '<li>' . showAsEuro($price) . '</li>';
    }
    echo '</ul>';
}

showPrices(34.789, 212.009, 1612.881, 12.89);

// Variable functions
function myFunc1()
{
    echo '<p>Hello! This is myFunc1()</p>';
}

function myFunc2($arg)
{
    echo "<p>Hello! This is myFunc2() with argument $arg</p>";
}

$myVar1 = 'myFunc1';
$myVar1();
$myVar2 = 'myFunc2';
$myVar2(1234);

$myVar3 = 'bogusFunction';
if (function_exists($myVar3)) {
    $myVar3();
} else {
    echo '<p>There is no function with that name!</p>';
}

// Anonymous functions / closures
$greeting = function ($name) {
    return "Hello, $name";
};

printf('<p>%s</p>', $greeting('Bob'));

// Arrow function
$otherGreeting = fn($name) => "Hello again, $name";
printf('<p>%s</p>', $otherGreeting('Bob'));

// Callback function
$productPrices = [34.789, 212.009, 1612.881, 12.89];
$result = array_map(fn($price) => '€' . number_format($price, 2, '.', ','), $productPrices);
print_r($result);

// Using closures for multi-line logic
$cartTotals = [34.789, 212.009, 1612.881, 12.89];
$freeThreshold = 40;
$processedCart = array_map(
    function ($price) use ($freeThreshold) {
        $delivery = '';
        if ($price > $freeThreshold) {
            $delivery = 'Free delivery!';
        }
        return '€' . number_format($price, 2, '.', ',') . " $delivery";
    },
    $productPrices
);
print_r($processedCart);

// Type hinting
function showCartTotal(array $cartItems, string $currency, bool $rightPlacement, float $freeThreshold): string
{
    $cartTotal = array_sum($cartItems);
    $formattedTotal = number_format($cartTotal, 2, '.', ',');
    $result = '<p>Your total is <strong>' . ($rightPlacement ? $formattedTotal . $currency : $currency . $formattedTotal) . '</strong></p>';
    if ($cartTotal > $freeThreshold) {
        $result .= '<p>Your cart qualifies for free delivery.</p>';
    }
    return $result;
}
echo showCartTotal([12.18, 3.45, 11.80, 12.65], '€', false, 40);

// Static variables (in functions)
function sayHello($user)
{
    static $callCount = 0;
    $callCount++;
    echo "<p>Hello, $user. Function has been called $callCount times.";
}
sayHello('Bob');
sayHello('Alice');
sayHello('Terence');

// Recursion
function showResults(array $results): void
{
    echo '<ul>';
    foreach ($results as $key => $value) {
        if (is_array($value)) {
            echo "<li>$key:</li>";
            showResults($value);
        } else {
            echo "<li>$key: $value</li>";
        }
    }
    echo '</ul>';
}

$results = [
    'English' => 90,
    'Maths' => [
        'Sit 1' => 61,
        'Sit 2' => 78
    ],
    'History' => 76,
    'Chemistry' => [
        'Sit 1' => [
            'Theory' => 87,
            'Practical' => 48
        ],
        'Sit 2' => [
            'Theory' => 90,
            'Practical' => 65
        ]
    ]
];
showResults($results);