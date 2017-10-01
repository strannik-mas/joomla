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
defined('_JEXEC') or die('Restricted Access');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

?>
<tr>
	<th width="10" class="nowrap center hidden-phone">
		<?php echo JHtml::_('grid.sort', 'COM_ZHYANDEXMAP_MAP_HEADING_ID', 'h.id', $listDirn, $listOrder); ?>
	</th>
	<th width="20" class="hidden-phone">
		<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
	</th>			
	<th class="title">
		<?php echo JHtml::_('grid.sort', 'COM_ZHYANDEXMAP_MAP_HEADING_TITLE', 'h.title', $listDirn, $listOrder); ?>
	</th>
	<th>
		<?php echo JText::_('COM_ZHYANDEXMAP_MAP_HEADING_CATEGORY'); ?>
	</th>
</tr>


