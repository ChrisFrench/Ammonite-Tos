<?php
/**
 * @package	Terms of Service
 * @author 	Ammonite Networks
 * @link 	http://www.ammonitenetworks.com
 * @copyright Copyright (C) 2012 Ammonite Networks. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

Tos::load('TosModelBase','models.base');

class TosModelDashboard extends TosModelBase 
{
	function getTable($name='Config', $prefix='TosTable', $options = array())
	{
		return parent::getTable($name, $prefix, $options);
	}
}