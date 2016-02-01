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
 * Abclass Type Hotels Model
 *
 * This class model types of hotels
 *
 * @package		ABClass
 * @subpackage	Models
 * @category	Models
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Type_hotel_model extends Crud
{    
    
public $table = 'hotel_type'; //Имя таблицы	
public $idkey = 'id'; //Имя ID

//правила для добавления стран
public $add_rules = array
(                   
    array
    (
      'field' => 'title',
      'label' => 'Название',
      'rules' => 'required|xss_clean|max_length[150]'
    )
);


//правила для обновления стран
public $update_rules = array
(
    array
    (
      'field' => 'title',
      'label' => 'Название',
      'rules' => 'required|xss_clean|max_length[150]'
    )
);

// Массив всех типов отелей
public function get_all()
{
	$query = $this->db->get('hotel_type');
	return $query->result_array();
}

// Получение названия типа отеля для части заголовка отображения в разделе
public function get_type_hotel_title($item_id)
{
	
	$sql = "SELECT title FROM hotel_type WHERE id = ?";
	$query = $this->db->query($sql,$item_id);
	
	$row = $query->row_array();
	return $row['title'];
}
// Получение полного описания типа отелей
public function get_type_hotel_desc($item_id)
{

	$sql = "SELECT full_desc FROM hotel_type WHERE id = ?";
	$query = $this->db->query($sql,$item_id);

	$row = $query->row_array();
	return $row['full_desc'];
}
}
/* End of file hotel_type_model.php */
/* Location: ./application/models/hotel_type_model.php */