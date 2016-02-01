<div id="wrapper">
    <div id="content">

	<p>
		<h4>Добавление акции</h4>
	</p>

<?=get_tinymce();?>

<form action = "<?=base_url();?>materials/add_action" method="post">

	<p>Название акции (маршрут следования)<br>
<input type="text" name="title" value="<?=set_value('title');?>"><br>
<strong><?=form_error('title');?></strong>
</p>

<p>Мета-описание акции<br>
<input type="text" name="description" value="<?=set_value('description');?>"><br>
<strong><?=form_error('description');?></strong>
</p>

<p>Ключевые слова<br>
<input type="text" name="keywords" value="<?=set_value('keywords');?>"><br>
<strong><?=form_error('keywords');?></strong>
</p>

<p>Краткое описание<br>
<textarea name="short_text" cols="75" rows="7"><?=set_value('short_text');?></textarea><br><a href="javascript:setup();">Использовать TinyMCE</a><br>
<strong><?=form_error('short_text');?></strong>
</p>

<p>Полный текст<br>
<textarea name="main_text" cols="75" rows="20"><?=set_value('main_text');?></textarea><br><a href="javascript:setup();">Использовать TinyMCE</a><br>
<strong><?=form_error('main_text');?></strong>
</p>

<input type="hidden" name = "section[]" value="actions" />

<p><br><input type = "submit" name = "add_button" value = "Добавить акцию"></p>

</form>

<p><br><a href="#top">Наверх</a></p>
       <br>     
    </div>
</div>