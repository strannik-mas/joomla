<?php/*------------------------------------------------------------------------# mod_zhyandexmap - Zh YandexMap Module# ------------------------------------------------------------------------# author:    Dmitry Zhuk# copyright: Copyright (C) 2011 zhuk.cc. All Rights Reserved.# license:   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later# website:   http://zhuk.cc# Technical Support Forum: http://forum.zhuk.cc/-------------------------------------------------------------------------*/// No direct access to this filedefined('_JEXEC') or die('Restricted access');JLoader::register('modZhYandexMapHelper', JPATH_BASE.'/modules/mod_zhyandexmap/helpers/mod_zhyandexmap.php'); JLoader::register('comZhYandexMapData', JPATH_SITE.'/components/com_zhyandexmap/helpers/map_data.php'); require JModuleHelper::getLayoutPath('mod_zhyandexmap', $params->get('layout', 'default'));