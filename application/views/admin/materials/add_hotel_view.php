<div id="wrapper">
    <div id="content">

	<p>
		<h4>Добавление отеля</h4>
	</p>

<?=get_tinymce();?>

<form action = "<?=base_url();?>materials/add_hotel" method="post">

	<p>Название отеля<br>
<input type="text" name="title" value="<?=set_value('title');?>"><br>
<strong><?=form_error('title');?></strong>
</p>

<p>Мета-описание отеля<br>
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

<input type="hidden" name = "section[]" value="hotels" />

	<table>
		<tr>
			<td>
				<p><strong>Страны:</strong></p>
			</td>
			<td>
				<p><strong>Типы отелей:</strong></p>
			</td>
		</tr>
		<tr>
			<td>
			<?php foreach($continents as $contis): ?>
			<strong><?=$contis['title'];?></strong><br>
				<?php foreach($contis['countries'] as $countrs): ?>
					<input type = "checkbox" name = "country" value = <?=$countrs['id']; ?> <?=set_checkbox('country',$countrs['id']);?>>&nbsp;<?=$countrs['title']; ?><br>
				<?php endforeach; ?>
			<?php endforeach; ?>
			<strong><?=form_error('country');?></strong>
			</td>
			<!-- Type hotels block -->
			<td>	
			<?php if(isset($type_hotels)): ?>
				<?php foreach($type_hotels as $item): ?>
					<input type = "checkbox" name = "hotel_type_id" value = <?=$item['id']; ?> <?=set_checkbox('hotel_type_id',$item['id']);?>>&nbsp;<?=$item['title']; ?><br>
				<? endforeach; ?>
			<?php endif; ?>
			<strong><?=form_error('hotel_type_id');?></strong>
			</td>
		</tr>	
	</table>

<p><br><input type = "submit" name = "add_button" value = "Добавить отель"></p>

</form>

<p><br><a href="#top">Наверх</a></p>
       <br>     
    </div>
</div>