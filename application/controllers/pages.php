<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ABClass
 *
 * The tourist agency web site
 *
 * @package		ABClass
 * @author		Vladimir Skripachev
 * @copyright	Copyright (c) 2012.
 * @license		http://abclass.ru
 * @link		http://abclass.ru
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Abclass Pages
 *
 * This class controller pages of site
 *
 * @package		ABClass
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Pages extends CI_Controller
{
    
public function __construct()
{
    parent::__construct();
    $this->load->model('pages_model');
	$this->load->model('helps_model');
}

public function index()
{
    redirect (base_url());
}


public function show ($page_id)
{
  // Формируем массив для передачи в вид
  $data = array(); 
  
  // Массив по последним новостям
  $data['latest_news'] = $this->materials_model->get_latest_news();

  // Массив по популярным материалам
  $data['popular_materials'] = $this->materials_model->get_popular();
  
  // Массив ссылок на подчиненные страницы
  if($page_id != 'search_hotel')
  	$data['links'] = $this->pages_model->get_links($page_id);
  
  // Массив по одной странице  
  $data['main_info'] = $this->pages_model->get($page_id);
  
  // Признак отображения баннера с использованием слайд-шоу
  $data['ban_slide'] = FALSE;

  switch($page_id)
  {
    // Если страница "Главная"
    case 'index':         
        
		$data['ban_slide'] = TRUE;
        $name = 'pages/mainpage';
         
        $this->display_lib->user_main_page($data,$name);
                   
        break;

	// Если страница "Акции", тогда это не страница, а раздел
	case 'tic_action':
		
		redirect(base_url().'sections/actions');
		
		break;
		
	// Если страница "Заказ билетов"
    case 'tic_order':
		
		$this->orderFormHandler($data, 'tic');    	
		
	    break;
		
	// Если страница "Заказ путешествия"
    case 'jorn_order':
		
		$this->orderFormHandler($data, 'jorn');
		
	    break;

    // Любая другая страница
    default:

        //Если массив пуст
        if (empty($data['main_info']))
        {
           $data['info'] = 'Нет такой страницы';
           $name = 'info'; 

           $this->display_lib->user_info_page($data,$name);
        }
           
        else
        {
           $name = 'pages/page';
           $this->display_lib->user_page($data,$name);           
    	}
        break;    
  }
}


//Добавление страницы
public function add()
{
    $this->auth_lib->check_admin();
    
    $this->load->helper('tinymce');
    
    //Если нажата кнопка "Добавить страницу"  
    if (isset($_POST['add_button']))      
    {
        $this->form_validation->set_rules($this->pages_model->add_rules);
		
     	if ($this->form_validation->run() == TRUE)
        {
            //Добавляем новую страницу
            $this->pages_model->add();
                        
            $data = array('info' => 'Страница добавлена');       
            $this->display_lib->admin_info_page($data); 
        }
        
        else
        {
            $name = 'pages/add';
            
            // Передаем пустой массив data так как того требует функция admin_page 
            $this->display_lib->admin_page($data = array(),$name);           
        }
    }
          
    //Если не нажата кнопка "Добавить страницу", выводим пустую форму
    else
    {                      
        $name = 'pages/add';
        $this->display_lib->admin_page($data = array(),$name);
    }
}


//Редактирование (вывод списка страниц для выбора)  
public function edit_list()
{
    $this->auth_lib->check_admin();
    
    //Массив по всем страницам для вывода списка
    $data = array('pages_list' => $this->pages_model->get_all());
	$data['help_desc'] = $this->helps_model->get_by('pages_edit_list');
    $name = 'pages/edit_list';

    $this->display_lib->admin_page($data,$name);
} 


//Редактирование (форма со значениями, подставившимися из базы)
public function edit($page_id = '')
{
    $this->auth_lib->check_admin();
    
    $this->load->helper('tinymce');
    
    //Формируем массив одной страницы (row_array) для отображения в форме редактирования 
    $data = array();
    $data = $this->pages_model->get($page_id);        

    //Если массив пуст
    if (empty($data))
    {
        $data = array('info' => 'Такой страницы не существует');
		$data['help_desc'] = $this->helps_model->get_by('pages_edit_empty');
        $this->display_lib->admin_info_page($data);               
    }

    else
    {
		$data['help_desc'] = $this->helps_model->get_by('pages_edit');
        $name = 'pages/edit';
        $this->display_lib->admin_page($data,$name);
    }
}



//Обновление (Обновление страницы в базе данных) 
public function update($page_id = '')
{
   $this->auth_lib->check_admin();
   
   $this->load->helper('tinymce'); 
    
   //Если нажата кнопка "Обновить страницу"
   if (isset($_POST['update_button']))
   {
       $this->form_validation->set_rules($this->pages_model->update_rules);

	   if ($this->form_validation->run() == TRUE)
       {        
           //Обновляем страницу
           $this->pages_model->update($page_id);
          
           $data = array('info' => 'Страница обновлена');
		   $data['help_desc'] = $this->helps_model->get_by('pages_update');
           $this->display_lib->admin_info_page($data);
       }

       else
       {
           //Формируем массив с данными о странице для подстановки в поля формы (те, что не прошли валидацию,
           //берутся из базы, а те, что прошли - из массива POST)
           $data = array ();
           $data = $this->pages_model->get($page_id);
           $data['help_desc'] = $this->helps_model->get_by('pages_update_not_valid');
           $name = 'pages/edit';
           
           $this->display_lib->admin_page($data,$name);
       }               
   }

   //Не нажата кнопка "Обновить страницу"
   else
   { 
       $data = array('info' => 'Страница не была обновлена, так как вы не нажали кнопку "Обновить страницу"');
       $data['help_desc'] = $this->helps_model->get_by('pages_update_not_push_button');
       $this->display_lib->admin_info_page($data);             
   }      
}



//Удаление страницы 
public function delete()
{
    $this->auth_lib->check_admin();
    
    //Если не нажата кнопка "Удалить страницу"
    if ( ! isset($_POST['delete_button']))
    {
        //Массив по всем страницам
        $data = array('pages_list' => $this->pages_model->get_all());
        $name = 'pages/delete';

        $this->display_lib->admin_page($data,$name);
    }

    //Если кнопка "Удалить странцу" нажата
    else
    {
        //но не выбрана страница
        if ( ! isset($_POST['page_id']))
        {
            $data = array('info' => 'Не выбрана страница для удаления');
            $this->display_lib->admin_info_page($data);                      
        }

        //и выбрана страница
        else 
        {
            //Получаем идентификатор страницы из массива POST
            $page_id = $this->input->post('page_id');
            
            //Удаляем страницу с выбранным идентификатором
            $this->pages_model->delete($page_id);                         
            
            $data = array('info' => 'Страница удалена');                  
            $this->display_lib->admin_info_page($data);            
        }
    }
}

//Обработчик формы заказа

private function orderFormHandler($data, $torder)
{
	$this->load->library('captcha_lib');

    // Не нажата кнопка "Отправить"    
    if ( ! isset($_POST['send_message']))
    {    
        //Получаем код картинки
        $data['imgcode'] = $this->captcha_lib->captcha_actions(); 
        $data['info'] = ''; //Информационное сообщение
        
		$name = 'pages/'.$torder.'_order';
        
        $this->display_lib->user_page($data,$name);
    }
      
    // Нажата кнопка "Отправить"
    else
    {  
        //Установка правил валидации
        $this->form_validation->set_rules($this->pages_model->form_order_rules);		
    	  
    	$val_res = $this->form_validation->run();
          
        //Если валидация пройдена
        if ($val_res == TRUE)
        {
             //Получаем значение поля капча
    	     $entered_captcha = $this->input->post('captcha');
    		   
             //Если капча совпадает, отправляем письмо
    	     if ($entered_captcha == $this->session->userdata('rnd_captcha'))
             {
                 $this->load->library('typography');
                 
                 //Имя отправителя
                 $name = $this->input->post('name');
                 
                 //Указанный отправителем email 
                 $email = $this->input->post('email'); 
                 
                 //Тема сообщения, указанная отправителем
                 $topic = $this->input->post('topic'); 
                 
                 //Текст сообщения
                 $text = $this->input->post('message');
                 
                 //Переносы после 70 знаков (ограничение mail в PHP)  
                 $text = wordwrap($text,70); 
                 
                 // TRUE - более двух переводов строк все равно считаются за два перевода строки
                 $text = $this->typography->auto_typography($text,TRUE);
                 // Удаляем html-тэги для удобства чтения
                 $text = strip_tags($text);

                 //Куда отправляется письмо
                 $address = "bilet@abclass.ru"; 
                 
                 //Тема письма как ее видит получатель
                 if($torder == 'tic'){
                 	$subject = "Заказ авиабилетов с сайта abclass.ru";
                 }
		 elseif($torder == 'jorn'){
                 	$subject = "Заказ путешествия с сайта abclass.ru";
		 }
                 $message = "Написал(а):$name\nТема: $topic\nСообщение:\n$text\nE-mail отправителя: $email"; 
                                      
                 //Отправляем письмо
    	         mail ($address,$subject,$message,"Content-type:text/plain;charset = utf-8\r\n");
                              
                 $data['info'] = 'Ваш заказ отправлен. Специалист свяжется с вами в кратчайшие сроки.';
                 $name = 'info'; 

                 $this->display_lib->user_info_page($data,$name);
    	     }   
               
             // Если капча не совпадает
             else 
             {
                 //Получаем код картинки;
                 $data['imgcode'] = $this->captcha_lib->captcha_actions();
                 
                 $data['info'] = 'Неверно введены цифры с картинки';                                   
                 $name = 'pages/'.$torder.'_order';

                 $this->display_lib->user_page($data,$name);
             }            						
        }
          
        //Если валидация не пройдена
        else
        {   
            //Получаем код картинки;
            $data['imgcode'] = $this->captcha_lib->captcha_actions(); 
            $data['info'] = ''; //Информационное сообщение                               
            $name = 'pages/'.$torder.'_order'; 

            $this->display_lib->user_page($data,$name);
        }
    }
}
}
/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
