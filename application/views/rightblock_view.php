<div id="right_block">
	<div id="best_block_v">
			<h4>Поиск по сайту</h4>
			<form action = "<?=base_url();?>search" method="post">
			<input type="text" name="search" id ="search" class="bordo_frame" maxlength="50" value="<?=set_value('search');?>">
			<?=form_error('search');?>
			<input type = "submit" name = "search_button" id="search_button" value = " ">
			</form>
		<ul>
			<li><h3>Бестселлеры</h3></li>
			<li><a href="<?=base_url();?>sections/on_guest"><img class="box_content" src="<?=base_url();?>img/best1_1.png"><br>
				<p>В гостях у сказки</p></a>
			</li>
			<li><a href="<?=base_url();?>sections/love"><img class="box_content" src="<?=base_url();?>img/best1_2.png"><br>
				<p>Истории любви</p></a>
			</li>
			<li><a href="<?=base_url();?>sections/asia"><img class="box_content" src="<?=base_url();?>img/best1_3.png"><br>
				<p>Волшебная лампа<br>Алладина</p></a>
			</li>
			<li><a href="<?=base_url();?>sections/sport"><img class="box_content" src="<?=base_url();?>img/best1_4.png"><br>
				<p>Сп@ртак</p></a>
			</li>
			<li><a href="<?=base_url();?>sections/jungle"><img class="box_content" src="<?=base_url();?>img/best1_5.png"><br>
				<p>Джунгли зовут</p></a>
			</li>
			<li><a href="<?=base_url();?>sections/epicure"><img class="box_content" src="<?=base_url();?>img/best1_6.png"><br>
				<p>Роман "Гурман"</p></a>
			</li>
		</ul>
	</div>
</div>
