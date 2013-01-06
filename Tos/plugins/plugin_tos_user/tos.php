<?php 
/**
 * @package Terms of Service
 * @author  Ammonite Networks
 * @link    http://www.ammonitenetworks.com
 * @copyright Copyright (C) 2012 Ammonite Networks. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

/** Import library dependencies */
jimport('joomla.plugin.plugin');

class plgUserTos extends JPlugin 
{
    function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
    }

     /**
     * EXAMPLE  Redirect a user to the terms and conditions after login
     *
     * @access  public
     * @param   array   holds the user data
     * @param   array    extra options
     * @return  boolean True on success
     * @since   1.5
     */
    function onUserLogin($user, $options)
    {
       if ( !class_exists('Tos') ) 
             JLoader::register( "Tos", JPATH_ADMINISTRATOR."/components/com_tos/defines.php" );
        
        Tos::getClass('TosHelperTos','helpers.tos')->checkAccepted($this->params->def('scope_id', 1));


    }
}
