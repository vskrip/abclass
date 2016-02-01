<div id="wrapper">
    <div id="content">
        <div class="center">
<h4>Вход в панель администратора</h4>

<form action = "<?=base_url();?>administration/login" method="post">
<p><h4><?=$info;?></h4></p>
<p>Логин<br>
<input type="text" name="login" value="<?=set_value('login');?>"><br>
<strong><?=form_error('login');?></strong>
</p>

<p>Пароль<br>
<input type="password" name="pass"><br>
<strong><?=form_error('pass');?></strong>
</p>

<p><br><input type = "submit" name = "enter_button" value = "Войти"></p>

</form>
    <br>
        </div>           
    </div>
</div>