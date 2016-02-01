<div id="menu" class="nav">
	<ul id="pmenu">
		<li><a href="<?=base_url();?>">главная</a></li>
		<li><a href="<?=base_url();?>sections/news">новости</a></li>
		<li><a href="<?=base_url();?>pages/journey">путешествия&nbsp;&nbsp;&nbsp;&nbsp;</a>
			<ul>
				<li><a href="<?=base_url();?>sections/fire_tours">горящие туры</a></li>
				<li><a href="<?=base_url();?>sections/hotel_actions">акции отелей</a></li>
				<li><a href="<?=base_url();?>sections/events_tours">туры события</a></li>
				<li><a href="<?=base_url();?>sections/exposes">выставки</a></li>
				<li><a href="<?=base_url();?>pages/jorn_order">заказать</a></li>
			</ul>
		</li>
		<li><a href="<?=base_url();?>pages/tickets">авиабилеты</a>
			<ul>
				<li><a href="<?=base_url();?>sections/actions">акции</a></li>				
				<li><a href="<?=base_url();?>pages/tic_faq">вопросы</a></li>				
				<li><a href="<?=base_url();?>pages/tic_ports">аэропорты</a></li>				
				<li><a href="<?=base_url();?>pages/tic_bonus">бонусы</a></li>				
				<li><a href="<?=base_url();?>pages/tic_order">заказать</a></li>				
			</ul>
		</li>
		<li><a href="<?=base_url();?>pages/reminders">по странам</a>
			<ul>
				<li><a href="<?=base_url();?>sections/hotels">отели</a></li>				
				<li><a href="<?=base_url();?>sections/rests">рестораны</a></li>				
			</ul>			
		</li>
		<li><a href="<?=base_url();?>pages/service">сервис</a>
			<ul>
				<li><a href="<?=base_url();?>pages/serv_visa">визы</a></li>
				<li><a href="<?=base_url();?>pages/serv_ozp">паспорта</a></li>
				<li><a href="<?=base_url();?>pages/serv_drift">сертификаты</a></li>
				<li><a href="<?=base_url();?>pages/serv_agent">агентствам</a></li>
				<li><a href="<?=base_url();?>pages/serv_client">корпоративным&nbsp;клиентам</a></li>
			</ul>				
		</li>
		<li><a href="<?=base_url();?>sections/notes">путевые заметки</a></li>
		<li><a href="<?=base_url();?>pages/about_us">о компании</a>
			<ul>
				<li><a href="<?=base_url();?>pages/about_empl">сотрудники</a></li>
				<li><a href="<?=base_url();?>pages/about_rew">награды</a></li>
				<li><a href="<?=base_url();?>pages/about_cont">контакты</a></li>
				<!-- <li><a href="<?=base_url();?>pages/about_agent">агентствам</a></li> -->
			</ul>
		</li>
	</ul>
</div>
<?php if(isset($main_info['ban_img_url'])):?>
	<?php if($ban_slide == TRUE):?>
	<div id="baner_slide">
		<img src="<?=base_url();?>img/ban_main.jpg" alt="Основной баннер">
		<img src="<?=base_url();?>img/ban_journey.jpg" alt="Баннер для путешествий">
		<img src="<?=base_url();?>img/ban_jungle.jpg" alt="Баннер бестселлера про джунгли">
		<img src="<?=base_url();?>img/ban_love.jpg" alt="Баннер бестселлера для влюбленных">
		<img src="<?=base_url();?>img/ban_on_guest.jpg" alt="Баннер бестселлера сказки">
		<img class="show" src="<?=base_url();?>img/ban_reminders.jpg" alt="Баннер бестселлера памятка">
	</div>
	<? else: ?>
	<div id="baner">
		<img src="<?=base_url();?><?=$main_info['ban_img_url'];?>" alt="Баннер основной">
	</div>
	<? endif; ?>
<? else: ?>
<div id="baner">
	<img src="<?=base_url();?>img/ban_admin.jpg" alt="Баннер административной части">
</div>
<? endif; ?>
<div id="banner_right">
		<div id="banner_right_text">
			ТУРИСТИЧЕСКОЕ<br>АГЕНТСТВО<br>БРОНИРОВАНИЕ<br>АВИАБИЛЕТОВ<br><br><br>
			<a href="http://hotel.abclass.ru">ОНЛАЙН<br>БРОНИРОВАНИЕ<br>ОТЕЛЕЙ</a>
		</div>
</div>