<?php

// Indexed Array
$cities = ['London', 'Paris', 'New York', 'Valletta', 'Bangkok'];
print_r($cities);

echo '<br><br>';
$longCities = array('London', 'Paris', 'New York', 'Valletta', 'Bangkok');
print_r($longCities);

// Associative Array
echo '<br><br>';
$ninjaCoders = ['CEO' => 'Alice Anderson', 'CTO' => 'Bob Barker', 'SVP Sales' => 'Craig Coleman', 20 => 'Desiree Diamont', 'Eliott Earhart'];
print_r($ninjaCoders);

// Accessing Values
printf('<p>The second city is %s', $cities[1]);
printf('<p>The CTO of the company is %s', $ninjaCoders['CTO']);
printf('<p>The SVP of Sales is %s', $ninjaCoders['SVP Sales']);

$level = 'SVP';
printf('<p>The employee is %s.</p>', $ninjaCoders["$level Sales"]);

// Inline array initialisation
$sports[] = "Football";
$sports['USA'] = "Soccer";
$sports[2] = "Basketball";
print_r($sports);

// Using the range() function
$thirties = range(30, 39);
$fiveLetters = range('A', 'E');
var_dump($thirties);
var_dump($fiveLetters);

// Array Size
printf('<p>The size of the $thirties array is %d</p>', count($thirties));
$sports = array_pad($sports, -15, 'Some other sport');
var_dump($sports);

// Two-dimensional array
$gradeBook = [
    'John Jefferson' => ['English', 'Geography', 'Physics'],
    'Georgia Graham' => ['English', 'French', 'Chemistry'],
    'Harriet Hasan' => ['Biology', 'Philosophy']
];
var_dump($gradeBook);
printf('<p>Georgia\'s second subject is %s</p>', $gradeBook['Georgia Graham'][1]);

// Three-dimensional array
$gradeBookDetail = [
    'John Jefferson' => [
        'English' => ['Midterm' => 90, 'Final' => 85],
        'Geography' => ['Midterm' => 62, 'Final' => 83],
        'Physics' => ['Midterm' => 73, 'Final' => 65]
    ],
    'Georgia Graham' => [
        'English' => ['Midterm' => 92, 'Final' => 98],
        'Geography' => ['Midterm' => 91, 'Final' => 100],
        'Physics' => ['Midterm' => 76, 'Final' => 78]
    ],
    'Harriet Hasan' => [
        'Biology' => ['Midterm' => 89, 'Final' => 81],
        'Philosophy' => ['Midterm' => 76, 'Final' => 82]
    ]
];
var_dump($gradeBookDetail);
printf('Harriet scored %d in her Philosophy final.', $gradeBookDetail['Harriet Hasan']['Philosophy']['Final']);

// List 
$planetArray = ['Mercury'=>'Rocky', 'Venus'=>'Rocky', 'Earth'=>'Rocky', 
                'Mars'=>'Rocky', 'Jupiter'=>'Gas', 'Saturn'=>'Gas', 
                'Uranus'=>'Ice', 'Neptune'=>'Gas'];
list('Mercury' => $first, 'Venus' => $second) = $planetArray;
echo "<p>$first and $second</p>";

// Array Subset
$rockyPlanets = array_slice($planetArray,0,4);
print_r($rockyPlanets);

// Array chunk
echo '<br><br>';
$inThrees = array_chunk($planetArray, 3);
var_dump($inThrees);
echo '<br><br>';
$inThreesPreserved = array_chunk($planetArray, 3, true);
var_dump($inThreesPreserved);

// Extract keys or values
$keys = array_keys($planetArray);
var_dump($keys);
$values = array_values($planetArray);
var_dump($values);

// Check if key exists
$body = 'Pluto';
printf('<p>%s is %s a planet.</p>', $body,  array_key_exists($body, $planetArray) ? '' : 'not');

// Splicing arrays
array_splice($planetArray, 4, count($planetArray), array('HD 260655 b', 'HD 260655 c'));
var_dump($planetArray);

// Extracting variables from arrays
extract($planetArray);
echo "<p>Mars is a $Mars planet.</p>";

// Compacting variables into arrays
$star1 = 'Sol';
$star2 = 'Proxima Centauri';
$star3 = 'Rigil Kentaurus';
$stars = compact('star1', 'star2', 'star3');
print_r($stars);

// Resetting the array
$planetArray = ['Mercury'=>'Rocky', 'Venus'=>'Rocky', 'Earth'=>'Rocky', 
                'Mars'=>'Rocky', 'Jupiter'=>'Gas', 'Saturn'=>'Gas', 
                'Uranus'=>'Ice', 'Neptune'=>'Gas'];

// Traversing arrays
foreach($planetArray as $name=>$type) {
    printf('<p>%s is a %s planet.</p>', $name, $type);
}

// Foreach loop
foreach($planetArray as $name=>&$type) {
    if ($name === 'Uranus') {
        $type = 'Ice Giant';
    }
    printf('<p>%s is a %s planet.</p>', $name, $type);
}
print_r($planetArray);

