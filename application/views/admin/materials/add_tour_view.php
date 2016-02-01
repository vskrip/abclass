<div id="wrapper">
    <div id="content">

	<p>
		<h4>Добавление тура</h4>
	</p>

<?=get_tinymce();?>

<form action = "<?=base_url();?>materials/add_tour" method="post">

	<p>Название тура
		<br>
<input type="text" name="title" value="<?=set_value('title');?>"><br>
<strong><?=form_error('title');?></strong>
</p>

<p>Мета-описание тура<br>
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
<strong><?=form_error('main_text');?></strong><br>
</p>
	<p><strong>Бестселлеры</strong><br><br>

	<?php foreach($best_list as $item): ?>
		<strong><? echo $item['title']; ?>&nbsp;(<? echo $item['section_id']; ?>)<br></strong>
		<? foreach($item['child_sections_list'] as $ch_sect): ?>
		<input type = "checkbox" name = "section[]" value = <?=$ch_sect['section_id']; ?> <?=set_checkbox('section[]',$ch_sect['section_id']);?>><?=$ch_sect['title']; ?>&nbsp;(<?=$ch_sect['section_id']; ?>)<br>
		<? endforeach; ?>
	<? endforeach; ?>
	
	
	<strong><?=form_error('section[]');?></strong>
	</p>		
<br>
<p><input type = "submit" name = "add_button" value = "Добавить тур"></p>

</form>

<p><br><a href="#top">Наверх</a></p>
       <br>     
    </div>
</div>