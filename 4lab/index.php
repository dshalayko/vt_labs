<?php
$dbUser = 'root';
$dbPassword = '';
$dbName = 'db_lb';
//подключение к бд
try {
    $dbh = new PDO('mysql:host=localhost;dbname=' . $dbName, $dbUser, $dbPassword);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$limit = filter_input(INPUT_GET, 'limit', FILTER_SANITIZE_NUMBER_INT);
$limit = ($limit) ? (int)$limit :5 ;

$query = $dbh->prepare("SELECT * FROM news ORDER BY news.date DESC LIMIT $limit");
$query->bindValue(':limitNews', $limit, PDO::PARAM_INT);
$query->execute();
$news = $query->fetchAll();

$query = $dbh->prepare("SELECT * FROM pages");
$query->execute();
$resources = $query->fetchAll();
?>


    <!doctype html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Задание №4</title>
    </head>
    <body>
    <div class="content">
        <h1>Свежие новости</h1>
        <?php
        for ($i = 0; $i < sizeof($news); $i++) {
            $content = file_get_contents('templates/news.tpl');
            echo str_replace(array('{TITLE}', '{PUBLISH_DATE}', '{CONTENT}'),
                array($news[$i]['title'],  $news[$i]['date'], $news[$i]['content']), $content);
        }
        ?>
        <br/>


        <h1>Меню сайта</h1>
        <?php
        $menuItems = array();
        for ($i = 0; $i < sizeof($resources); $i++) {
            $menuItems[$resources[$i]['parent_id']][] = $resources[$i];
        }

        $menu = '';
        if ($menuItems) {
            ksort($menuItems, SORT_NUMERIC);
            $topItems = current($menuItems);
            if ($topItems && is_array($topItems)) {
                $menu = '<ul>';
                foreach ($topItems as $item) {
                    $menu .= '<li>';
                    $menu .= '<a href="/4lab/newsid=' . $item['id'] . '">' . $item['title'] . '</a>';
                    if (is_array($menuItems) && sizeof($menuItems[$item['id']]) > 0) {
                        $menu .= createMenuNode($menuItems, $item['id']);
                    }
                    $menu .= '</li>';
                }
                $menu .= '</ul>';
            }
        }

        echo $menu;
        ?>
    </div>
    </body>
    </html>

<?php
function createMenuNode($items = array(), $parentId = 0)
{
    $output = '';
    if (is_array($items) && sizeof($items[$parentId]) > 0) {
        $output = '<ul>';
        foreach ($items[$parentId] as $item) {
            $output .= '<li>';
            $output .= '<a href="/4lab/newsid=' . $item['id'] . '">' . $item['title'] . '</a>';
            if (is_array($items) && sizeof($items[$item['id']]) > 0) {
                $output .= createMenuNode($items, $item['id']);
            }
            $output .= '</li>';
        }
        $output .= '</ul>';
    }

    return $output;
}

?>