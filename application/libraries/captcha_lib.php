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
 * Abclass User Library Of Captcha 
 *
 * This class library of captcha functionality
 *
 * @package		ABClass
 * @subpackage	Library
 * @category	Library
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Captcha_lib
{    

public function captcha_actions()
{
    $CI =& get_instance ();          
        
    //Загружаем хэлпер Капча
    $CI->load->helper('captcha');
        
    //Загружаем хэлпер для генерирования случайной строки
    $CI->load->helper('string');		
    $rnd_str = random_string('numeric',5);
            			
    //Записываем строку в сессию
    $ses_data = array();
    $ses_data['rnd_captcha'] = $rnd_str;
    $CI->session->set_userdata($ses_data);
            			
    //Параметры картинки
    $settings = array('word'	   => $rnd_str,
     				  'img_path'   => './img/captcha/',
       				  'img_url'	   => base_url().'img/captcha/',
       				  'font_path'  => './system/fonts/cour.ttf',
      				  'img_width'  => 120,
      				  'img_height' => 30,
       				  'expiration' => 10);

    //Создаем капчу
    $captcha = create_captcha($settings);
                     
    //Получаем в переменную код картинки 
    $imgcode = $captcha['image'];   
    return $imgcode;          
}
}
/* End of file captcha_lib.php */
/* Location: ./application/libraries/captcha_lib.php */