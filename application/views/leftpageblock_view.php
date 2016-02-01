<div id="left_block">
<div class="news_anonce">
	<table class="mat_block">
		<tr>
			<td><div class="box_header"><h3>Анонс новостей</h3></div></td>		
		</tr>
		<tr>
			<td id="news_anonce_left">
				<table class="mat_block">
				
				<?php foreach ($latest_news as $item):?>
					<tr>
						<td class="mat_block_title" colspan="2">
							<?=$item['date']?>&nbsp;&nbsp;<a href="<?=base_url()."materials/$item[material_id]";?>"><?=$item['title']?></a>
						</td>
					</tr>
					<tr>
						<?php if($item['small_img_url']):?>
							<td class="mat_img">
							<a href="<?=base_url()."materials/$item[material_id]";?>">
								<img class="box_content" src="<?=base_url();?><?=$item['small_img_url'];?>" alt="<?=$item['title'];?>">
							</a>
							</td>
							<td style="vertical-align:top;">
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
							<? if($item['author'] !=""):?>
								<br>Источник:&nbsp;<?=$item['author']?>
							<? endif ?>
						</td>
					</tr>	
				
				<?php endforeach;?>
				
				</table>
			</td>
		</tr>
	</table>
</div>
</div>