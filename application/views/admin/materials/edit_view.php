<div id="wrapper">
    <div id="content">

<p><h4>Редактирование 
	<?php if($section0 == 'news'):?>
		новости
	<? elseif($section0 == 'notes'):?>
		отзыва
	<? elseif($section0 == 'actions'):?>
		акций
	<? elseif($section0 == 'hotels'):?>
		отеля
	<? elseif($section0 == 'rests'):?>
		ресторана
	<? else: ?>
		тура
	<? endif; ?>	
</h4></p>

<?=get_tinymce();?>

<form action = "<?=base_url()."materials/update/$material_id";?>" method="post">

<p>Название 
	<?php if($section0 == 'news'):?>
		новости
	<? elseif($section0 == 'notes'):?>
		отзыва
	<? elseif($section0 == 'actions'):?>
		акции
	<? elseif($section0 == 'hotels'):?>
		отеля
	<? elseif($section0 == 'rests'):?>
		ресторана
	<? else: ?>
		тура
	<? endif; ?>
<br>
<input type="text" name="title" maxlength="200" value="<?=set_value('title', $title);?>"><br>
<strong><?=form_error('title');?></strong>
</p>

<p>Мета-описание 
	<?php if($section0 == 'news'):?>
		новости
	<? elseif($section0 == 'notes'):?>
		отзыва
	<? elseif($section0 == 'actions'):?>
		акции
	<? elseif($section0 == 'hotels'):?>
		отеля
	<? elseif($section0 == 'rests'):?>
		ресторана
	<? else: ?>
		тура
	<? endif; ?>	
<br>
<input type="text" name="description" value="<?=set_value('description', $description);?>"><br>
<strong><?=form_error('description');?></strong>
</p>

<p>Ключевые слова<br>
<input type="text" name="keywords" value="<?=set_value('keywords', $keywords);?>"><br>
<strong><?=form_error('keywords');?></strong>
</p>

<p>Краткое описание<br>
<textarea name="short_text" id="short_text" cols="75" rows="7"><?=set_value('short_text', $short_text);?></textarea><br><a href="javascript:setup();">Использовать TinyMCE</a><br>
<strong><?=form_error('short_text');?></strong>
</p>

<p>Полный текст<br>
<textarea name="main_text" id="main_text" cols="75" rows="20"><?=set_value('main_text', $main_text);?></textarea><br><a href="javascript:setup();">Использовать TinyMCE</a><br>
<strong><?=form_error('main_text');?></strong>
</p>

	<?php if($section0 == 'news' OR $section0 == 'notes'):?>
		<p>Дата добавления<br>
		<input type="text" name="date" value="<?=set_value('date', $date);?>"><br>
		<strong><?=form_error('date');?></strong>
		</p>
	<? endif; ?>	

	<?php if($section0 == 'news'):?>
		<p>Источник<br>
		<input type="text" name="author" value="<?=set_value('author', $author);?>"><br>
		<strong><?=form_error('author');?></strong>
		</p>
	<? elseif($section0 == 'notes'):?>
		<p>Автор материала<br>
		<input type="text" name="author" value="<?=set_value('author', $author);?>"><br>
		<strong><?=form_error('author');?></strong>
		</p>
	<? endif; ?>
	<?php if($section0 == 'news'):?>
		<input type="hidden" name = "section[]" value="news" />
	<? elseif($section0 == 'notes'):?>
		<input type="hidden" name = "section[]" value="notes" />
	<? elseif($section0 == 'actions'):?>
		<input type="hidden" name = "section[]" value="actions" />
	<? elseif($section0 == 'hotels'):?>
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
						<input type = "checkbox" name = "country" value = <?=$countrs['id']; ?> <?=populate_other($countrs['id'],$country);
						echo set_checkbox('country',$countrs['id']);?>>&nbsp;<?=$countrs['title']; ?><br>
					<?php endforeach; ?>
				<?php endforeach; ?>
				<strong><?=form_error('country');?></strong>
				</td>
				<!-- Type hotels block -->
				<td>	
				<?php if(isset($type_hotels)): ?>
					<?php foreach($type_hotels as $item): ?>
						<input type = "checkbox" name = "hotel_type_id" value = <?=$item['id']; ?> <?=populate_other($item['id'],$hotel_type_id);
						echo set_checkbox('hotel_type_id',$item['id']);?>>&nbsp;<?=$item['title']; ?><br>
					<? endforeach; ?>
				<?php endif; ?>
				<strong><?=form_error('hotel_type_id');?></strong>
				</td>
			</tr>	
		</table>
	<? elseif($section0 == 'rests'):?>
		<input type="hidden" name = "section[]" value="rests" />
		<table>
			<tr>
				<td><strong>Страны:</strong></td>
			</tr>
			<tr>	
				<td>
				<?php foreach($continents as $contis): ?>
				<strong><?=$contis['title'];?></strong><br>
					<?php foreach($contis['countries'] as $countrs): ?>
						<input type = "checkbox" name = "country" value = <?=$countrs['id']; ?> <?=populate_other($countrs['id'],$country);
						echo set_checkbox('country',$countrs['id']);?>>&nbsp;<?=$countrs['title']; ?><br>
					<?php endforeach; ?>
				<?php endforeach; ?>
				<strong><?=form_error('country');?></strong>
				</td>
			</tr>
		</table>
	<? else: ?>
		<table>
			<tr>
				<td>
					<p><strong>Бестселлеры:</strong><br><br>
					<?php foreach($best_list as $item): ?>
						<strong><? echo $item['title']; ?>&nbsp;(<? echo $item['section_id']; ?>)<br></strong>
						<? foreach($item['child_sections_list'] as $ch_sect): ?>
						<input type = "checkbox" name = "section[]" value = <?=$ch_sect['section_id']; ?> <?=populate($material_id,$names,$ch_sect['section_id']);
						echo set_checkbox('section[]',$ch_sect['section_id']);?>><?=$ch_sect['title']; ?>&nbsp;(<?=$ch_sect['section_id']; ?>)<br>
						<? endforeach; ?>
					<? endforeach; ?>					
					<strong><?=form_error('section[]');?></strong>
					</p>
				</td>
				<td>
					<p><strong>Тип тура:</strong></p><br>
					<?php foreach($type_tours_list as $item): ?>
						<input type = "checkbox" name = "section[]" value = <?=$item['section_id']; ?> <?=populate($material_id,$names,$item['section_id']);
						echo set_checkbox('section[]',$item['section_id']);?>><?=$item['title']; ?>&nbsp;(<?=$item['section_id']; ?>)<br>
					<? endforeach; ?>
				</td>
			</tr>
		</table>
	<? endif; ?>
<p><br><input type = "submit" name = "update_button" value = "Обновить"></p>

</form>

<p><br><a href="#top">Наверх</a></p>
       <br>    
    </div>
</div>