<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!doctype html>
<html>
<head>
    <title>Задание 5</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Адреса электронной почты:<br />
    <textarea name="text" cols="100" rows="15"><?php echo isset($_POST["text"]) ?
            $_POST["text"]
            : "vasya-pupkin@mail.com\nvasya_pupkin@mail.com\nvasya.pupkin@mail.com\n" .
            "v.v.pupkin@firma.mail.com\nv.v.pupkin@firma-mail.com\nv.v.pupkin12@firma_mail.com\n" .
            "v.v.pupkin-director@firma.mail.com\n\n-vasya--pupkin@mail.com\nvasya_pupkin@mail..com\n" .
            "vasya.-pupkin@mail.com\nv.v.pup kin@firma.mail.com\nv.v.pup#kin@firma-mail.com_" ?></textarea>
    <br />
    Регулярное выражение:<br />
    <textarea name="regex" cols="100" rows="1"><?php echo isset($_POST["text"]) ?
            $_POST["regex"]
            : "/^\w+(?:(?:\.|-)?\w+)*?@(?:\w(?:[\w-]*\w)?\.)+\w(?:[\w-]*\w)?$/i" ?></textarea>
    <br />
    <input type="submit" value="Проверить">
    <br />
</form>
<?php
if (isset($_POST["text"]) && !empty($_POST["text"]) && isset($_POST["regex"]) && !empty($_POST["regex"]))
{
    $text = $_POST["text"];
    $pattern = $_POST["regex"];
    echo "<p>";

    foreach (preg_split("/$\R?^/m", $text) as $key => $value) {
        $address = trim($value);
        if (!empty($address))
        {
            if (preg_match($pattern, $address))
            {
                echo "<span style='color: green;'>$address - Адрес корректен.</span>";
            }
            else
            {
                echo "<span style='color: red;'>$address</span> - Адрес некорректен.";
            }
            echo "<br />";
        }
    }
    echo "</p>";
}
?>
</body>
</html>

