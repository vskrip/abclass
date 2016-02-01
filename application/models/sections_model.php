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
 * Abclass Model Sections
 *
 * This class model sections of site
 *
 * @package		ABClass
 * @subpackage	Models
 * @category	Models
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Sections_model extends Crud
{  

public $table = 'sections'; //Имя таблицы	
public $idkey = 'section_id'; //Имя ID
 
 
// правила для добавления новой категории
public $add_rules = array
(
    array
    (
      'field' => 'section_id',
      'label' => 'Идентификатор категории',
      'rules' => 'trim|required|alpha_dash|max_length[100]'
    ),
    array
    (
      'field' => 'title',
      'label' => 'Название категории',
      'rules' => 'required|max_length[100]'
    ),
    array
    (
      'field' => 'description',
      'label' => 'Мета-описание категории',
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
      'field' => 'main_text',
      'label' => 'Краткое описание категории',
      'rules' => 'required'
    )
);


// правила для обновления категории
public $update_rules = array
(
    array
    (
      'field' => 'title',
      'label' => 'Название категории',
      'rules' => 'required|max_length[100]'
    ),        
    array
    (
      'field' => 'description',
      'label' => 'Мета-описание категории',
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
      'field' => 'main_text',
      'label' => 'Краткое описание категории',
      'rules' => 'required'
    )
);



//массив со всеми категориями    
public function get_all()
{
    $query = $this->db->get('sections');
    return $query->result_array();
}

// Получаем данные для блока ссылок
public function get_links($section_id)
{
	$tmp = $this->db->get_where('sections', array('section_id' => $section_id));
	$row = $tmp->row();

    for ($i=0;$i<7;$i++)
    {
    	$lname = 'link'.$i;
        $q = $this->db->or_where('section_id', $row->$lname);
    }
	
    $query = $this->db->get('sections');

    return $query->result_array();//Возвращаем массив с разделами	
}

// Получаем список бестселлеров
public function get_bests()
{
	// тип раздела 1 - бестселлер
	$this->db->where('sectype',1);
	$query = $this->db->get('sections');
	
	return $query->result_array();
}

// Получаем список типов туров
public function get_type_tours()
{
	// Тип раздела 2 - тип тура
	$this->db->where('sectype',2);
	$query = $this->db->get('sections');
	
	return $query->result_array();
}

// Получаем дочерние разделы
public function get_child_sections($section_id)
{
	$this->db->where('link0',$section_id);
	$query = $this->db->get('sections');
	
	return $query->result_array();
}

// Получение url-адреса баннера для материала из базы данных
public function get_ban_url_by($material_id = '')
{
	$tmp = $this->db->get_where('materials', array('material_id' => $material_id));
	$row = $tmp->row();
	
	$sname = 'section0';
	$query = $this->db->where('section_id', $row->$sname);

    $query = $this->db->get('sections');
	$res = $query->row();
	
	$fild = 'ban_img_url';
    return $res->$fild;

}
}
/* End of file sections_model.php */
/* Location: ./application/models/sections_model.php */