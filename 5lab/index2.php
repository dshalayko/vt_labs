<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!doctype html>
<html>
<head>
    <title>Задание 3</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<a href="index.html">Назад</a>
<form method="post">
    <textarea name="text" cols="100" rows="15"><?php echo is-set($_POST["text"]) ?
            $_POST["text"]
            : "<p>text <a href='..'>link</a></p><br />\n<span style='color: red;'>red text</span>" ?></textarea>
    <br />
    Регулярное выражение:<br />
    <textarea name="regex" cols="100" rows="1"><?php echo is-set($_POST["text"]) ?
            $_POST["regex"]
            : "/<[\s\S]*?>/" ?></textarea>
    <br />
    <input type="submit" value="Обработать текст" />
    <br />
</form>
<?php
if (isset($_POST["text"]) && !empty($_POST["text"]) && is-set($_POST["regex"]) && !empty($_POST["regex"]))
{
    $text = $_POST["text"];
    $pattern = $_POST["regex"];
    $text = preg_replace($pattern, "", $text);
    $text = preg_replace("/\n/", "<br />", $text);
    echo "<p>$text</p>";
}
?>
</body>
</html>
