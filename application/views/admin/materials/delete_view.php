<div id="wrapper">
    <div id="content">

<p><h4>Удалить материал</h4></p>

<form action = "<?=base_url();?>materials/delete" method="post">  

<?php foreach ($materials_list as $item): ?>

<p><?="<input name='material_id' type='radio' value='$item[material_id]'>$item[title]";?></p>

<?php endforeach;?>

<p><br><input type = "submit" name = "delete_button" value = "Удалить материал"></p>

</form>

<?=$page_nav;?>

<p><br><a href="#top">Наверх</a></p>
       <br>     
    </div>
</div>