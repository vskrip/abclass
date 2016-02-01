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
 * Abclass Checkbox Helper
 *
 * This functions checkbox helper of site
 *
 * @package		ABClass
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Vladimir Skripachev
 * @link		http://abclass.ru
 */

function populate($material_id,$names,$section_name)
{   
	for ($i=0;$i<7;$i++)
	{
		$cname = 'section'.$i;

		if ($names[$cname] == $section_name)
		{
			echo 'checked';        
		}
	}
}

function populate_other($item,$id)
{
	if($item == $id)
	{
		echo 'checked';
	}
}