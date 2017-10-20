<?php
$dbUser = 'root';
$dbPassword = '';
$dbName = 'db_lb';

header("Content-Type:text/xml");
$siteURL = 'http://www.rss.com';

try
{
    $dbh = new PDO('mysql:host=localhost;dbname=' . $dbName, $dbUser, $dbPassword);
}
catch (PDOException $e)
{
    echo 'Error!: ' . $e->getMessage() . '<br/>';
    die();
}

$query = $dbh->prepare("SELECT * FROM news ORDER BY news.date DESC");
$query->execute();
$news = $query->fetchAll();

date_default_timezone_set('Europe/Minsk');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<rss version="2.0">
    <channel>
        <title>Новости</title>
        <link><?php echo $siteURL . '/rss/'; ?></link>
        <description>Свежие новости</description>
        <lastBuildDate><?php echo date(DATE_RFC2822); ?></lastBuildDate>
        <?php for ($i = 0; $i < sizeof($news); $i++): ?>
            <item>
                <title><?php echo $news[$i]['title'] . " ". $news[$i]['date']; ?></title>
                <link><?php echo $siteURL . '/news/?id=' . $news[$i]['id']; ?></link>
                <description><?php echo $news[$i]['content']; ?></description>
                <comments><?php echo $siteURL . '/news/?id=' . $news[$i]['id']; ?></comments>
                <pubDate><?php echo date(DATE_RFC2822, $news[$i]['date']); ?></pubDate>
                <guid><?php echo $siteURL . '/news/?id=' . $news[$i]['id']; ?></guid>
            </item>
        <?php endfor; ?>
    </channel>
</rss>
