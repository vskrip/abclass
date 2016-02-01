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
 * Abclass Materials
 *
 * This class controller materials of site
 *
 * @package		ABClass
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Materials extends CI_Controller
{  

public function __construct()
{
   parent::__construct();
   $this->load->model('comments_model');
   $this->load->model('sections_model');
   $this->load->model('helps_model');
}


public function index()
{
    redirect (base_url());
}
   

public function show($material_id)
{
   $this->load->library('table'); 
   $this->load->library('captcha_lib'); 
    
   // Формируем элементы, нужные в любом случае
   $data = array();
   
   //Массив по свежим материалам
   $data['latest_materials'] = $this->materials_model->get_latest();  
   
   //Массив по популярным материалам
   $data['popular_materials'] = $this->materials_model->get_popular();
   
   // Архив
   $data['archive_list'] = $this->administration_model->get_archive();
   
   // Массив по одному материалу 
   $data['main_info'] = $this->materials_model->get($material_id);
 
   $data['links'] = $this->materials_model->get_links($material_id);
   
   $data['main_info']['ban_img_url'] = $this->sections_model->get_ban_url_by($material_id);
   
   // Признак слайдирования баннера
   $data['ban_slide'] = FALSE;
   
   //Если массив пуст
   if (empty($data['main_info']))
   {                            
        $data['info'] = 'Нет такого материала';                              
        $name = 'info';

        $this->display_lib->user_info_page($data,$name);
   }
   else
   {
       //Формируем массив для обновления поля count_views (текущее число показов материала +1)
       $counter_data = array('count_views' => $data['main_info']['count_views'] + 1);

       //Запускаем функцию обновления, меняющую значение счетчика в базе
       $this->materials_model->update_counter($material_id,$counter_data);

       // Создаем простой индексный массив, содержащий все смайлики
       $img_array = get_clickable_smileys(base_url().'img/smileys/','comment_text');// Путь и id поля

       // Создаем многомерный массив из индексного и передаем, сколько столбцов должно быть в таблице
	   $col_array = $this->table->make_columns($img_array,15); 
       
       // Сообщение, если неправильно введена капча
       $data['fail_captcha'] = '';
       
       // Сообщение, если комментарий успешно добавлен
       $data['success_comment'] = '';
       
       //Получаем код капчи
       $data['imgcode'] = $this->captcha_lib->captcha_actions();
       
       // Комментарии к материалу
       $data['comments_list'] = $this->comments_model->get_by($material_id);
       //Таблица смайлов
       $data['smiley_table'] = $this->table->generate($col_array);

       $name = 'materials/content';
       $this->display_lib->user_mat_page($data,$name);
   }
}

//Добавление тура
public function add_tour()
{
    $this->auth_lib->check_admin();
    
    $this->load->helper('tinymce');
    
	// Формируем элементы, нужные в любом случае
   	$data = array();
	
	$data['help_desc'] = $this->helps_model->get_by('materials_add_tour');	
	
	// Формируем массив бестселлеров
	$data['best_list'] = $this->sections_model->get_bests();

	// Получаем массив глав бестселлеров по полю link0
	foreach($data['best_list'] as $key => $val)
	{
		$data['best_list'][$key]['child_sections_list'] = $this->sections_model->get_child_sections($val['section_id']);
	}
	
    //Если нажата кнопка "Добавить тур"
    if (isset($_POST['add_button']))
    {
        $this->form_validation->set_rules($this->materials_model->add_rules);

     	if ($this->form_validation->run() == TRUE)
        {
       	
            //Добавляем новый тур
            $this->materials_model->add();

            $data['info'] = 'Тур добавлен';
            $this->display_lib->admin_info_page($data);
        }
        else
        {

			$name = 'materials/add_tour';

            // Передаем массив data так как того требует функция admin_page
            $this->display_lib->admin_page($data,$name); 			
        }
    }

    //Если не нажата кнопка "Добавить тур", выводим пустую форму
    else
    {
        $name = 'materials/add_tour';
        $this->display_lib->admin_page($data,$name);
    }
}

//Добавление новости
public function add_news()
{
    $this->auth_lib->check_admin();
    
    $this->load->helper('tinymce');
    
	// Формируем элементы, нужные в любом случае
   	$data = array();

	$data['help_desc'] = $this->helps_model->get_by('materials_add_news');
	
    //Если нажата кнопка "Добавить новость"
    if (isset($_POST['add_button']))
    {
        $this->form_validation->set_rules($this->materials_model->add_rules);

     	if ($this->form_validation->run() == TRUE)
        {
			
            //Добавляем новую новость
            $this->materials_model->add();

            $data['info'] = 'Новость добавлена';
            $this->display_lib->admin_info_page($data);
        }
        else
        {

			$name = 'materials/add_news';

            // Передаем массив data так как того требует функция admin_page
            $this->display_lib->admin_page($data,$name); 			
        }
    }

    //Если не нажата кнопка "Добавить новость", выводим пустую форму
    else
    {
        $name = 'materials/add_news';
        $this->display_lib->admin_page($data,$name);
    }
}

//Добавление отзыв
public function add_note()
{
    $this->auth_lib->check_admin();
    
    $this->load->helper('tinymce');
    
	// Формируем элементы, нужные в любом случае
   	$data = array();

	$data['help_desc'] = $this->helps_model->get_by('materials_add_note');

    //Если нажата кнопка "Добавить отзыв"
    if (isset($_POST['add_button']))
    {
        $this->form_validation->set_rules($this->materials_model->add_rules);

     	if ($this->form_validation->run() == TRUE)
        {
       	
            //Добавляем новый отзыв
            $this->materials_model->add();

            $data['info'] = 'Отзыв добавлен';
            $this->display_lib->admin_info_page($data);
        }
        else
        {

			$name = 'materials/add_note';

            // Передаем массив data так как того требует функция admin_page
            $this->display_lib->admin_page($data,$name); 			
        }
    }

    //Если не нажата кнопка "Добавить отзыв", выводим пустую форму
    else
    {
        $name = 'materials/add_note';
        $this->display_lib->admin_page($data,$name);
    }
}

//Добавление акции
public function add_action()
{
    $this->auth_lib->check_admin();
    
    $this->load->helper('tinymce');
    
	// Формируем элементы, нужные в любом случае
   	$data = array();

	$data['help_desc'] = $this->helps_model->get_by('materials_add_action');

    //Если нажата кнопка "Добавить акцию"
    if (isset($_POST['add_button']))
    {
        $this->form_validation->set_rules($this->materials_model->add_rules);

     	if ($this->form_validation->run() == TRUE)
        {
       	
            //Добавляем новую акцию
            $this->materials_model->add();

            $data['info'] = 'Акция добавлена';
            $this->display_lib->admin_info_page($data);
        }
        else
        {

			$name = 'materials/add_action';

            // Передаем массив data так как того требует функция admin_page
            $this->display_lib->admin_page($data,$name); 			
        }
    }

    //Если не нажата кнопка "Добавить акцию", выводим пустую форму
    else
    {
        $name = 'materials/add_action';
        $this->display_lib->admin_page($data,$name);
    }
}


//Добавление отеля
public function add_hotel()
{
	$this->auth_lib->check_admin();

	$this->load->helper('tinymce');

	// Формируем элементы, нужные в любом случае
	$data = array();

	$data['help_desc'] = $this->helps_model->get_by('materials_add_hotel');
	
	$data['type_hotels'] = $this->type_hotel_model->get_all();
	
	$data['continents'] = $this->continent_model->get_all();
	
	// Получаем массив стран по континентам
	foreach($data['continents'] as $key=>$val)
	{
		$data['continents'][$key]['countries'] = $this->country_model->get_by($val['id']);
	}

	//Если нажата кнопка "Добавить отель"
	if (isset($_POST['add_button']))
	{
		$this->form_validation->set_rules($this->materials_model->add_rules);

		if ($this->form_validation->run() == TRUE)
		{

			//Добавляем новый отель
			$this->materials_model->add();

			$data['info'] = 'Отель добавлен';
			$this->display_lib->admin_info_page($data);
		}
		else
		{

			$name = 'materials/add_hotel';

			// Передаем массив data так как того требует функция admin_page
			$this->display_lib->admin_page($data,$name);
		}
	}

	//Если не нажата кнопка "Добавить отель", выводим пустую форму
	else
	{
		$name = 'materials/add_hotel';
		$this->display_lib->admin_page($data,$name);
	}
}


//Добавление ресторана
public function add_rest()
{
	$this->auth_lib->check_admin();

	$this->load->helper('tinymce');

	// Формируем элементы, нужные в любом случае
	$data = array();

	$data['help_desc'] = $this->helps_model->get_by('materials_add_rest');
		
	$data['continents'] = $this->continent_model->get_all();
	
	// Получаем массив стран по континентам
	foreach($data['continents'] as $key=>$val)
	{
		$data['continents'][$key]['countries'] = $this->country_model->get_by($val['id']);
	}

	//Если нажата кнопка "Добавить ресторан"
	if (isset($_POST['add_button']))
	{
		$this->form_validation->set_rules($this->materials_model->add_rules);

		if ($this->form_validation->run() == TRUE)
		{

			//Добавляем новый ресторан
			$this->materials_model->add();

			$data['info'] = 'Ресторан добавлен';
			$this->display_lib->admin_info_page($data);
		}
		else
		{

			$name = 'materials/add_rest';

			// Передаем массив data так как того требует функция admin_page
			$this->display_lib->admin_page($data,$name);
		}
	}

	//Если не нажата кнопка "Добавить ресторан", выводим пустую форму
	else
	{
		$name = 'materials/add_rest';
		$this->display_lib->admin_page($data,$name);
	}
}

//Редактирование материалов (вывод списка материалов для выбора)
public function edit_list($current_mat = '', $start_from = 0)
{
    $this->auth_lib->check_admin();

    $this->load->library('pagination');
    $this->load->library('pagination_lib');

	$data['cur_mat'] = $current_mat;

    //Задаем ограничение числа туров на страницу
    $limit = $this->config->item('admin_per_page');

    //Считаем общее количество туров
    $total = $this->materials_model->count_all($current_mat); 

    //Настройки (для чего навигация, имя для подстановки к base_url, всего,ограничение)
    $settings = $this->pagination_lib->get_settings($current_mat,'edit_list','',$total,$limit);

    //Применяем настройки
    $this->pagination->initialize($settings);      

    // Список туров
    $data['materials_list'] = $this->materials_model->get_materials($current_mat,$limit,$start_from); 
    
    // Ссылки pagination
    $data['page_nav'] = $this->pagination->create_links();
	
	$data['help_desc'] = $this->helps_model->get_by('materials_edit_list_'.$current_mat);
     
    $name = 'materials/edit_list';
    
    $this->display_lib->admin_page($data,$name);
}

//Редактирование материала (форма со значениями, подставившимися из базы) 
public function edit($material_id = '')
{
    $this->auth_lib->check_admin();

    $this->load->helper('checkbox');
    $this->load->helper('tinymce');    

    //Формируем массив одного материала для отображения в форме редактирования
    $data = array();
    $data = $this->materials_model->get($material_id);
	
	
	if($data['section0'] == 'news')
	{
		$data['help_desc'] = $this->helps_model->get_by('materials_edit_news');
	}
	elseif($data['section0'] == 'notes')
	{
		$data['help_desc'] = $this->helps_model->get_by('materials_edit_note');
	}
	elseif($data['section0'] == 'actions')
	{
		$data['help_desc'] = $this->helps_model->get_by('materials_edit_action');
	}
	elseif($data['section0'] == 'hotels')
	{
		$data['help_desc'] = $this->helps_model->get_by('materials_edit_hotel');

		$data['type_hotels'] = $this->type_hotel_model->get_all();

		$data['continents'] = $this->continent_model->get_all();

		// Получаем массив стран по континентам
	   	foreach($data['continents'] as $key=>$val)
	   	{
	   		$data['continents'][$key]['countries'] = $this->country_model->get_by($val['id']);
	   	}
	}
	elseif($data['section0'] == 'rests')
	{
		$data['help_desc'] = $this->helps_model->get_by('materials_edit_rest');

		$data['continents'] = $this->continent_model->get_all();

		// Получаем массив стран по континентам
	   	foreach($data['continents'] as $key=>$val)
	   	{
	   		$data['continents'][$key]['countries'] = $this->country_model->get_by($val['id']);
	   	}
	}
	else
	{
		$data['help_desc'] = $this->helps_model->get_by('materials_edit_tour');

		// Формируем массив бестселлеров
		$data['best_list'] = $this->sections_model->get_bests();

		// Получаем массив глав бестселлеров по полю link0
		foreach($data['best_list'] as $key => $val)
		{
			$data['best_list'][$key]['child_sections_list'] = $this->sections_model->get_child_sections($val['section_id']);
		}
	}

	
	// Получаем список типов туров
	$data['type_tours_list'] = $this->sections_model->get_type_tours();

    //Если массив пуст
    if (empty($data))
    {
        $data = array('info' => 'Такого материала не существует');
        $this->display_lib->admin_info_page($data);                   
    }

    else
    {
        //Получаем дополнительно значения полей section0 - section7
        $data['names'] = $this->materials_model->get_section_values($material_id);
        $name = 'materials/edit';

        $this->display_lib->admin_page($data,$name);
    }
}


//Обновление материала (Обновление материала в базе данных) 
public function update($material_id = '')
{
   $this->auth_lib->check_admin();

   $this->load->helper('checkbox');
   $this->load->helper('tinymce');   

   //Если нажата кнопка "Обновить материал"
   if (isset($_POST['update_button']))
   {
       $this->form_validation->set_rules($this->materials_model->update_rules);

	   if ($this->form_validation->run() == TRUE)
       {
       	
       	//Обновляем материал
           $this->materials_model->update($material_id);

           $data = array('info' => 'Материал обновлен');
		   $data['help_desc'] = $this->helps_model->get_by('materials_update');

           $this->display_lib->admin_info_page($data);
       }
       else
       {
            //формируем массив с данными о материале для подстановки в поля формы (те, что не прошли валидацию,
            //берутся из базы, а те, что прошли - из массива POST)
            $data = array();
            $data = $this->materials_model->get($material_id); 
		    $data['help_desc'] = $this->helps_model->get_by('materials_update_not_valid');
			
			// Формируем массив бестселлеров
			$data['best_list'] = $this->sections_model->get_bests();
		
			// Получаем массив глав бестселлеров по полю link0
			foreach($data['best_list'] as $key => $val)
			{
				$data['best_list'][$key]['child_sections_list'] = $this->sections_model->get_child_sections($val['section_id']);
			}

			// Получаем список типов туров
			$data['type_tours_list'] = $this->sections_model->get_type_tours();
            
            //Получаем дополнительно значения полей section0 - section7
            $data['names'] = $this->materials_model->get_section_values($material_id);
            $name = 'materials/edit';

            $this->display_lib->admin_page($data,$name);
       }
   }
   //Не нажата кнопка "Обновить материал"
   else
   {
       $data = array('info' => 'Материал не был обновлен, так как вы не нажали кнопку "Обновить материал"');
       $this->display_lib->admin_info_page($data);
   }
}


//Удаление материала
public function delete($material_id)
{
    $this->auth_lib->check_admin();

	$this->materials_model->delete($material_id);
	
    $data = array('info' => 'Материал удален.');
	
	$data['help_desc'] = $this->helps_model->get_by('materials_delete');

    $this->display_lib->admin_info_page($data);

}
}
/* End of file materials.php */
/* Location: ./application/controllers/materials.php */