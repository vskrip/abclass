<div id="wrapper">
    <div id="content">
    
<p><h4>Редактировать раздел</h4></p>

<?=get_tinymce();?>

<form action = "<?=base_url()."sections/update/$section_id";?>" method="post">

<p>Название раздела<br>
<input type="text" name="title" value="<?=set_value('title', $title);?>"><br>
<strong><?=form_error('title');?></strong>
</p>

<p>Мета-описание раздела<br>
<input type="text" name="description" value="<?=set_value('description', $description);?>"><br>
<strong><?=form_error('description');?></strong>
</p>

<p>Ключевые слова<br>
<input type="text" name="keywords" value="<?=set_value('keywords', $keywords);?>"><br>
<strong><?=form_error('keywords');?></strong>
</p>

<p>Краткое описание раздела<br>
<textarea id="about_text" name="main_text" cols="75" rows="7"><?=set_value('main_text',$main_text);?></textarea><br><a href="javascript:setup();">Использовать TinyMCE</a><br>
<strong><?=form_error('main_text');?></strong>
<br>
</p>

<p><input type = "submit" name = "update_button" value = "Обновить  раздел"></p>
<br>
</form>
           
    </div>
</div>