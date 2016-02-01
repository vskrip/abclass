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
 * Abclass User Library Of Display Views
 *
 * This class library to manage load views of site
 *
 * @package		ABClass
 * @subpackage	Library
 * @category	Library
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Display_lib
{

//data - массив с переменными, name - начало имени файла вида    
public function user_main_page($data,$name)
{
    $CI =& get_instance ();
    
    $CI->load->view('preheader_view',$data);
    $CI->load->view('header_view');
    $CI->load->view('top_navigation_view');
    $CI->load->view($name.'_view',$data);
    //$CI->load->view('leftpageblock_view');
    $CI->load->view('countries_view');
    $CI->load->view('footer_view');
}

public function user_page($data,$name)
{
    $CI =& get_instance ();
    
    $CI->load->view('preheader_view',$data);
    $CI->load->view('header_view');
    $CI->load->view('top_navigation_view');
    $CI->load->view($name.'_view',$data);
    $CI->load->view('leftblock_view',$data);
    $CI->load->view('rightblock_view',$data);
    $CI->load->view('footer_view');        
}

public function user_sect_page($data,$name)
{
    $CI =& get_instance ();
    
    $CI->load->view('preheader_view',$data);
    $CI->load->view('header_view');
    $CI->load->view('top_navigation_view');
    $CI->load->view($name.'_view',$data);
    $CI->load->view('leftsectblock_view',$data); // Блок с отображением ссылок связынных разделов
    $CI->load->view('rightblock_view',$data);
    $CI->load->view('footer_view');        
}


public function user_mat_page($data,$name)
{
    $CI =& get_instance ();
    
    $CI->load->view('preheader_view',$data);
    $CI->load->view('header_view');
    $CI->load->view('top_navigation_view');
    $CI->load->view($name.'_view',$data);
    $CI->load->view('leftmatblock_view',$data); // Блок с отображением ссылок разделов
    $CI->load->view('rightblock_view',$data);
    $CI->load->view('footer_view');        
}

public function user_info_page($data,$name)
{
    $CI =& get_instance ();

    $CI->load->view('info_preheader_view');
    $CI->load->view('header_view');
    $CI->load->view('top_navigation_view');
    $CI->load->view($name.'_view',$data);
    $CI->load->view('leftblock_view',$data);
    $CI->load->view('rightblock_view',$data);
    $CI->load->view('footer_view');
}    


public function admin_page($data,$name)
{
    $CI =& get_instance ();

    $CI->load->view('admin/preheader_view');
    $CI->load->view('admin/header_view');
    $CI->load->view('admin/top_navigation_view');
    $CI->load->view('admin/'.$name.'_view',$data);
    $CI->load->view('admin/leftblock_view',$data);
    $CI->load->view('admin/rightblock_view',$data);
    $CI->load->view('admin/footer_view');
}


public function admin_info_page($data)
{
    $CI =& get_instance ();

    $CI->load->view('admin/preheader_view');
    $CI->load->view('admin/header_view');
    $CI->load->view('admin/top_navigation_view');
    $CI->load->view('info_view',$data);
    $CI->load->view('admin/leftblock_view');
    $CI->load->view('admin/footer_view');
}


public function login_page($data)
{
    $CI =& get_instance ();

    $CI->load->view('admin/preheader_view');
    $CI->load->view('admin/header_view');
    $CI->load->view('admin/top_navigation_view');
    $CI->load->view('admin/login_view',$data);
    $CI->load->view('footer_view');
}
}
/* End of file display_lib.php */
/* Location: ./application/libraries/display_lib.php */
