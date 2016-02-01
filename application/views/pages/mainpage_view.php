<div id="wrapper">
<div id="content_main">
<div class="news_anonce">
	<table class="mat_block">
		<tr>
			<td><div class="box_header"><h3>Анонс новостей</h3></div></td>		
		</tr>
		<tr>
			<td id="news_anonce_left">
				<table>
					<tr>
						<?php foreach ($latest_news as $item):?>
							<td class="news_col">
								<table class="mat_block">
					<tr>
						<td class="mat_block_title" colspan="2">
							<span class="contr_title"><?=mdate("%d.%m.%Y",mysql_to_unix($item['date']));?></span>&nbsp;&nbsp;<a href="<?=base_url()."materials/$item[material_id]";?>"><?=$item['title']?></a>
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
								</table>
							</td>
						<?php endforeach;?>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<div id="bestsellers">
 	<div id="best_title"><h1>БЕСТSЕЛЛЕРЫ</h1></div>
	<div id="decor"><img src="<?=base_url();?>img/ornament.png" alt="Орнамент"></div>
	<div id="best_ico">
  		<div id="best_ico_left"><img src="<?=base_url();?>img/best2_lft.png" alt="Изображение края полки"></div>
  			<table id="tbl_best" summary="Блок бестселлеров">
  				<tr>
					<td><a href="<?=base_url();?>sections/on_guest"><img src="<?=base_url();?>img/best2_1.png" alt="В гостях у сказки"></a></td>
	  				<td><a href="<?=base_url();?>sections/love"><img src="<?=base_url();?>img/best2_2.png" alt="История любви"></a></td>
	  				<td><a href="<?=base_url();?>sections/asia"><img src="<?=base_url();?>img/best2_3.png" alt="Волшебая лампа Алладина"></a></td>
	  				<td><a href="<?=base_url();?>sections/sport"><img src="<?=base_url();?>img/best2_4.png" alt="Сп0ртак"></a></td>
	  				<td><a href="<?=base_url();?>sections/jungle"><img src="<?=base_url();?>img/best2_5.png" alt="Джунгли зовут"></a></td>
	  				<td><a href="<?=base_url();?>sections/epicure"><img src="<?=base_url();?>img/best2_6.png" alt="Роман Гурман"></a></td>
	  			</tr>
	  		</table>
  	</div>
</div>
<div id="main_content">
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
	<h3>О компании</h3>
	<?=$main_info['main_text'];?>
</div>
</div>
</div>
