<?php
/**
 * jSecure Authentication components for Joomla!
 * jSecure Authentication extention prevents access to administration (back end)
 * login page without appropriate access key. 
 * @author      $Author: Ajay Lulia $
 * @copyright   Joomla Service Provider - 2012
 * @package     jSecure3.0
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     $Id: view.html.php  $
 */
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.html.pane');

class jsecureViewMastermail extends JViewLegacy {
	protected $form;
	protected $item;
	protected $state;
	function display($tpl=null){
        
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		$basepath   = JPATH_ADMINISTRATOR .'/components/com_jsecure';
		$configFile	= $basepath.'/params.php';
		require_once($configFile);
		$JSecureConfig = new JSecureConfig();
		
		$this->assignRef('JSecureConfig',$JSecureConfig);
		$this->addToolbar();
		parent::display($tpl);
	}

	 protected function addToolbar()
	{
		
		JToolBarHelper::title(JText::_('jSecure Authentication'), 'generic.png');
		
			JToolBarHelper::apply('saveMpmail');
			JToolBarHelper::save('saveMpmail');
			JToolBarHelper::cancel('cancel');
			JToolBarHelper::help('help');
	}

	
	function save(){
		$app    = &JFactory::getApplication();
     	$msg  = 'Details Has Been Saved';
		$result = $this->saveDetails();

 		if($result){
 			$link = 'index.php?option=com_jsecure&task=mastermail';
 			$msg  = 'Details Has Been Saved';
 			$app->redirect($link,$msg);
 	    }
 	}

 	
 	function saveDetails(){	
 		
		jimport('joomla.filesystem.file');	
		$app        =& JFactory::getApplication();
		$option		= JRequest::getVar('option', '', '', 'cmd');
		$post       = JRequest::get( 'post' );
		
		$basepath   = JPATH_ADMINISTRATOR .'/components/com_jsecure';
		$configFile	= $basepath.'/params.php';
		
		$xml	    = $basepath.'/com_jsecure.xml';
		
		require_once($configFile);
		
		if(! is_writable($configFile))
		{
			$link = "index.php?option=com_jsecure&task=mastermail";
			$msg = 'Configuration File is Not Writable /administrator/components/com_jsecure/params.php ';
			$app->redirect($link, $msg, 'notice'); 
			exit();
		}

		// Read the ini file
		if (JFile::exists($configFile)) {
			$content = JFile::read($configFile);
		} else {
			$content = null;
		}

		$config	  = new JRegistry('JSecureConfig');
		$oldValue = new JSecureConfig();
		$config_array = array();
		$config_array['publish']	                  = $oldValue->publish;
		$config_array['key']                          =  $oldValue->key;
		$config_array['passkeytype']	             =  $oldValue->passkeytype;
		$config_array['options']                     =  $oldValue->options; 
		$config_array['custom_path']				 =  $oldValue->custom_path;
		
		$config_array['enableMasterPassword']   = $oldValue->enableMasterPassword;
		$config_array['master_password']        = $oldValue->master_password;
		$config_array['include_basic_confg']    = $oldValue->include_basic_confg;
		$config_array['include_adminpwdpro']    = $oldValue->include_adminpwdpro;
		$config_array['include_mail']           = $oldValue->include_mail;
		$config_array['include_ip']             = $oldValue->include_ip;
		$config_array['include_mastermail']     = $oldValue->include_mastermail;
		$config_array['include_adminid']        = $oldValue->include_adminid;
		$config_array['include_logincontrol']   = $oldValue->include_logincontrol;
		$config_array['include_metatags']       = $oldValue->include_metatags;
		$config_array['include_purgesessions']	= $oldValue->include_purgesessions;
		$config_array['include_log']            = $oldValue->include_log;
		$config_array['include_showlogs']       = $oldValue->include_showlogs;
		$config_array['include_directorylisting']= $oldValue->include_directorylisting;
		$config_array['sendemail']		 = $oldValue->sendemail;
		$config_array['sendemaildetails']	 = $oldValue->sendemaildetails;
		$config_array['emailid']		 = $oldValue->emailid;
		$config_array['emailsubject']		 = $oldValue->emailsubject;
		$config_array['iptype']	                 = $oldValue->iptype;
		$config_array['iplistB']                 = $oldValue->iplistB;
		$config_array['iplistW']                 = $oldValue->iplistW;
		$config_array['mpsendemail']	         = JRequest::getVar('mpsendemail', 0, 'post', 'int');
		$config_array['mpemailsubject']		 = JRequest::getVar('mpemailsubject', '', 'post', 'string');
		$config_array['mpemailid']		 = JRequest::getVar('mpemailid', '', 'post', 'string');
		$config_array['login_control']		 = $oldValue->login_control;
		$config_array['adminpasswordpro']	 = $oldValue->adminpasswordpro;
		$config_array['metatagcontrol']		 = $oldValue->metatagcontrol;
		$config_array['metatag_generator']	 = $oldValue->metatag_generator;
		$config_array['metatag_keywords']	 = $oldValue->metatag_keywords;
		$config_array['metatag_description']	 = $oldValue->metatag_description;
		$config_array['metatag_rights']		 = $oldValue->metatag_rights;
		
		$config_array['adminType'] = $oldValue->adminType ;
		$config_array['delete_log']  = JRequest::getVar('delete_log', '0', 'post', 'int');

		$modifiedFieldName	=$this->checkModifiedFieldName($config_array, $oldValue, $JSecureCommon, $keyvalue, $masterkeyvalue);
		
		$config->loadArray($config_array);
		
		$fname = JPATH_COMPONENT_ADMINISTRATOR.'/'.'params.php';
		 
		if (JFile::write($fname, $config->toString('PHP', array('class' => 'JSecureConfig','closingtag' => false)))) 
			$msg = JText::_('The Configuration Details have been updated');
		 else 
			$msg = JText::_('ERRORCONFIGFILE');
	
		if($modifiedFieldName != ''){
			$basepath   = JPATH_COMPONENT_ADMINISTRATOR .'/models/jsecurelog.php';
			require_once($basepath);
		
			$model 	= $this->getModel( 'jsecurelog' );
			$change_variable = str_replace('<br/>', '\n', $modifiedFieldName); 
		
			$insertLog = $model ->insertLog('JSECURE_EVENT_CONFIGURATION_FILE_CHANGED', $change_variable);
		}

		
		$JSecureConfig		  = new JSecureConfig();
		if($JSecureConfig->mpsendemail != '0')
			$result	= $this->sendmail($JSecureConfig, $modifiedFieldName);
		
		return true;
 	}	
	
