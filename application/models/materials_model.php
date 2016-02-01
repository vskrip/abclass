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
 * Abclass Materials Model
 *
 * This class model materials of site
 *
 * @package		ABClass
 * @subpackage	Models
 * @category	Models
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Materials_model extends Crud
{
	
public $table = 'materials'; //Имя таблицы	
public $idkey = 'material_id'; //Имя ID


// правила для добавления нового материала
public $add_rules = array
(
    array
    (
      'field' => 'title',
      'label' => 'Название материала',
      'rules' => 'required|max_length[250]'
    ),
    array
    (
      'field' => 'description',
      'label' => 'Мета-описание материала',
      'rules' => 'required|max_length[250]'
    ),        
    array
    (
      'field' => 'keywords',
      'label' => 'Ключевые слова',
      'rules' => 'required|max_length[250]'
    ),
    array
    (
      'field' => 'small_img_url',
      'label' => 'Путь к мини-иконке для анонса',
      'rules' => ''
    ),
    array
    (
      'field' => 'short_text',
      'label' => 'Краткое описание',
      'rules' => 'required'
    ),
    array
    (
      'field' => 'main_text',
      'label' => 'Полный текст',
      'rules' => 'required'
    ),
	array
	(
		'field' => 'hotel_type_id',
		'label' => 'Тип отеля',
		'rules' => ''
	),
	array
	(
		'field' => 'country',
		'label' => 'Страна',
		'rules' => ''
	),
	array
    (
      'field' => 'date',
      'label' => 'Дата добавления',
      'rules' => ''
    ),
    array
    (
      'field' => 'author',
      'label' => 'Автор материала',
      'rules' => 'max_length[250]'
    ),
    array
    (
      'field' => 'section[]',
      'label' => 'Категория',
      'rules' => 'required'
    )
);


// правила для обновления нового материала
public $update_rules = array
(                   
    array
    (
      'field' => 'title',
      'label' => 'Название материала',
      'rules' => 'required|max_length[250]'
    ),        
    array
    (
      'field' => 'description',
      'label' => 'Мета-описание материала',
      'rules' => 'required|max_length[250]'
    ),        
    array
    (
      'field' => 'keywords',
      'label' => 'Ключевые слова',
      'rules' => 'required|max_length[250]'
    ),
    array
    (
      'field' => 'small_img_url',
      'label' => 'Путь к мини-иконке для анонса',
      'rules' => ''
    ),
    array
    (
      'field' => 'short_text',
      'label' => 'Краткое описание',
      'rules' => 'required'
    ),
    array
    (
      'field' => 'main_text',
      'label' => 'Полный текст',
      'rules' => 'required'
    ),
	array
	(
		'field' => 'hotel_type_id',
		'label' => 'Тип отеля',
		'rules' => ''
	),
	array
	(
		'field' => 'country',
		'label' => 'Страна',
		'rules' => ''
	),
    array
    (
      'field' => 'date',
      'label' => 'Дата добавления',
      'rules' => ''
    ),
    array
    (
      'field' => 'author',
      'label' => 'Автор материала',
      'rules' => 'max_length[250]'
    ),
    array
    (
      'field' => 'section[]',
      'label' => 'Категория',
      'rules' => 'required'
    )
);    
    

public function get_latest()
{
    $this->db->order_by ('material_id','desc');
    $this->db->limit (6);
    $query = $this->db->get('materials');
    return $query->result_array();//Возвращаем массив с последними материалами
}


public function get_latest_news()
{
    $this->db->order_by ('material_id','desc');
    $this->db->limit (4);
	$this->db->where ('section0','news');
    $query = $this->db->get('materials');
    return $query->result_array();//Возвращаем массив с последними 4-мя новостями
}

public function get_popular()
{
    $this->db->order_by('count_views','desc');
    $this->db->limit (4);
	$this->db->where ('section0 !=','news');	// Не новость
	$this->db->where ('section0 !=','notes');	// Не заметка
	$this->db->where ('section0 !=','actions');	// Не акция
	
	$query = $this->db->get('materials');
    return $query->result_array();		//Возвращаем массив с наиболее просматриваемыми материалами
}


// Обновление значения счетчика просмотров
public function update_counter($material_id,$counter_data)
{
    $this->db->where('material_id',$material_id);
    $this->db->update('materials',$counter_data);
}


//получает три параметра: id категории, ограничение количества записей, и с какой записи начать
public function get_by($section_id,$limit,$start_from)
{
    $this->db->order_by('material_id','desc');
    $this->db->where   ('section0',$section_id);
    for ($i=1;$i<7;$i++)
    {
        $cname = 'section'.$i;
        $this->db->or_where($cname,$section_id);
    }
     
    //ограничиваем запрос к базе двумя параметрами     
    $this->db->limit($limit,$start_from);       

    $query = $this->db->get('materials');
    
    // Возвращает массив с материалами конкретной категории, урезанный в соответствии с разбивкой pagination
    return $query->result_array();
}

//получает три параметра: id категории, ограничение количества записей, и с какой записи начать
public function get_adv_by($secadv,$typesel = '',$item_id = 0,$limit,$start_from)
{
	$this->db->order_by('material_id','desc');
	$this->db->where('section0',$secadv);

	if($typesel != '')
	{
		if($typesel == 'hotel_type_id' && $item_id != 0)
		{
			$this->db->where('hotel_type_id', $item_id);
		}
		elseif($typesel == 'country' && $item_id != 0)
		{
			$this->db->where('country', $item_id);
		}
	}
	
	for ($i=1;$i<7;$i++)	
	{
	$cname = 'section'.$i;
			$this->db->or_where($cname,$secadv);
	}
	
	//ограничиваем запрос к базе двумя параметрами
	$this->db->limit($limit,$start_from);

	$query = $this->db->get('materials');

	// Возвращает массив с материалами конкретной категории, урезанный в соответствии с разбивкой pagination
	return $query->result_array();
}

// Функция подсчета количества материалов с группировкой по определенным параметрам
// $section_id - параметр для группировки по разделу
// $typegroup - параметр для дополнительной группировки:
//  - hotel_type_id - группировка для отелей
//  - country - группировка для ресторанов
// $item_id - идентификатор группировки

public function count_by($section_id, $typegroup='', $item_id=0)
{
    $this->db->where ('section0',$section_id);
    
    if ($typegroup == 'hotel_type_id'){
    	$this->db->where ('hotel_type_id', $item_id);
    }
    elseif ($typegroup == 'country'){
    	$this->db->where ('country', $item_id);
    }

    for ($i=1;$i<7;$i++)
    {
        $cname = 'section'.$i;
        $this->db->or_where($cname,$section_id);
    }
    return $this->db->count_all_results('materials');
}

// Подсчет количества материалов
// @input $cur_mat - вид материала
public function count_all($cur_mat)
{
	if ($cur_mat == 'tours')
	{
		$this->db->where('section0 !=','news');
		$this->db->where('section0 !=','notes');
	}
	elseif ($cur_mat == 'news')
	{
		$this->db->where('section0','news');
	}
	elseif ($cur_mat == 'notes')
	{
		$this->db->where('section0','notes');
	}
	elseif ($cur_mat == 'actions')
	{
		$this->db->where('section0','actions');
	}
	return $this->db->count_all_results('materials');
}

// Получаем массив материалов
public function get_materials($current_mat,$limit,$start_from)
{
    $this->db->order_by('material_id','desc');
    
    //ограничиваем запрос к базе двумя параметрами
    $this->db->limit($limit,$start_from);
	
	if ($current_mat == 'tours')
	{
		$this->db->where('section0 !=','news');
		$this->db->where('section0 !=','notes');
		$this->db->where('section0 !=','actions');
		$this->db->where('section0 !=','hotels');
		$this->db->where('section0 !=','rests');
	}
	elseif ($current_mat == 'news')
	{
		$this->db->where('section0','news');
	}
	elseif ($current_mat == 'notes')
	{
		$this->db->where('section0','notes');
	}
	elseif ($current_mat == 'actions')
	{
		$this->db->where('section0','actions');
	}
	elseif ($current_mat == 'hotels')
	{
		$this->db->where('section0','hotels');
	}
	elseif ($current_mat == 'rests')
	{
		$this->db->where('section0','rests');
	}

    $query = $this->db->get('materials');
    
    //Возвращаем массив с материалами, урезанный в соответствии с разбивкой pagination
    return $query->result_array();
}

//Получение значений, хранящихся в полях section0 - section7 для конкретного материала
public function get_section_values($material_id)
{
    $this->db->where('material_id',$material_id);
    for ($i=0;$i<7;$i++)
    {
        $cname = 'section'.$i;
        $this->db->select($cname);
    }

    $query = $this->db->get('materials');
    return $query->row_array();
}

// Получаем данные для блока ссылок
public function get_links($material_id)
{
	$tmp = $this->db->get_where('materials', array('material_id' => $material_id));
	$row = $tmp->row();

    for ($i=0;$i<7;$i++)
    {
    	$lname = 'section'.$i;
        $this->db->or_where('section_id', $row->$lname);
    }
	
    $query = $this->db->get('sections');

    return $query->result_array();//Возвращаем массив с разделами	
}
}
/* End of file materials_model.php */
/* Location: ./application/models/materials_model.php */