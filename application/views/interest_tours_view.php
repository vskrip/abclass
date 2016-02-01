<div class="news_anonce">
	<div class="mat_block">
		<h3>Самое интересное</h3>
		<div>
			<table class="mat_block">
			
			<?php foreach ($popular_materials as $item):?>
				<tr>
					<td class="mat_block_title" colspan="2">
						<a href="<?=base_url()."materials/$item[material_id]";?>"><?=$item['title']?></a>
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
							<?=$item['short_text'];?>&nbsp;<a href="<?=base_url()."materials/$item[material_id]";?>">подробнее...</a>
						</td>
					<? else: ?>
					<td colspan = "2">
						<?=$item['short_text'];?>&nbsp;<a href="<?=base_url()."materials/$item[material_id]";?>">подробнее...</a>
					</td>
					<? endif ?>
				</tr>
			<?php endforeach;?>
			
			</table>
		</div>
	</div>
</div>