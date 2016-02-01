<div id="wrapper">
    <div id="content">
		<p><h4>Редактирование разделов</h4></p>
		<table style="width:90%;">
			<tr>
				<td>
					<h4>Бестселлеры:</h4>
					<?php foreach ($best_list as $item):?>
							<strong><? echo $item['title']; ?>&nbsp;(<? echo $item['section_id']; ?>)</strong>&nbsp;&nbsp;&nbsp;&nbsp;<a href = "<?=base_url()."sections/edit/$item[section_id]";?>" title="Редактировать"><img src="<?=base_url();?>img/edit.png" alt="Редактировать"></a><br>
						<? foreach($item['child_sections_list'] as $ch_sect): ?>
							&nbsp;&nbsp;&nbsp;&nbsp;<? echo $ch_sect['title']; ?>&nbsp;(<? echo $ch_sect['section_id']; ?>)&nbsp;&nbsp;&nbsp;&nbsp;<a href = "<?=base_url()."sections/edit/$ch_sect[section_id]";?>" title="Редактировать"><img src="<?=base_url();?>img/edit.png" alt="Редактировать"></a><br>
						<? endforeach; ?>
					<?php endforeach;?>
				</td>
				<td>
					<h4>Типы туров:</h4>
					<?php foreach ($type_tours as $item):?>
						<? echo $item['title']; ?>&nbsp;(<? echo $item['section_id']; ?>)&nbsp;&nbsp;&nbsp;&nbsp;<a href = "<?=base_url()."sections/edit/$item[section_id]";?>" title="Редактировать"><img src="<?=base_url();?>img/edit.png" alt="Редактировать"></a><br>
					<?php endforeach;?>
				</td>
			</tr>	
		</table>
		<p><br><a href="#top">Наверх</a></p>
		<br>
	</div>
</div>