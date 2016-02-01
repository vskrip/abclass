<div id="wrapper">
    <div id="content">

<h4>Главная страница</h4>

<p><strong>Всего на сайте:</strong></p>
<br>
<div class="comment">
<p>Туров: <?=$tours_count;?>, Новостей: <?=$news_count;?>, Отзывов: <?=$notes_count;?>, Комментариев: <?=$comments_count;?>, Категорий: <?=$sections_count;?>, Страниц: <?=$pages_count;?></p>
</div><br>
<p><strong>Самые популярные материалы:</strong></p>
<br>
<div class="comment">
<?php foreach ($popular_materials as $item):?>

<p><a href = "<?=base_url()."materials/$item[material_id]";?>"><?=$item['title'];?></a> (<?=$item['count_views'];?> просмотра(ов))</p>

<?php endforeach;?>
</div>
<br>
<p><strong>Последние комментарии:</strong></p>
<br>
<?php foreach ($latest_comments as $item):?>

<div class="comment">
<p class = "comment">Дата: <?=mdate("%d.%m.%Y",mysql_to_unix($item['date']));?><br>
<strong><?=$item['author'];?></strong>:</p>
<p><?=$item['comment_text'];?></p>
<p><a href = "<?=base_url()."materials/$item[material_id]#captcha";?>">Ответить на комментарий</a></p>
</div>
<br>
<?php endforeach;?>
<br>

<p><a href="#top">Наверх</a></p>
<br>
    </div>
</div>