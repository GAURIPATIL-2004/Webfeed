<?php
if (!isset($_GET["q"])) {
    exit();
}

$q = $_GET["q"];

if ($q == "Google") {
    $xml = "https://news.google.com/rss";
} elseif ($q == "ZDN") {
    $xml = "https://www.zdnet.com/news/rss.xml";
} else {
    exit("Invalid RSS feed selection.");
}

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

$channel = $xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')->item(0)->nodeValue;

echo "<p><a href='" . $channel_link . "'>" . $channel_title . "</a></p>";
echo "<p>" . $channel_desc . "</p>";

$items = $xmlDoc->getElementsByTagName('item');
for ($i = 0; $i < min(3, $items->length); $i++) {
    $item = $items->item($i);
    $item_title = $item->getElementsByTagName('title')->item(0)->nodeValue;
    $item_link = $item->getElementsByTagName('link')->item(0)->nodeValue;
    $item_desc = $item->getElementsByTagName('description')->item(0)->nodeValue;

    echo "<p><a href='" . $item_link . "'>" . $item_title . "</a><br>" . $item_desc . "</p>";
}
?>
