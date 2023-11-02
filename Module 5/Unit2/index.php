<?php
$myName = 'Keith';
$mySurname = 'Vassallo';

echo $myName;
echo '<p>My name is ' . $myName . '</p>';
echo '<p>My surname is $mySurname</p>';
echo "<p>My surname is $mySurname</p>";

$myBio = <<<BIO
    <p>
        $myName $mySurname was born on 15th September, 1986. He currently works with
        ICE Malta as Head of Technology, specialising in creating and delivering programming
        and technical courses.
    </p>
    <p>
        In his spare time, Keith likes to <strong>learn new things</strong>, play computer
        games ("but only single-player!") and watch series/movies. He is also obliged
        by his wife to say that he enjoys long walks in the countryside.
    </p>
    BIO;
echo $myBio;

echo '<p>This is some code.</p>'; // This is a one-line C-style comment.
echo '<p>Some more code.</p>'; # This is a one-line shell-style comment.

/*  The following is a multi-line comment. 
    In fact, this is the second line of said comment. */
echo '<p>Yet more code.</p>';

/**
 * This is a documentation comment. 
 * Note how is starts with two asterisks, and has an asterisk on each line. 
 * Tags are supported:
 * @author Keith Vassallo <keith@icemalta.com>
 * @version 1.0
 * These comments are used by documentation generators such as 
 * PHPDoc {@link https://www.phpdoc.org}
 */

/* Fun with data types */
// Integer
$anInt = 42;
echo "<p>The value $anInt is an " . gettype($anInt) . '</p>';
// Float
$aFloat = 42.21;
echo "<p>The value $aFloat is a " . gettype($aFloat) . '</p>';
// String
$county = 'Cumberland';
echo "<p>The value $county is a " . gettype($county) . '</p>';
// Boolean
$isRaining = false;
echo "<p>The value $isRaining is a " . gettype($isRaining) . '</p>';
$isSunny = true;
echo "<p>The value $isSunny is a " . gettype($isSunny) . '</p>';

// These are compound data types
// Arrays
$temperatures = [23.1, 22.9, 16.8, 14.3];
echo '<p>Temperatures:</p>';
print_r($temperatures);
$company = ['CEO' => 'Alice Anderson', 'CTO' => 'Bob Barker'];
echo '<p>Company:</p>';
print_r($company);

// Objects
class Dog
{
    public $name = '';
    public function bark()
    {
        echo 'Woof';
    }
}
$d = new Dog();
$d->name = 'Fido';
echo '<p>Dog</p>';
print_r($d);

// Type coercion
$val1 = 42;
$val2 = "89";
$val3 = $val1 + $val2;
echo "<p>The result of the type coercion: $val3</p>";

// Type casting
$val4 = "29";
$val5 = 42.82;
$val6 = (int) $val4 + (int) $val5;
echo "<p>The result of the type cast: $val6</p>";

// Constants
define('PI', 3.14159);
echo '<p>The approximate value of PI is: ' . PI . '</p>';
define('OPTIONS', ['Light Mode', 'Dark Mode', 'System (Auto)']);
echo '<p>Options:</p>';
print_r(OPTIONS);

const L = 6.02e23;
echo '<p>Approximate Avogadro constant: ' . L . '</p>';

// Functions
function getUserGreeting()
{
    return "Hello, There!";
}

echo '<p>' . getUserGreeting() . '</p>';

// Variable Functions
$myGreeting = 'getUserGreeting';
echo "<p>{$myGreeting()}</p>";

// Using print()
print('I have been printed!');

// Multiple parameters with echo
echo '<p>Show this', ' and then this', ' and then that.</p>';

// Using printf()
$animal = 'fox';
printf('%s Did you know that the quick brown %s jumps over the lazy %s?', getUserGreeting(), $animal, 'dog');

$cartTotal = 89.6592;
printf('<p>Total in your cart: €%.2f', $cartTotal);

$student1 = 4;
$student2 = 32;
$student3 = 168;
printf('<p>Student 1: %03d, Student 2: %03d, Student 3: %03d</p>', $student1, $student2, $student3);

// Variable inspection
$sampleArray = ['Joe', 12, 11.23, true, new stdClass()];
print_r($sampleArray);
var_dump($sampleArray);
var_export($sampleArray);

$firstVar = 42;
$secondVar = null;
echo '<p>Using isset()</p>';
echo '<p>First Variable: ' . (isset($firstVar) ? 'Is Set' : 'Is Not Set') . '</p>';
echo '<p>Second Variable: ' . (isset($secondVar) ? 'Is Set' : 'Is Not Set') . '</p>';
echo '<p>Third Variable: ' . (isset($thirdVar) ? 'Is Set' : 'Is Not Set') . '</p>';

$fourthVar = 0;
echo '<p>Using empty()</p>';
echo 'First Variable: ' . (empty($firstVar) ? 'Is Empty': 'Is Not Empty') . '</p>';
echo 'Second Variable: ' . (empty($secondVar) ? 'Is Empty': 'Is Not Empty') . '</p>';
echo 'Third Variable: ' . (empty($thirdVar) ? 'Is Empty': 'Is Not Empty') . '</p>';
echo 'Fourth Variable: ' . (empty($fourthVar) ? 'Is Empty': 'Is Not Empty') . '</p>';