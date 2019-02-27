<?php
// модель
class GetItemLentaRSS{
    public function getItem($url, $count){
        $lenta_content = file_get_contents($url);
        $lenta_item_rss = new SimpleXmlElement($lenta_content);

        $arr_content_rss = array();

        foreach ($lenta_item_rss->channel->item as $item) {
            $arr_content_rss[] = $item;
        }
        // обрезаем массив до нужного нам количества записей
        $arr_content_rss = array_slice($arr_content_rss, 0, $count);

        return $arr_content_rss;
    }
}

// контроллер

class ViewItemRSS
{
    public function viewItem($count)
    {
        $ItemRSS = new GetItemLentaRSS();
        $arr_content_rss = $ItemRSS->getItem('https://lenta.ru/rss', $count);
        return $arr_content_rss;
    }
}

// представление
$ViewItem = new ViewItemRSS();
$arr_content_rss = $ViewItem->viewItem(5);


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