 	function checkModifiedFieldName($newValue, $oldValue, $JSecureCommon, $keyvalue=null, $masterkeyvalue=null){

	$basepath   = JPATH_ADMINISTRATOR .'/components/com_jsecure';
	$commonFile	= $basepath.'/common.php';
	require_once($commonFile);
	
		foreach($newValue as $key){
			$currentKeyName =  key($newValue);
		
			if(isset($oldValue)){
			 
			 if(array_key_exists($currentKeyName, $oldValue)){
				$result=($newValue[$currentKeyName] == $oldValue->$currentKeyName) ? '1' : '0';
				
				if(!$result){
					
					switch($currentKeyName){
		
						
						case 'delete_log':
							
							$val=0;
							$newLogValue= $newValue[$currentKeyName].' Month';
							if($newLogValue == 0){
								$val='Forever';
							}else{

								for($i=0;$i<=5;$i++){
									if($newLogValue == $delete_log[$i])
										$val=$delete_log[$i];
								}

							}
							$ModifiedValue = ($ModifiedValue != '') ? ($ModifiedValue . $JSecureCommon[$currentKeyName] . ' : ' . $val . '<br/>') : (  $JSecureCommon[$currentKeyName] . ' : ' . $val . '<br/>');
							
							break;
				
						default:
							$ModifiedValue = ($ModifiedValue != '') ? ($ModifiedValue . $JSecureCommon[$currentKeyName] . ' = ' . $newValue[$currentKeyName] . '<br/>') : ( $JSecureCommon[$currentKeyName] . ' = ' . $newValue[$currentKeyName] . '<br/>');
							break;
					}

				}	
				next($newValue);
			 }
		  }
		}
	  return $ModifiedValue;
   }
 	
   function sendmail($JSecureConfig, $fieldName){
   		
		$config   = new JConfig();

		 $to        = $JSecureConfig->mpemailid;	
		 $to        = ($to) ? $to :  $config->mailfrom;
		 
		 if($to){
			$fromEmail  = $config->mailfrom;
			$fromName  = $config->fromname;
			$subject      = $JSecureConfig->mpemailsubject;
			$body         = JText::_( 'BODY_MESSAGE_FOR_MODIFIED_FIELDNAME:' ) .$_SERVER['REMOTE_ADDR'];
			$body		.= " ";
			$body		.= $fieldName ;  
			
			//JUtility::sendMail($fromEmail, $fromName, $to, $subject, $body,1);
			$headers .= 'From: '. $fromName . ' <' . $fromEmail . '>';
			//mail($to, $subject, $body, $headers);
			$return = JFactory::getMailer()->sendMail($fromEmail, $headers, $to, $subject, $body,1);
			if ($return !== true) {
			return new JException(JText::_('COM_JSECURE_MAIL_FAILED'), 500);
		 }	
		 }	
	}   
}

?>