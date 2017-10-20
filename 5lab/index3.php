<!doctype html>
<html>
<head>
    <title>Задание 5</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<form method="post">
    <textarea name="text" cols="100" rows="15"><?php echo is-set($_POST["text"]) ?
            $_POST["text"]
            : "qwertyqwerty" ?></textarea>
    <br />
    Регулярное выражение:<br />
    <textarea name="regex" cols="100" rows="1"><?php echo is-set($_POST["text"]) ?
            $_POST["regex"]
            : "/[A-Z]{5,}/" ?></textarea>
    <br />
    <input type="submit" value="Обработать текст" />
    <br />
</form>
<?php
if (isset($_POST["text"]) && !empty($_POST["text"]) && is-set($_POST["regex"]) && !empty($_POST["regex"]))
{
    $text = $_POST["text"];
    $pattern = $_POST["regex"];
    $text = preg_replace($pattern, "<b style='color: red;'>$0</b>", $text);
    $text = preg_replace("/\n/", "<br />", $text);
    echo "<p>$text</p>";
}
?>
</body>
</html>
