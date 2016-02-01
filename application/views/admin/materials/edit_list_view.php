<div id="wrapper">
    <div id="content">

<p><h4>Управление
	<?php if($cur_mat == 'tours'):?>
		турами
	<? elseif($cur_mat == 'news'):?>
		новостями
	<? elseif($cur_mat == 'notes'):?>
		отзывами
	<? elseif($cur_mat == 'actions'):?>
		акциями
	<? elseif($cur_mat == 'hotels'):?>
		отелями
	<? elseif($cur_mat == 'rests'):?>
		ресторанами
	<? else: ?>
		материалами
	<? endif; ?>
	</h4>
</p>
<div>
	<img src="<?=base_url();?>img/add.png" />&nbsp;&nbsp;
	<?php if($cur_mat == 'tours'):?>
		<a href = "<?=base_url()."materials/add_tour";?>" title="Создать тур">Добавить тур</a>
	<? elseif($cur_mat == 'news'):?>
		<a href = "<?=base_url()."materials/add_news";?>" title="Создать новость">Добавить новость</a>
		&nbsp;&nbsp;<img src="<?=base_url();?>img/edit.png" />&nbsp;&nbsp;<a href = "<?=base_url()."sections/edit/news";?>" title="Редактировать страницу новостей">Редактировать страницу новостей</a>
	<? elseif($cur_mat == 'notes'):?>
		<a href = "<?=base_url()."materials/add_note";?>" title="Создать отзыв">Добавить отзыв</a>
		&nbsp;&nbsp;<img src="<?=base_url();?>img/edit.png" />&nbsp;&nbsp;<a href = "<?=base_url()."sections/edit/notes";?>" title="Редактировать страницу отзывов">Редактировать страницу отзывов</a>
	<? elseif($cur_mat == 'actions'):?>
		<a href = "<?=base_url()."materials/add_action";?>" title="Создать акцию">Добавить акцию</a>
		&nbsp;&nbsp;<img src="<?=base_url();?>img/edit.png" />&nbsp;&nbsp;<a href = "<?=base_url()."sections/edit/actions";?>" title="Редактировать страницу акций">Редактировать страницу акций</a>
	<? elseif($cur_mat == 'hotels'):?>
		<a href = "<?=base_url()."materials/add_hotel";?>" title="Создать отель">Добавить отель</a>
		&nbsp;&nbsp;<img src="<?=base_url();?>img/edit.png" />&nbsp;&nbsp;<a href = "<?=base_url()."sections/edit/hotels";?>" title="Редактировать страницу отелей">Редактировать страницу отелей</a>
	<? elseif($cur_mat == 'rests'):?>
		<a href = "<?=base_url()."materials/add_rest";?>" title="Создать ресторан">Добавить ресторан</a>
		&nbsp;&nbsp;<img src="<?=base_url();?>img/edit.png" />&nbsp;&nbsp;<a href = "<?=base_url()."sections/edit/rests";?>" title="Редактировать страницу ресторанов">Редактировать страницу ресторанов</a>
	<? else: ?>
		<a href = "<?=base_url()."materials/add";?>" title="Создать материал">Добавить материал</a>
	<? endif; ?>
	<br><br>
</div>

<table style="width:90%;">
	<?php foreach ($materials_list as $item):?>
		<tr>
			<td>
				<?="$item[title]";?>
			</td>
			<td style="width: 10px;">
				<a href = "<?=base_url()."materials/edit/$item[material_id]";?>" title="Редактировать"><img src="<?=base_url();?>img/edit.png" alt="Редактировать"></a>
			</td>
			<td style="width: 10px;">
				<a href = "<?=base_url()."materials/delete/$item[material_id]";?>" title="Удалить" onclick="return confirm('Вы уверены, что хотите удалить данный материал с сайта?')"><img src="<?=base_url();?>img/delete.png" alt="Удалить"></a>
			</td>
		</tr>
	<?php endforeach;?>	
</table>
<br>
<?=$page_nav;?>

<p><br><a href="#top">Наверх</a></p>
	<br>
    </div>
</div>