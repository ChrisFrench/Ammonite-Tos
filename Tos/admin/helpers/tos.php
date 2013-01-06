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

class TosHelperTos extends DSCHelper { 


	function checkAccepted($scope_id, $redirect = TRUE, $user_id = NULL) {
		

		if($user_id == NULL) {
			$user_id = JFactory::getUser()->id;
		}
		//all of the users accepted Terms
		$acceptedList = $this->getAccepted($user_id, $scope_id);
		
		//The Newest set of terms for this Scope
		$terms = $this->getTerms($scope_id);

		//if the user has accepted the newest terms, with this setup we can return something if we wanted  like you  need to accept NEW terms,
		// becuase we have the other terms they accepted
		foreach($acceptedList as $accepted) {
			if($accepted->terms_id == $terms->terms_id ) {
				return TRUE;
			}
		}
		//IF we are here than the user needs to accept
		if($redirect ) {
			$app = JFactory::getApplication();

			$uri        = JFactory::getURI();
	    	$return     = $uri->toString();

			$url = 'index.php?option=com_tos&view=terms&id='. $terms->terms_id;
			if($terms->item_id) {
				$url .= '&Itemid='.$terms->item_id;
			}
			$url .= '&return='. base64_encode($return);
			
			$app->redirect($url, JText::_( 'COM_TOS_YOU_MUST_ACCEPT_TOS' ));
		}
		//if no redirect we just fail.
		return FALSE;

	}

	function getAccepted($user_id, $scope_id) {

		$db = JFactory::getDBO();
        $query = NEW DSCQuery();
        $query->select('*');
        $query->from('#__tos_accepts as a');
        $query->where('a.scope_id = '. (int) $scope_id );
        $query->where('a.enabled = '. (int) 1);
        $query->order('a.created_date ASC');
        $db->setQuery($query, 0 , 1);
        $terms =  $db->loadObjectList();      
        return $terms;

	}

	function getTerms($scope_id) {


		$db = JFactory::getDBO();
        $query = NEW DSCQuery();
        $query->select('*');
        $query->from('#__tos_terms as t');
        
		
        $query->where('t.scope_id = '. (int) $scope_id );
        $query->where('t.enabled = '. (int) 1);
        $query->order('t.created_date ASC');
        $db->setQuery($query, 0 , 1);
        $terms =  $db->loadObject();
      
        return $terms;
    
	}


}

