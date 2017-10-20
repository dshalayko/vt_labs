<?php
$mainFile = file_get_contents("templates/main.tpl");
$mainMenuContent = file_get_contents("templates/main_menu.tpl");

//insert menu markup from file
$mainFile = str_replace("{MAIN_MENU}", $mainMenuContent, $mainFile);
$mainFile = str_replace("{HEADER_TITLE}", "Lab #3", $mainFile);
//insert current date
$todayDate = getdate();

$mainFile = str_replace("{TODAY_D}", $todayDate["weekday"], $mainFile);
$mainFile = str_replace("{TODAY_M}", $todayDate["month"], $mainFile);
$mainFile = str_replace("{TODAY_Y}", $todayDate["year"], $mainFile);
$mainFile = str_replace("{NOW_H}", $todayDate["hours"], $mainFile);
$mainFile = str_replace("{NOW_M}", $todayDate["minutes"], $mainFile);
$mainFile = str_replace("{NOW_S}", $todayDate["seconds"], $mainFile);

//insert main content
$mainContent = file_get_contents("templates/main_content.tpl");
$mainFile = str_replace("{MAIN_CONTENT}", $mainContent, $mainFile);

//insert news
$news = file_get_contents("templates/news.tpl");
$mainFile = str_replace("{NEWS}", $news, $mainFile);

//insert footer
$footer = file_get_contents("templates/footer.tpl");
$mainFile = str_replace("{FOOTER}", $footer, $mainFile);
$config = file_get_contents("site.cfg");

define("MAIN_COLOR", "MAIN_COLOR");
define("COPYRIGHT_COLOR", "COPYRIGHT_COLOR");

$mainColor = getConfigValue($config, MAIN_COLOR);
$footerColor = getConfigValue($config, COPYRIGHT_COLOR);
$mainFile = str_replace("{MAIN_COLOR}", $mainColor, $mainFile);
$mainFile = str_replace("{COPYRIGHT_COLOR}", $footerColor, $mainFile);

function getConfigValue($configFileContent, $item)
{
    $toFind = $item . ": ";
    $pos = strpos($configFileContent, $toFind);
    $tail = substr($configFileContent, $pos + strlen($toFind));
    $endPos = strpos($tail, ";");
    $result = substr($tail, 0, $endPos);
    return $result;
}

header('Content-Type: text/html; charset=utf-8');
echo $mainFile;
?>