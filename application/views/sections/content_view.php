<div id="wrapper">
    <div id="content">
<?php if(($main_info['section_id']=='hotels')||($main_info['section_id']=='rests')):?>
	<h3><?=$main_info['current_country_title'];?>&nbsp;<?=$main_info['title'];?>&nbsp;<?=$main_info['current_type_hotel_title'];?></h3>
	<?php if(isset($main_info['cur_type_hotel_desc'])) :?>
		<p><?=$main_info['cur_type_hotel_desc'];?></p>
	<?php endif;?>
<?php else:?>
	<h3><?=$main_info['title'];?></h3>
<?php endif;?>
<?=$main_info['main_text'];?>

<table class="mat_block">

<?php foreach ($materials_list as $item):?>
	<tr>
		<td class="mat_block_title" colspan="2">
			<? if($item['section0']== 'news'): ?>
				<span class="contr_title"><?=mdate("%d.%m.%Y",mysql_to_unix($item['date']));?></span>&nbsp;&nbsp;<a href="<?=base_url()."materials/$item[material_id]";?>"><?=$item['title']?></a>
			<? else: ?>
				<a href="<?=base_url()."materials/$item[material_id]";?>"><?=$item['title']?></a>
			<? endif ?>
		</td>
	</tr>
	<tr>
		<?php if($item['small_img_url']):?>
			<td class="mat_img">
			<a href="<?=base_url()."materials/$item[material_id]";?>">
				<img class="box_content" src="<?=base_url();?><?=$item['small_img_url'];?>" alt="<?=$item['title'];?>">
			</a>
			</td>
			<td style="vertical-align:top; width:100%;">
				<?=$item['short_text'];?>
			</td>
		<? else: ?>
		<td colspan = "2">
			<?=$item['short_text'];?>
		</td>
		<? endif ?>
	</tr>
	<tr>
		<td></td>
		<td style="float:right; margin-top: 10px;">
			<!--Просмотров:&nbsp;<?=$item['count_views']?>-->
			<? if($item['section0'] == 'news' && $item['author'] !=""):?>
				<br>Источник:&nbsp;<?=$item['author']?>
			<? endif ?>
			<? if($item['section0'] == 'notes' && $item['author'] !=""): ?>
				<br>Автор:&nbsp;<?=$item['author']?>
			<? endif ?><br><br><br>
		</td>
	</tr>	

<?php endforeach;?>

</table>
<p>
	<?=$page_nav;?>	
</p>

<p><a href="#top">Наверх</a></p>
            
    </div>
</div>