<?php
/*------------------------------------------------------------------------
# com_zhyandexmap - Zh YandexMap
# ------------------------------------------------------------------------
# author:    Dmitry Zhuk
# copyright: Copyright (C) 2011 zhuk.cc. All Rights Reserved.
# license:   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
# website:   http://zhuk.cc
# Technical Support Forum: http://forum.zhuk.cc/
-------------------------------------------------------------------------*/
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

/**
 * ZhYandexMap Model
 */
class ZhYandexMapModelZhYandexMap extends JModelAdmin
{

    var $mapapikey;

	var $mapDefLat;
	var $mapDefLng;
	
	var $componentapiversion;
	
	var $mapMapTypeYandex;
	var $mapMapTypeOSM;
	var $mapMapTypeCustom;
	var $mapMapTypeList;
	
	var $maphttpsprotocol;
	


	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'ZhYandexMap', $prefix = 'ZhYandexMapTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		Data for the form.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	mixed	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true) 
	{
		// Get the form.
		$form = $this->loadForm('com_zhyandexmap.zhyandexmap', 'zhyandexmap', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) 
		{
			return false;
		}
		return $form;
	}
	/**
	 * Method to get the script that have to be included on the form
	 *
	 * @return string	Script files
	 */
	public function getScript() 
	{
		return 'administrator/components/com_zhyandexmap/models/forms/zhyandexmap.js';
	}
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_zhyandexmap.edit.zhyandexmap.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}

	public function getAPIKey() 
	{
		// Get global params
		$params = JComponentHelper::getParams( 'com_zhyandexmap' );

		return $mapapikey = $params->get( 'map_key', '' );
	}

	public function getDefLat() 
	{
		// Get global params
		$params = JComponentHelper::getParams( 'com_zhyandexmap' );

		return $mapDefLat = $params->get( 'map_lat', '' );
	}

	public function getDefLng() 
	{
		// Get global params
		$params = JComponentHelper::getParams( 'com_zhyandexmap' );

		return $mapDefLng = $params->get( 'map_lng', '' );
	}

	public function getAPIVersion() 
	{
		// Get global params
		$params = JComponentHelper::getParams( 'com_zhyandexmap' );

		return $componentapiversion = $params->get( 'map_api_version', '' );
	}

	public function getMapTypeYandex() 
	{
		// Get global params
		$params = JComponentHelper::getParams( 'com_zhyandexmap' );

		return $mapMapTypeYandex = $params->get( 'map_type_yandex', '' );
	}
	public function getMapTypeOSM() 
	{
		// Get global params
		$params = JComponentHelper::getParams( 'com_zhyandexmap' );

		return $mapMapTypeOSM = $params->get( 'map_type_osm', '' );
	}
	public function getMapTypeCustom() 
	{
		// Get global params
		$params = JComponentHelper::getParams( 'com_zhyandexmap' );

		return $mapMapTypeCustom = $params->get( 'map_type_custom', '' );
	}

	public function getHttpsProtocol() 
	{
		// Get global params
		$params = JComponentHelper::getParams( 'com_zhyandexmap' );

		return $maphttpsprotocol = $params->get( 'httpsprotocol', '' );
	}	
	
	public function getMapTypeList() 
	{
		if (!isset($this->mapMapTypeList)) 
		{       

			$this->_db->setQuery($this->_db->getQuery(true)
				->select('h.*, c.title as category ')
				->from('#__zhyandexmaps_maptypes as h')
				->leftJoin('#__categories as c ON h.catid=c.id')
				->where('h.published=1')
				->order('h.title'));

			$this->mapMapTypeList = $this->_db->loadObjectList();

			// Custom Fields
			//if (!$this->mapMapTypeList = $this->_db->loadObjectList()) 
			//{
			//	$this->setError($this->_db->getError());
			//}

		}

		return $this->mapMapTypeList;
	}
	
}
