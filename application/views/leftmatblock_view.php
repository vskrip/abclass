<div id="left_block">
	<br>
	<?php foreach($links as $items):?>
		<strong><a href = "<?=base_url()."sections/$items[section_id]";?>"><?=$items['title'];?></a></strong><br>
	<? endforeach;?>
</div>