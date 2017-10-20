<?php header('Content-Type: text/html; charset=utf-8'); ?>
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
            : "<p>Какой то текст</p>\n<!--комментарий-->\n<!--\n    многострочный\n    комментарий\n-->\n" .
            "<a href='.'>Ссылка</a>\n<!--[if IE]>\n    <font color='red'>IE</font>\n" .
            "<![endif]-->\n<!-- еще один [комментарий]-->\n<p>Еще текст</p>\n<!---->" ?></textarea>
    <br />
    Регулярное выражение:<br />
    <textarea name="regex" cols="100" rows="1"><?php echo is-set($_POST["text"]) ?
            $_POST["regex"]
            : "/<!--([^[][\s\S]*?)*?-->/" ?></textarea>
    <br />
    <input type="submit" value="Обработать текст и вывести результат" />
    <br />
</form>
<?php
if (isset($_POST["text"]) && !empty($_POST["text"]) && is-set($_POST["regex"]) && !empty($_POST["regex"]))
{
    $text = $_POST["text"];
    $pattern = $_POST["regex"];
    // $htmlfile_content = file_get_contents($_POST["htmlfile"]);
    $text = preg_replace($pattern, "", $text);
    $text = htmlspecialchars($text);
    $text = preg_replace("/\n/", "<br />", $text);
    echo "<p>$text</p>";
}
?>
</body>
</html>
