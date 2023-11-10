<?php
session_start();
$accuracy = 1; // Default accuracy

/**
 * Checks whether a value was given in the conversion form and whether it is numeric
 * @param mixed $value the value to check
 * @return bool true if value is valid
 */
function isValidInput($value): bool
{
    return isset($value) && is_numeric($value);
}

/**
 * Convert a value from one unit to another
 * @param string $conversionType the type of conversion to carry out
 * @param float $value the value to convert
 * @param int $accuracy how many decimal places to round the result to
 * @return array an associative array contianing 'fromValue', 'toValue', 'fromUnit' and 'toUnit'
 */
function convert(string $conversionType, float $value, int $accuracy): array
{
    $result = [];
    $value = floatval($value);
    switch ($conversionType) {
        case 'c_to_f':
            $convertedValue = round(($value * 9 / 5) + 32, $accuracy);
            $fromUnit = 'C';
            $toUnit = 'F';
            break;
        case 'f_to_c':
            $convertedValue = round(($value - 32) * 5 / 9, $accuracy);
            $fromUnit = 'F';
            $toUnit = 'C';
            break;
        case 'km_to_mi':
            $convertedValue = round($value * 0.621371, $accuracy);
            $fromUnit = 'km';
            $toUnit = 'mi';
            break;
        case 'mi_to_km':
            $convertedValue = round($value / 0.621371, $accuracy);
            $fromUnit = 'mi';
            $toUnit = 'km';
            break;
        case 'cm_to_in':
            $convertedValue = round($value / 2.54, $accuracy);
            $fromUnit = 'cm';
            $toUnit = '"';
            break;
    }

    $result['fromValue'] = $value;
    $result['toValue'] = $convertedValue;
    $result['fromUnit'] = $fromUnit;
    $result['toUnit'] = $toUnit;
    return $result;
}

// Load history from cookie if current session is empty
if (isset($_COOKIE['conversionHistory']) && !isset($_SESSION['conversionHistory'])) {
    $_SESSION['conversionHistory'] = json_decode($_COOKIE['conversionHistory']);
    $_SESSION['accuracy'] = $_COOKIE['accuracy'];
    $accuracy = $_SESSION['accuracy'];
}

$keepHistory = isset($_SESSION['conversionHistory']); // If there's no history, disable keeping history by default

// Process the form
$errors = [];
if (filter_var($_SERVER['REQUEST_METHOD'], FILTER_UNSAFE_RAW, FILTER_NULL_ON_FAILURE) === 'POST') {
    $inputValue = filter_input(INPUT_POST, 'convert_value');
    if (!isValidInput($inputValue)) {
        // Input is invalid
        $errors[] = 'Invalid input value.';
    } else {
        $conversionType = filter_input(INPUT_POST, 'convert_type');
        $accuracy = filter_input(INPUT_POST, 'convert_accuracy');
        $keepHistory = filter_input(INPUT_POST, 'convert_keep_history');
        
        $result = convert($conversionType, $inputValue, $accuracy);
        if ($keepHistory) {
            $_SESSION['conversionHistory'][] = $result;
            $_SESSION['accuracy'] = $accuracy;
            setcookie('conversionHistory', json_encode($_SESSION['conversionHistory']), time() + 604800,'/');
            setcookie('accuracy', $accuracy, time() + 604800,'/');
        } else {
            unset($_SESSION['conversionHistory']);
            unset($_COOKIE['conversionHistory']);
            setcookie('conversionHistory', '', -1, '/');
            unset($_SESSION['accuracy']);
            unset($_COOKIE['accuracy']);
            setcookie('accuracy', '', -1, '/');
        }
    }
}
?>
<div class="grid gap-0 row-gap-3">
    <div class="p-2 g-col-12">
        <div class="card">
            <div class="card-body">
                <h1><span class="logo"><i class="bi bi-brilliance"></i></span></a> Convertomatic</h1>
            </div>
        </div>
    </div>
    <div class="p-2 g-col-12">
        <div class="card">
            <div class="card-body">
                <form name="convertForm" id="convertForm" method="POST">
                    <div class="row mb-3 gy-2">
                        <div class="col-sm-5">
                            <input name="convert_value" id="convert_value" type="number" step="any"
                                class="form-control form-control-lg" placeholder="Your value here" required>
                        </div>
                        <div class="col-sm-5">
                            <select name="convert_type" id="convert_type" class="form-select form-select-lg mb-3">
                                <option selected value="c_to_f">Celsius to Fahrenheit</option>
                                <option value="f_to_c">Fahrenheit to Celsius</option>
                                <option value="km_to_mi">Kilometers to Miles</option>
                                <option value="mi_to_km">Miles to Kilometers</option>
                                <option value="cm_to_in">Centimeters to Inches</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary btn-lg mb-3">Convert</button>
                        </div>
                    </div>
                    <div class="row mb-3 gy-2">
                        <div class="col-sm-5">
                            <label for="convert_accuracy" class="form-label">Accuracy: <span
                                    id="accuracy_label">3</span> decimal places</label>
                            <input type="range" name="convert_accuracy" id="convert_accuracy" class="form-range" min="0"
                                max="5" step="1" value="<?= $accuracy ?>" oninput="updateAccuracy()">
                        </div>
                        <div class="col">
                            <label class="form-label" for="convert_keep_history">Keep History</label>
                            <div class="form-check form-switch">
                                <input name="convert_keep_history" id="convert_keep_history" class="form-check-input"
                                    type="checkbox" role="switch" style="transform: scale(1.5);" <?= $keepHistory ? 'checked' : ''?>>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($result) || (isset($_SESSION['conversionHistory']) && count($_SESSION['conversionHistory']) > 0)) {
    ?>
    <div class="p-2 g-col-12">
        <div class="card">
            <div class="card-body">w
                <?php
                if (isset($result)) {
                    printf("<h3>%.{$accuracy}f%s = %.{$accuracy}f%s</h3>", $result['fromValue'], $result['fromUnit'], $result['toValue'], $result['toUnit']);
                    echo '<hr>';
                }

                if (isset($_SESSION['conversionHistory'])) {
                    for ($i = count($_SESSION['conversionHistory']) -2; $i >= 0; $i--) {
                        $result = $_SESSION['conversionHistory'][$i];
                        printf("<h4 class='text-body-secondary'>%.{$accuracy}f%s = %.{$accuracy}f%s</h4>", $result['fromValue'], $result['fromUnit'], $result['toValue'], $result['toUnit']);
                        echo $i === 0 ? '' : '<hr>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<script>
    function updateAccuracy() {
        const convertAccuracy = document.getElementById('convert_accuracy');
        document.getElementById('accuracy_label').innerHTML = convertAccuracy.value;
    }
</script>