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
 * Abclass Helps
 *
 * This class model helps of site
 *
 * @package		ABClass
 * @subpackage	Models
 * @category	Models
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */
class Helps_model extends Crud
{

public function get_by($help_id)
{
	$query = $this->db->get_where('helps', array('help_id' => $help_id));
	return $query->row_array();
}

}
/* End of file helps_model.php */
/* Location: ./application/models/helps_model.php */