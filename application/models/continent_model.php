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
 * This class model continent
 *
 * @package		ABClass
 * @subpackage	Models
 * @category	Models
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Continent_model extends Crud
{    
    
public $table = 'continent'; //Имя таблицы	
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

// Получение массива всех континентов
public function get_all()
{
	$query = $this->db->get('continent');
	return $query->result_array();
}
}
/* End of file continent_model.php */
/* Location: ./application/models/continent_model.php */