// For loop
$jupiterMoons = ['Europa', 'Io', 'Ganymede', 'Callisto'];
for ($i=0; $i < count($jupiterMoons); $i++) {
    $jupiterMoons[$i] .= ' Moon';
    printf('<p>%s</p>', $jupiterMoons[$i]);
}   
print_r($jupiterMoons);

// Array Iterator
$arrObj = new ArrayObject($planetArray);
$it = $arrObj->getIterator();

foreach ($it as $name=>&$type) {
    printf('<p>%s is a %s planet.</p>', $name, $type);
}

// Array Walk
array_walk($planetArray, fn($key, $value) => printf('<p>The next planet is %s</p>', $value));

// in_array()
$jupiterMoons = ['Europa', 'Io', 'Ganymede', 'Callisto'];
if (in_array('Callisto', $jupiterMoons)) {
    echo "<p>Callisto is one of Jupiter's moons.</p>";
} else {
    echo "<p>Callisto is not one of Jupiter's moons.</p>";
}

// array_search
$result = array_search('Europa', $jupiterMoons);
if ($result !== false) {
    echo "<p>Europa was found at key $result in the array.";
} else {
    echo '<p>Europa was not found in the array.';
}

// Array Operations
echo '<br><br>';

// Sorting
$indexedNames = ['Gregory', 'Alice', 'Travis', 'Paula', 'Olivia'];
$associativeNames = ['Goaler'=>'Travis', 'Attacker'=>'Paula', 'Defender'=>'Olivia', 'Midfielder'=>'Gregory', 'Wingman'=>'Alice'];

ksort($indexedNames);
print_r($indexedNames);
echo '<br><br>';
ksort($associativeNames);
print_r($associativeNames);

echo '<br><br>';

// User-defined sort order
$readings = [
    'Monday' => [12, 14, 16, 9],
    'Tuesday' => [13, 16, 18, 3],
    'Wednesday' => [9, 10, 8, 1]
];
// Sort in descending order, start with day having the highest temperature
uasort($readings, fn($a, $b) => -(max($a) <=> max($b)));
var_dump($readings);

// Multi-Array Sorting
$studentNames = ['Peter', 'Alice', 'Davinia', 'Bob', 'Travis'];
$studentAges = [26, 18, 21, 37, 45];
$studentGrades = [82, 90, 92, 76, 71];
array_multisort(
    $studentNames, SORT_ASC,
    $studentAges, SORT_DESC,
    $studentGrades, SORT_DESC
);
var_dump($studentNames, $studentAges, $studentGrades);

// Natural Sort
echo '<br><br>';
$folders = ['Module 5', 'Module 1', 'Module 12'];
natsort($folders);
print_r($folders);

// Array Sum
$fileSizes = [124, 67, 1045, 23];
printf('<p>Total file size: %dKb<p>', array_sum($fileSizes));

// Array Merge
$maltaCities = ['Valletta', 'Safi', 'Rabat', 'Zebbug', 'Qormi'];
$moroccoCities = ['Casablanca', 'Rabat', 'Marrakech', 'Safi'];
$cities = array_merge($maltaCities, $moroccoCities);    
print_r($cities);

// Array Diff
$maltaCities = ['Valletta', 'Safi', 'Rabat', 'Zebbug', 'Qormi'];
$moroccoCities = ['Casablanca', 'Rabat', 'Marrakech', 'Safi'];
$cities = array_diff($maltaCities, $moroccoCities);    
print_r($cities);

echo '<br><br>';

// Array Filter
$emails = ['keith@icemalta.com', 'bob@gmail.com', 'alice@icemalta.com', 'travis@outlook.com'];
$internalEmails = array_filter($emails, fn($email) => strpos($email, 'icemalta.com'));
print_r($internalEmails);

// Using an array as a set
$maltaCities = ['Valletta', 'Safi', 'Rabat', 'Zebbug', 'Qormi'];
$moroccoCities = ['Casablanca', 'Rabat', 'Marrakech', 'Safi'];

// Union
echo '<h4>Set Union</h4>';
$cities = array_unique(array_merge($maltaCities, $moroccoCities));
print_r($cities);

// Intersection
echo '<h4>Set Intersection</h4>';
$cities = array_intersect($maltaCities, $moroccoCities);
print_r($cities);

// Difference
echo '<h4>Set Difference</h4>';
$cities = array_diff($maltaCities, $moroccoCities);
print_r($cities);

// Using an array as a queue
$names = ['Alice', 'Bob', 'Charles', 'Daniela'];
echo '<h4>Queue</h4>';
print_r($names);

echo '<h4>Enqueue an item</h4>';
array_push($names, 'Eliott');
print_r($names);

echo '<h4>Dequeue an item</h4>';
$name = array_shift($names);
echo "<p>Dequeued: $name</p>";
print_r($names);

// Using an array as a stack
$names = ['Alice', 'Bob', 'Charles', 'Daniela'];
echo '<h4>Stack</h4>';
print_r($names);

echo '<h4>Push an item</h4>';
array_unshift($names, 'Eliott');
print_r($names);

echo '<h4>Pop an item</h4>';
$name = array_shift($names);
echo "<p>Popped: $name</p>";
print_r($names);