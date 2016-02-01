<div id="main_content">
	<h3><?=$main_info['title'];?></h3>
	<?=$main_info['main_text'];?>
</div>
<div id="news_anonce">
	<table summary="Блок новостей">
	  	<tr>
 	 		<td>
  				<div class="news_block">
					<div class="news_anonce_title"><p>01.12.2001 Ознакомьтесь с новыми предложениями.</p></div>
				   	<div class="news_img"><img src="<?=base_url();?>img/avia3.jpeg" class="box_content" alt="news_img_1"></div>			   	
				   	<p>
						Туристическое агентство Самары "БизнесКласс" помжет оформить визы в любую страну, даже без покупки тура.
						Наше турагентство может предложить Вам лучшие цены на туры!
						ГОРЯЩИЕ ТУРЫ каждый день!!! <a href="#">подробнее...</a>		
			   		</p>   	 			  				
  				</div>
  			</td>
		</tr>
	</table>
</div>
</div>
<?php foreach ($news_materials as $item):?>

<table>
<tr>

<td align = "center">
<p><a href = "<?=base_url()."materials/$item[material_id]";?>"><img class="small_img" src="<?=$item['small_img_url'];?>" width="45" height="45" alt="<?=$item['title'];?>"></a></p>
</td>

<td align = "center">
<p class = "anons_title"><a href = "<?=base_url()."materials/$item[material_id]";?>"><?=$item['title'];?></a></p>
<p class = "anons_text">Добавил: <?=$item['author'];?><br>
<!--Просмотров материала: <?=$item['count_views'];?></p>-->
</td>

</tr>
</table>

<p><?=$item['short_text'];?></p>
<div class="grey_line"></div>

<?php endforeach;?>		
