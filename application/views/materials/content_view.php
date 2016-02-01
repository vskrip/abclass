<div id="wrapper">
    <div id="content">
    
<h4 style = "color: red;"><?=$fail_captcha;?></h4>
<h4 style = "color:#7d1114;"><?=$success_comment;?></h4>    

<h3><?=$main_info['title'];?></h3>
<div id="main_content_mat"><?=$main_info['main_text'];?></div>

<?php if($main_info['section0']!='actions'): ?>
<p><br><strong>Добавить комментарий:</strong></p>

<form action = "<?=base_url()."comments/add/$main_info[material_id]";?>" method="post">

<p>Ваше имя<br>
<input type="text" name="author" id="name_text" class="bordo_frame" value="<?=set_value('author');?>"><br>
<strong class="error"><?=form_error('author');?></strong>
</p>

<p>Текст комментария<br>
<textarea class="bordo_frame" name="comment_text" id="comment_text" cols="50" rows="10"><?=set_value('comment_text');?></textarea><br>
<strong><?=form_error('comment_text');?></strong>
</p>

<div class="smile"><?=$smiley_table;?></div>

<a name="captcha"></a>
<p>Введите цифры с картинки:</p>
<p><?=$imgcode?></p>
<p><input type="text" class="bordo_frame" name="captcha" size="10"><br>
<strong><?=form_error('captcha');?></strong>
</p>

<input name = "material_id" type = "hidden" value = "<?=$main_info['material_id'];?>">

<p><input type = "submit" id="post_com_button" name = "post_comment" value = "Комментировать"></p>

</form>
<a name="new_comment"></a>


<?php foreach ($comments_list as $item):?>

<div class="comment">

<p class = "comment">Дата: <?=$item['date'];?><br>
<strong><?=$item['author'];?></strong>:</p>
<?=$item['comment_text'];?>

</div>

<?php endforeach;?>
<?php endif; ?>
<br>
<p><a href="#top">Наверх</a></p>

    </div>
</div>