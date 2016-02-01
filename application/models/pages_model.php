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
 * Abclass Model Pages
 *
 * This class model pages of site
 *
 * @package		ABClass
 * @subpackage	Models
 * @category	Models
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Pages_model extends Crud
{    
    
public $table = 'pages'; //Имя таблицы	
public $idkey = 'page_id'; //Имя ID


// правила для добавления новой страницы
public $add_rules = array
(
    array
    (
      'field' => 'page_id',
      'label' => 'Идентификатор страницы',
      'rules' => 'trim|required|alpha_dash|max_length[100]'
    ),
    array
    (
      'field' => 'title',
      'label' => 'Название страницы',
      'rules' => 'required|max_length[100]'
    ),        
    array
    (
      'field' => 'description',
      'label' => 'Мета-описание страницы',
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
      'label' => 'Основное содержание страницы',
      'rules' => 'required'
    )
);


// правила для редактирования страницы    
public $update_rules = array
(
    array
    (
      'field' => 'title',
      'label' => 'Название страницы',
      'rules' => 'required|max_length[100]'
    ),        
    array
    (
      'field' => 'description',
      'label' => 'Мета-описание страницы',
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
      'label' => 'Основное содержание страницы',
      'rules' => 'required'
    )
);


// правила для формы заказа
public $form_order_rules = array
    (   
       array
       (
         'field' => 'name',
         'label' => 'Имя',
         'rules' => 'trim|required|xss_clean|max_length[70]'
       ),
       array
       (
         'field' => 'email',
         'label' => 'Е-mail',
         'rules' => 'trim|required|valid_email|xss_clean|max_length[70]'
       ),
       array
       (
         'field' => 'topic',
         'label' => 'Тема сообщения',
         'rules' => 'required|xss_clean|max_length[70]'
       ),        
       array
       (
         'field' => 'message',
         'label' => 'Текст сообщения',
         'rules' => 'required|xss_clean|max_length[5000]'
       ),
       array
       (
         'field' => 'captcha',
         'label' => 'Цифры с картинки',
         'rules' => 'required|numeric|exact_length[5]'
       )
    );
    
    

public function get_all()
{
    $query = $this->db->get('pages');
    
    //Возвращаем массив со всеми страницами
    return $query->result_array();
}

// Получаем данные для блока ссылок
public function get_links($page_id)
{
	$tmp = $this->db->get_where('pages', array('page_id' => $page_id));
	$row = $tmp->row();

    for ($i=0;$i<7;$i++)
    {
    	$lname = 'link'.$i;
        $q = $this->db->or_where('page_id', $row->$lname);
    }
	
    $query = $this->db->get('pages');

    return $query->result_array();//Возвращаем массив со страницами	
}
}
/* End of file pages_model.php */
/* Location: ./application/models/pages_model.php */