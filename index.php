<?php
// url  до источника rss
$lenta_url_rss = 'https://lenta.ru/rss';
// количество выводимых записей
$count_view_item = 5;

$lenta_content = file_get_contents($lenta_url_rss);
$lenta_item_rss = new SimpleXmlElement($lenta_content);

$arr_content_rss = array();

foreach($lenta_item_rss -> channel -> item as $item) {
    $arr_content_rss[] = $item;
}

// обрезаем массив до нужного нам количчества записей
$arr_content_rss = array_slice($arr_content_rss, 0, $count_view_item);

foreach ($arr_content_rss as $item){
    ?>
    <div style="width: 500px;margin: 50px;">
        <h3><?=$item->title?></h3>
        <a href="<?=$item->link?>" target="_blank">подробнее >></a>
        <p><?=$item->description?></p>
    </div>
    <?php
}

?>