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
 * Abclass Cotinents
 *
 * This class controller continents of site
 *
 * @package		ABClass
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Continents extends CI_Controller
{
    
public function __construct()
{
    parent::__construct();
}

public function index()
{
    redirect (base_url());
}

}
/* End of file continents.php */
/* Location: ./application/controllers/continents.php */