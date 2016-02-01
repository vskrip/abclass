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
 * Abclass Comments Model
 *
 * This class model comments of site
 *
 * @package		ABClass
 * @subpackage	Models
 * @category	Models
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Comments_model extends Crud
{    
    
public $table = 'comments'; //Имя таблицы	
public $idkey = 'comment_id'; //Имя ID

//правила для добавления комментариев
public $add_rules = array
(                   
    array
    (
      'field' => 'author',
      'label' => 'Имя',
      'rules' => 'trim|required|xss_clean|max_length[70]'
    ),        
    array
    (
      'field' => 'comment_text',
      'label' => 'Текст комментария',
      'rules' => 'required|xss_clean|max_length[5000]'
    ),
    array
    (
     'field' => 'captcha',
     'label' => 'Цифры с картинки',
     'rules' => 'required|numeric|exact_length[5]'
    )
);


//правила для обновления комментариев
public $update_rules = array
(
    array
    (
      'field' => 'author',
      'label' => 'Имя',
      'rules' => 'trim|required|max_length[70]'
    ),
    array
    (
      'field' => 'comment_text',
      'label' => 'Текст комментария',
      'rules' => 'required|max_length[5000]'
    )
);


public function get_by($material_id)
{
    $this->db->order_by ('comment_id','desc'); 
    $this->db->where ('material_id',$material_id);   
    $query = $this->db->get('comments');
    return $query->result_array();//Возвращаем массив с комментариями к материалу
}


public function get_latest()
{
    $this->db->order_by('comment_id','desc');
    $this->db->limit(5);
    $query = $this->db->get('comments');
    return $query->result_array();//Возвращаем массив со свежими комментариями
}


public function add_new($comment_data)
{        
    $this->db->insert('comments',$comment_data);                       
}


public function get_all($limit,$start_from)
{
    $this->db->order_by('comment_id','desc');
    
    //ограничиваем запрос к базе двумя параметрами
    $this->db->limit($limit,$start_from);
    $query = $this->db->get('comments');
    
    //Возвращаем массив со всеми комментариями, урезанный в соответствии с разбивкой pagination
    return $query->result_array();
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
/* End of file comments_model.php */
/* Location: ./application/models/comments_model.php */