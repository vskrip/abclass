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
 * Abclass TinyMCE Helper
 *
 * This functions TinyMCE helper of site
 *
 * @package		ABClass
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
function get_tinymce()
{
    $CI =& get_instance();
    $code = $CI->load->view('tinymce','',TRUE);
    return $code;
}