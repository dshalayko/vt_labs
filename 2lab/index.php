<?
define('HTML_NEW_LINE', '<br>');
header('Content-Type: text/html; charset=utf-8');

echo "<b/>Задание 1.</b>  ";
echo HTML_NEW_LINE;
echo "<br/>";
$int = 5;
$boolean = true;
$double = 5.5;
$str = "abc";
$arr = array("10", "11", "12");
echo $int . " - целочисленный<br />";
echo $double . " - дробный<br />";
echo $str . " - строковый<br />";
echo $boolean . " - логический<br />";
print_r($arr);
echo " - массив<br/>";
echo "<br/>";

echo "<b/>Задание 2.</b>";
$a = 555;
$b = "ZZZ";
echo HTML_NEW_LINE;
echo "<br/>";

echo "а) как цифры:";
echo HTML_NEW_LINE;
echo "a+b = ";
echo $a + (int)$b;
echo HTML_NEW_LINE;

echo "<br/>";
echo "б) как строки:";
echo HTML_NEW_LINE;
echo "a+b = ";
echo $a . $b;
echo HTML_NEW_LINE;
echo "<br/>";

echo "<b/>Задание 3.</b>";

define('NAME', "name");
define('PHONE', "phone");
define('EMAIL', "email");

$employees[0][NAME] = 'Иванов';
$employees[0][PHONE] = '111-22-33';
$employees[0][EMAIL] = 'ivanov@domain.com';

$employees[1][NAME] = 'Петров';
$employees[1][PHONE] = '112-24-36';
$employees[1][EMAIL] = 'petrov@domain.com';

$employees[2][NAME] = "Сидоров";
$employees[2][PHONE] = '113-25-37';
$employees[2][EMAIL] = 'sidorov@domain.com';

echo HTML_NEW_LINE;
echo HTML_NEW_LINE;
function ShowMultiDimentionalArray($elements)
{
    $dimensions = sizeof($elements);
    for ($i = 0; $i < $dimensions; $i++) {
        foreach ($elements[$i] as $item) {
            echo $item . " ";
        }
        echo HTML_NEW_LINE;
    }
}

ShowMultiDimentionalArray($employees);

function ShowArray($input)
{
    foreach ($input as $item) {
        echo $item . " ";
    }
}

echo "<br/><b/>Задание 4.</b><br/>";

$elements = array(1, 2, 'A', 3.764, 34, 'B', 12);

echo HTML_NEW_LINE . 'Исходный массив: ';

ShowArray($elements);


for ($i = 0; $i < count($elements); $i++) {
    $type = gettype($elements[$i]);

    if ($type != 'integer' and $type != 'double') {
        unset($elements[$i]);
    }
}

echo HTML_NEW_LINE . 'Измененный массив: ';
ShowArray($elements);

echo "<br/><b/>Задание 5.</b><br/>";
echo '<table style="border-collapse: collapse">
        <thead>
            <tr>
                <td>#</td>
                <td>1</td>
                <td>2</td>
            </tr>
        </thead>';

$currentColorValue = 0;

for ($i = 0; $i < 1000; $i++) {
    if ($currentColorValue == 256) {
        $currentColorValue = 0;
    }


    $number = $i + 1;
    $hexCurrentColorValue = dechex($currentColorValue);
    $strColorValue = $hexCurrentColorValue . $hexCurrentColorValue . $hexCurrentColorValue;
    echo '<tr>
            <td style="border: 1px solid">' . ($i + 1) . '</td>
            <td style="border: 1px solid; width: 30px; background-color: #' . $strColorValue . '">
            <td style="border: 1px solid">' . $strColorValue . '
            </td>
          </tr>';


    $currentColorValue++;
}
echo "</table>";
?>