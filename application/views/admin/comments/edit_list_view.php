<div id="wrapper">
    <div id="content">

<p><h4>Редактировать комментарий</h4></p>
<strong><a href="<?=base_url()."comments/delete";?>"><img src="<?=base_url();?>img/delete.png" alt="Удаление комментариев" />&nbsp;Удаление комментариев</a></strong>
<table>
	<?php foreach ($comments_list as $item):?>
	<tr>
		<td>
			<?="$item[comment_text]";?>
		</td>
		<td>
			<a style="text-decoration: none;" href = "<?=base_url()."comments/edit/$item[comment_id]";?>"><img src="<?=base_url();?>img/edit.png" alt="Редактировать комментарий"></a>
		</td>
	</tr>
	<tr>
		<td>
			<p><a href = "<?=base_url()."materials/$item[material_id]#captcha";?>">Ответить на комментарий</a></p>			
		</td>
	</tr>
	
	<?php endforeach;?>	
	
</table>
<br>
<?=$page_nav;?>

<p><br><a href="#top">Наверх</a></p>
       <br>     
    </div>
</div>