<?php
/**
 * jSecure Authentication components for Joomla!
 * jSecure Authentication extention prevents access to administration (back end)
 * login page without appropriate access key.
 *
 * @author      $Author: Ajay Lulia $
 * @copyright   Joomla Service Provider - 2012
 * @package     jSecure3.0
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     $Id: default.php  $
 */
	
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
JHtml::_('behavior.framework', true);
JHTML::_('script','system/modal.js', false, true);
JHTML::_('stylesheet','system/modal.css', array(), true);
$document =& JFactory::getDocument();
$document->addScriptDeclaration("window.addEvent('domready', function() {
			$$('.hasTip').each(function(el) {
				var title = el.get('title');
				if (title) {
					var parts = title.split('::', 2);
					el.store('tip:title', parts[0]);
					el.store('tip:text', parts[1]);
				}
			});
			var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false});
		});
		window.addEvent('domready', function() {

			SqueezeBox.initialize({});
			SqueezeBox.assign($$('a.modal'), {
				parse: 'rel'
			});
		});
");
?>
<h3><?php echo JText::_('ADMIN_ACCESS_LOG');?></h3>
<form action="index.php?option=com_jsecure" method="post" name="adminForm" id= "adminForm">
<table width="100%">
<tr>
	<td >
		<div id="filter-bar" class="btn-toolbar">
<div class="filter-search btn-group pull-left">
<input id="search" type="text" title="Search" value="<?php echo $this->search;?>" placeholder="<?php echo JText::_('FILTER_IP'); ?>" name="search" onchange="document.adminForm.submit();">
					</div>
					<div class="btn-group pull-left">
					<button class="btn tip" rel="tooltip" type="submit" data-original-title="Search" onclick="this.form.submit();">
					<i class="icon-search"></i>
					 </button>
					<button class="btn tip" rel="tooltip" onclick="document.id('search').value='';this.form.submit();" type="button" data-original-title="Clear">
					<i class="icon-remove"></i>
					</button>
					</div>
					<div class="btn-group pull-right hidden-phone">
			<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
					</div>
	</td>
</tr>
</table>
<table class="table table-striped">
<thead>
	<tr>
		<th width="2%">
			<?php echo JText::_( 'Num' ); ?>
		</th>
		<th class="title">
			<?php echo JText::_( 'IP' ); ?>
		</th>
		<th class="title" nowrap="nowrap">
			<?php echo JText::_( 'User Name' ); ?>
		</th>
		<th class="title">
			<?php echo JText::_( 'Code' ); ?>
		</th>
		<th class="title">
			<?php echo JText::_( 'Log' ); ?>
		</th>
		<th class="title">
			<?php echo JText::_( 'Date' ); ?>
		</th>
	</tr>
</thead>
<tfoot>
	<tr>
		<td colspan="13" align="center">
			<?php 
			echo $this->pagination->getListFooter(); ?>
		</td>
	</tr>
</tfoot>
<tbody>
	<?php
	$i=0;$k = 0;
	foreach($this->data as $row){
		$user = JUser::getInstance($row->userid);
	?>
	<tr class="<?php echo "row$k"; ?>">
		<td>
			<?php echo  $this->pagination->getRowOffset( $i ); ?>
		</td>
		<td align="left">
		<span class="bold hasTip" title="<?php echo JText::_('IP Address')."::".JText::_('Click here to view information of this IP address');?>">
			<a class="modal" title="IP INFO"  href="index.php?option=com_jsecure&amp;task=ipinfo&amp;ip=<?php echo $row->ip;?>&amp;tpl=component" rel="{handler: 'iframe', size: {x: 800, y: 500}}">  
    			<?php echo $row->ip; ?>
   			</a>
		</span>	
		</td>	
		<td align="left">
			<?php echo $user->username; ?>
		</td>
		<td align="left">
			<?php echo JText::_($row->code); ?>
		</td>
		<td align="left">
			<?php echo str_replace("\n","<br/>",$row->change_variable); ?>
		</td>
		<td align="left">
			<?php echo str_replace("\n","<br/>",$row->date); ?>
		</td>
	</tr>
	<?php
		$k = 1 - $k;	$i++;
	}
	?>
</tbody>
</table>
<input type="hidden" name="option" value="com_jsecure" />
<input type="hidden" name="task" value="log" />
<input type="hidden" name="boxchecked" value="0" />
</form>