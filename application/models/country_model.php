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
 * Abclass Country Model
 *
 * This class model country
 *
 * @package		ABClass
 * @subpackage	Models
 * @category	Models
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Country_model extends Crud
{    
    
public $table = 'country'; //Имя таблицы	
public $idkey = 'id'; //Имя ID

//правила для добавления стран
public $add_rules = array
(                   
    array
    (
      'field' => 'cont_id',
      'label' => 'Континент',
      'rules' => 'required|xss_clean'
    ),        
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
      'field' => 'cont_id',
      'label' => 'Континент',
      'rules' => 'required|xss_clean'
    ),        
    array
    (
      'field' => 'title',
      'label' => 'Название',
      'rules' => 'required|xss_clean|max_length[150]'
    )
);

// Массив всех стран
public function get_all()
{
	$query = $this->db->get('country');
	return $query->result_array();
}

// Страны по континентам
public function get_by($cont_id)
{
    $this->db->order_by ('title','asc'); 
    $this->db->where ('cont_id',$cont_id);   
    $query = $this->db->get('country');
    return $query->result_array();//Возвращаем массив стран по континенту
}

// Получение названия страны для отображения в части заголовка раздела
public function get_country_title($item_id)
{
	$sql = "SELECT title FROM country WHERE id = ?";
	$query = $this->db->query($sql,$item_id);
	
	$row = $query->row_array();
	return $row['title'];
}
}
/* End of file country_model.php */
/* Location: ./application/models/country_model.php */