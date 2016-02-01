<div id="wrapper">
    <div id="content">

	<p>
		<strong>Добавление
		<?php if($cur_mat == 'tour'):?>
			тура
		<? elseif($cur_mat == 'news'):?>
			новости
		<? elseif($cur_mat == 'note'):?>
			отзыва
		<? else: ?>
			материала
		<? endif; ?>	
		</strong>
	</p>

<?=get_tinymce();?>

<form action = "<?=base_url();?>materials/add" method="post">

	<p>Название 
		<?php if($cur_mat == 'tour'):?>
			тура
		<? elseif($cur_mat == 'news'):?>
			новости
		<? elseif($cur_mat == 'note'):?>
			отзыва
		<? else: ?>
			материала
		<? endif; ?>		
	<br>
<input type="text" name="title" value="<?=set_value('title');?>"><br>
<strong><?=form_error('title');?></strong>
</p>

<p>Мета-описание
		<?php if($cur_mat == 'tour'):?>
			тура
		<? elseif($cur_mat == 'news'):?>
			новости
		<? elseif($cur_mat == 'note'):?>
			отзыва
		<? else: ?>
			материала
		<? endif; ?>	
		<br>
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
		<?php if($cur_mat != 'tour'):?>
			<p>Дата добавления<br>
			<input type="text" name="date" value = "<? $date = date ("Y-m-d"); echo $date;?>"><br>
			<strong><?=form_error('date');?></strong>
			</p>
		<? endif; ?>	

	<p>
		<?php if($cur_mat == 'tour'):?>
		<? elseif($cur_mat == 'news'):?>
			Источник новости
		<? elseif($cur_mat == 'note'):?>
			Автор отзыва
		<? else: ?>
			Автор материала
		<? endif; ?>	
	<br>
		<?php if($cur_mat != 'tour'):?>
		<input type="text" name="author" value="<?=set_value('author');?>"><br>
		<strong><?=form_error('author');?></strong>
		<? endif; ?>
	</p>

		<?php if($cur_mat == 'tour'):?>
			<p>Бестселлеры<br>
			<input type = "checkbox" name = "section[]" value = "news" <?=set_checkbox('section[]','news')?>>Новости<br>
			<input type = "checkbox" name = "section[]" value = "notes" <?=set_checkbox('section[]','notes')?>>Отзывы<br>
			<input type = "checkbox" name = "section[]" value = "php" <?=set_checkbox('section[]','php')?>>PHP<br>
			<input type = "checkbox" name = "section[]" value = "css" <?=set_checkbox('section[]','css')?>>CSS<br>
			
			<strong><?=form_error('section[]');?></strong>
			</p>		
		<? elseif($cur_mat == 'news'):?>
			<input type="hidden" name = "section[]" value="news" />
			<input type="hidden" name = "ban_img_url" value="img/ban_news.jpg" />			
		<? elseif($cur_mat == 'note'):?>
			<input type="hidden" name = "section[]" value="notes" />
			<input type="hidden" name = "ban_img_url" value="img/ban_notes.jpg" />
		<? else: ?>
		<? endif; ?>	

<p><input type = "submit" name = "add_button" value = "Добавить"></p>

</form>

<p><a href="#top">Наверх</a></p>
            
    </div>
</div>