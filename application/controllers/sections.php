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
 * Abclass Sections
 *
 * This class controller sections of site
 *
 * @package		ABClass
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Sections extends CI_Controller
{           

public function __construct()
{
   parent::__construct();    
   $this->load->model('sections_model');
   $this->load->model('helps_model');
}


public function index()
{
    redirect (base_url());
}


//start_from - с какого материала начинать вывод для каждой страницы, разбитой с помощью pagination
public function show($section_id, $start_from = 0)
{
   $this->load->library('pagination');
   $this->load->library('pagination_lib');
    
   $data = array();
   
   //Массив по свежим материалам
   $data['latest_materials'] = $this->materials_model->get_latest();
   
   //Массив по популярным материалам   
   $data['popular_materials'] = $this->materials_model->get_popular();
   
   // Архив
   $data['archive_list'] = $this->administration_model->get_archive();
   
   // Массив ссылок на подразделы
   $data['links'] = $this->sections_model->get_links($section_id);

   if($section_id == 'hotels' || $section_id == 'rests')
   {
	   	// Массив континентов
	   	$data['continents'] = $this->continent_model->get_all();
	   	
	   	// Получаем массив стран по континентам
	   	foreach($data['continents'] as $key=>$val)
	   	{
	   		$data['continents'][$key]['countries'] = $this->country_model->get_by($val['id']);
	   	}
		if($section_id == 'hotels')
   		{
   			// Массив типов отелей
   			$data['type_hotels'] = $this->type_hotel_model->get_all();
   		}	   	 
   }
   //Массив по одной категории
   $data['main_info'] = $this->sections_model->get($section_id);  

	// Части заголовков для отелей и ресторанов
	$data['cur_sec'] = '';
	$data['main_info']['current_type_hotel_title'] = '';
	$data['main_info']['cur_type_hotel_desc'] = '';
	$data['main_info']['current_country_title'] = '';
   
	if($section_id == 'hotels')
	{
		$data['cur_sec'] = 'hotels';
	}
	elseif($section_id == 'rests')
	{
		$data['cur_sec'] = 'rests';
	}
	
   // Признак слайдирования баннера
   $data['ban_slide'] = FALSE;
      
   //Если массив пуст
   if (empty($data['main_info']))
   {                       
        $data['info'] = 'Такой категории не существует';                      
        $name = 'info'; 
        
        $this->display_lib->user_info_page($data,$name);             
   }      
   else
   {
        //Задаем ограничение числа материалов на страницу
        $limit = $this->config->item('user_per_page');

        //Считаем общее количество материалов в конкретной категории
        $total = $this->materials_model->count_by($section_id,'',0);
        
        //Настройки (для чего навигация, имя для подстановки к base_url, всего, ограничение)
        $settings = $this->pagination_lib->get_settings('','section',$section_id,$total,$limit);

        //Применяем настройки
        $this->pagination->initialize($settings);        
        
        // Получаем список материалов, разбитый в соответствии с настройками
        $data['materials_list'] = $this->materials_model->get_by($section_id,$limit,$start_from);
        
        // Получаем код ссылок постраничной навигации
        $data['page_nav'] = $this->pagination->create_links();
        
        // Если раздел "Отели" тозагружаем вид отображения таблицу иллюстрированных блоков отелей
        if ($section_id == 'hotels')
        {
        	$name = 'sections/hotels';
        }
        else
        {
        	$name = 'sections/content';
        }
        $this->display_lib->user_sect_page($data,$name);
   }
}

// show_adv 	- функция отображени дополнительных разделов: отели и рестораны
// $secadv 		- отображение какого дополнительного раздела осуществляем
//					- hotels - отели
//					- rests - рестораны
// $typesel 	- фильтр для группировки списка элементов раздела:
//					- hotel_type_id - тип отеля;
//					- country - страна;
// $item_id		- числовой идентификатор выбранного элемента
// start_from 	- с какого материала начинать вывод для каждой страницы, разбитой с помощью pagination

public function show_adv($secadv = '', $typesel = '', $item_id = 0,  $start_from = 0)
{
	$this->load->library('pagination');
	$this->load->library('pagination_lib');

	$data = array();
	
	// Массив ссылок на подразделы
	$data['links'] = $this->sections_model->get_links($secadv);

	// Массив типов отелей
	if($secadv == 'hotels')
	{
		$data['type_hotels'] = $this->type_hotel_model->get_all();
	}

	// Массив континентов
	$data['continents'] = $this->continent_model->get_all();
	 
	// Получаем массив стран по континентам
	foreach($data['continents'] as $key => $val)
	{
		$data['continents'][$key]['countries'] = $this->country_model->get_by($val['id']);
	}

	// Массив по одной категории
	$data['main_info'] = $this->sections_model->get($secadv);
	
	// Для подмены параметра в ссылках стран
	
	$data['cur_sec'] = $secadv;

	// Формируем дополнительные части заголовока для раздела (например, "Австрия. Отели на море"... и т.п.) 	
	$data['main_info']['current_type_hotel_title'] = '';
	$data['main_info']['cur_type_hotel_desc'] = '';
	$data['main_info']['current_country_title'] = '';
	
	if($typesel=='hotel_type_id')
	{
		$data['main_info']['current_type_hotel_title'] = $this->type_hotel_model->get_type_hotel_title($item_id);
		$data['main_info']['cur_type_hotel_desc'] = $this->type_hotel_model->get_type_hotel_desc($item_id);
	}
	elseif ($typesel=='country')
	{
		$data['main_info']['current_country_title'] = $this->country_model->get_country_title($item_id);
	}
	
	// Признак слайдирования баннера
	$data['ban_slide'] = FALSE;

	//Если массив пуст
	if (empty($data['main_info']))
	{
		$data['info'] = 'Такой категории не существует';
		$name = 'info';

		$this->display_lib->user_info_page($data,$name);
	}
	else
	{
		//Задаем ограничение числа материалов на страницу
		$limit = $this->config->item('user_per_page');

		//Считаем общее количество материалов в конкретной категории с учетом параметров на выборку		
		$total = $this->materials_model->count_by($secadv,$typesel,$item_id);
		
		//Настройки (для чего навигация, имя для подстановки к base_url, всего, ограничение)
		if($secadv == 'hotels') {

			if ($typesel == 'hotel_type_id') {
				$settings = $this->pagination_lib->get_settings('','hotel_types',$item_id,$total,$limit);
			}
			elseif ($typesel == 'country') {
				$settings = $this->pagination_lib->get_settings('','hotel_country',$item_id,$total,$limit);
			}
			
		}
		elseif ($secadv == 'rests') {
			if ($typesel == 'country') {
				$settings = $this->pagination_lib->get_settings('','rests_country',$item_id,$total,$limit);
			}
		}
		
		//Применяем настройки
		$this->pagination->initialize($settings);
		
		// Получаем список материалов, разбитый в соответствии с настройками
		$data['materials_list'] = $this->materials_model->get_adv_by($secadv,$typesel,$item_id,$limit,$start_from);

		// Получаем код ссылок постраничной навигации
		$data['page_nav'] = $this->pagination->create_links();
		$name = 'sections/content';
		
		$this->display_lib->user_sect_page($data,$name);
	}
}

//Добавление категории
public function add()
{ 
    $this->auth_lib->check_admin();
    
    $this->load->helper('tinymce');
    
    //Если нажата кнопка "Добавить категорию"  
    if (isset($_POST['add_button']))
    {    
        $this->form_validation->set_rules($this->sections_model->add_rules);

     	if ($this->form_validation->run() == TRUE)
        {        
            //Добавляем новую категорию
            $this->sections_model->add();
            
            $data = array('info' => 'Категория добавлена');
            $this->display_lib->admin_info_page($data);
        }

        else
        {            
            $name = 'sections/add';
            
            // Передаем пустой массив data так как того требует функция admin_page
            $this->display_lib->admin_page($data = array(),$name); 			
        }        
    }
      
    //Если не нажата кнопка "Добавить категорию", выводим пустую форму
    else
    {
        $name = 'sections/add';
        $this->display_lib->admin_page($data = array(),$name);
    }
}



//Редактирование (вывод списка категорий для выбора)  
public function edit_list()
{
    $this->auth_lib->check_admin();
    
	// Формируем элементы, нужные в любом случае
   	$data = array();
	
	$data['help_desc'] = $this->helps_model->get_by('sections_edit_list');	
	
	// Формируем массив бестселлеров
	$data['best_list'] = $this->sections_model->get_bests();

	// Получаем массив глав бестселлеров по полю link0
	foreach($data['best_list'] as $key => $val)
	{
		$data['best_list'][$key]['child_sections_list'] = $this->sections_model->get_child_sections($val['section_id']);
	}
	// Массив типов туров
	$data['type_tours'] = $this->sections_model->get_type_tours();

    $name = 'sections/edit_list';
    
    $this->display_lib->admin_page($data,$name);
}



//Редактирование (форма со значениями, подставившимися из базы) 
public function edit($section_id = '')
{
    $this->auth_lib->check_admin();
    
    $this->load->helper('tinymce');
    
    //Массив одной категории для отображения в форме редактирования
    $data = array();

	$data = $this->sections_model->get($section_id);
	$data['help_desc'] = $this->helps_model->get_by('sections_edit');

    //Если массив пуст
    if (empty($data))
    {
        $data = array('info' => 'Такого бестселлера или главы не существует');
        $this->display_lib->admin_info_page($data);                  
    }
        
    else
    {
        $name = 'sections/edit';
        $this->display_lib->admin_page($data,$name);            
    }
}


//Обновление (Обновление бестселлера или главы в базе данных)
public function update($section_id = '')
{
   $this->auth_lib->check_admin(); 
   
   $this->load->helper('tinymce');
    
   //Если нажата кнопка "Обновить бестселлер или главу"
   if (isset($_POST['update_button']))
   {
       $this->form_validation->set_rules($this->sections_model->update_rules);
		
	   if ($this->form_validation->run() == TRUE)
       {        
           //Обновляем бестселлер или главу
           $this->sections_model->update($section_id);
           $data = array('info' => 'Раздел обновлен');
   		   $data['help_desc'] = $this->helps_model->get_by('materials_update');
                  
           $this->display_lib->admin_info_page($data);
       } 
       
       else
       {    
            //Формируем массив с данными о категории для подстановки в поля формы (те, что не прошли
            //валидацию, берутся из базы, а те, что прошли - из массива POST)
            $data = array();	             
            $data = $this->sections_model->get($section_id);
		    $data['help_desc'] = $this->helps_model->get_by('materials_update_not_valid');
            $name = 'sections/edit';
            
            $this->display_lib->admin_page($data,$name);			
       }
   }
       
   //Не нажата кнопка "Обновить бестселлер или главу"
   else
   {
       $data = array('info' => 'Бестселлер или глава не были обновлены, так как вы не нажали кнопку "Обновить бестселлер или главу"');
       $this->display_lib->admin_info_page($data);
   }
}



//Удаление категории
public function delete()
{
    $this->auth_lib->check_admin();
    
    //Если не нажата кнопка "Удалить категорию", выводим список категорий
    if ( ! isset($_POST['delete_button']))
    {         
        //Массив по всем категориям для вывода списка
        $data = array('sections_list' => $this->sections_model->get_all());       
        $name = 'sections/delete';
        $this->display_lib->admin_page($data,$name);             
    }
    
    //Если кнопка "Удалить категорию" нажата
    else
    {
        //но не выбрана категория
        if ( ! isset($_POST['section_id']))
        {
            $data = array('info' => 'Не выбрана категория для удаления');       
            $this->display_lib->admin_info_page($data);              
        }
        
        //и выбрана категория
        else 
        {  
            //Получаем идентификатор категории из массива POST
            $section_id = $this->input->post('section_id');
            
            //Удаляем категорию с выбранным идентификатором
            $this->sections_model->delete($section_id);
            
            $data = array('info' => 'Категория удалена');
            $this->display_lib->admin_info_page($data);
        }
    }
}
}
/* End of file sections.php */
/* Location: ./application/controllers/sections.php */