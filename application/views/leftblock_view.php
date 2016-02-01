<div id="left_block">
	<?php if($links != ''):?>
	<h4 class="contr_title">ссылки</h4>
		<? foreach($links as $items):?>
			<?php if(isset($items['page_id']) && $items['page_id']=='rem_hotel'):?>
				<a href = "<?=base_url()."sections/hotels";?>">Отели</a><br>
			<?php elseif(isset($items['page_id']) && $items['page_id']=='rem_rest'):?>
				<a href = "<?=base_url()."sections/rests";?>">Рестораны</a><br>
			<?php else:?>
				<!--<?php echo print_r($items); ?>-->
				<?php if(isset($items['page_id'])):?>
					<a href = "<?=base_url()."pages/$items[page_id]";?>"><?=$items['title'];?></a><br>
				<?php elseif(isset($items['section_id'])):?>
					<a href = "<?=base_url()."sections/$items[section_id]";?>"><?=$items['title'];?></a><br>					
				<?php endif; ?>
			<?php endif; ?>
		<? endforeach; ?>
	<? endif; ?>
</div>