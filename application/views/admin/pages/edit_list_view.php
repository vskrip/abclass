<div id="wrapper">
    <div id="content">

<h4>Редактировать страницу</h4>

<?php foreach ($pages_list as $item):?>

<p><a href = "<?=base_url()."pages/edit/$item[page_id]";?>"><?="$item[title]";?></a></p>

<?php endforeach;?>
      <br>      
    </div>
</div>