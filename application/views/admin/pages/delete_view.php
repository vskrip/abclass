<div id="wrapper">
    <div id="content">

	<h4>Удалить страницу</h4>

	<form action = "<?=base_url();?>pages/delete" method="post">  

	<?php foreach ($pages_list as $item): ?>

		<p><?="<input name='page_id' type='radio' value='$item[page_id]'>$item[title]";?></p>

	<?php endforeach;?>

	<p><br><input type = "submit" name = "delete_button" value = "Удалить страницу"></p>

	</form>
           <br> 
    </div>
</div>
