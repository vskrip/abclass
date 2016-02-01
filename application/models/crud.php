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
 * Abclass CRUD model
 *
 * This class model CRUD of site
 *
 * @package		ABClass
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Crud extends CI_Model
{
    
public $table = ''; //Имя таблицы	
public $idkey = ''; //Имя ID	


public function __construct()
{       
    parent::__construct();         
}

// Получение данных об одной записи
public function get($obj_id)
{
    $this->db->where($this->idkey,$obj_id);
    $query = $this->db->get($this->table);
    return $query->row_array();
}


// Подсчет общего числа записей
public function count_all()
{
    return $this->db->count_all($this->table);
}


// Добавление записи
public function add()
{
     $data = array();  
     $section = $this->input->post('section'); 
     
     // если добавляется не материал (так как данное поле есть только у материлов)
     if (empty($section))
     {
	     foreach ($this->add_rules as $item)
         {
             $f = $item['field'];
             $data[$f] = $this->input->post($f);
	     }         
     }

     //если добавляется материал
     else
     {
         foreach ($this->add_rules as $item)
         {
             $f = $item['field'];
             
             switch($f)
             {
                 case 'section[]':
                 
                     unset($f);
                     break;  
                     
                 default:
                 
                     $data[$f] = $this->input->post($f);
                     break;
             }
	     }
         
         $i = 0;
         foreach ($section as $one)
         {
             $cname = 'section'.$i;
             $$cname = $section[$i];
             $data[$cname] = $$cname;
             $i++;
         }
     }

	 $this->db->insert($this->table,$data);
}



// Обновление записи
public function update($obj_id)
{
     $data = array ();
     $section = $this->input->post('section');

     // если обновляется не материал (так как данное поле есть только у материлов)
     if (empty($section))
     {
         foreach ($this->update_rules as $item)
         {
             $f = $item['field'];
             $data[$f] = $this->input->post($f);           
	     }             
     }

     // если обновляется материал
     else
     {
         foreach ($this->update_rules as $item)
         {
             $f = $item['field'];
             
             switch($f)
             {
                 case 'section[]':
                 
                     unset($f);
                     break;  
                     
                 default:
                 
                     $data[$f] = $this->input->post($f);
                     break;
             }
	     }         

         for ($i=0;$i<7;$i++)
         {   
             foreach ($section as $one)
             {   
                 $cname = 'section'.$i;

                 if (isset($section[$i]))
                 {
                     $$cname = $section[$i];
                     $data[$cname] = $$cname; 
                 }

                 else
                 {                  
                     $$cname = '';
                     $data[$cname] = $$cname;                  
                 }               
             }
         } 	     
	 }

     $this->db->where($this->idkey,$obj_id);
	 $this->db->update($this->table,$data);
}



// Удаление записи
public function delete($obj_id)
{
    $this->db->where ($this->idkey,$obj_id);
    $this->db->delete($this->table);
}
}
/* End of file crud.php */
/* Location: ./application/models/crud.php */