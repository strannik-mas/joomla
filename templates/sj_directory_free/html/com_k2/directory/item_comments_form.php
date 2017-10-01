<?php
/**
 * @version    2.7.x
 * @package    K2
 * @author     JoomlaWorks http://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2016 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<!-- Comments Form -->

<?php //if($this->params->get('commentsFormNotes')): ?>
<!-- <p class="itemCommentsFormNotes">
	<?php //if($this->params->get('commentsFormNotesText')): ?>
	<?php //echo nl2br($this->params->get('commentsFormNotesText')); ?>
	<?php //else: ?>
	<?php //echo JText::_('K2_COMMENT_FORM_NOTES') ?>
	<?php // endif; ?>
</p>-->
<?php // endif; ?>
<form action="<?php echo JURI::root(true); ?>/index.php" method="post" id="comment-form" class="form-validate">
	<ul class="list-input row">
		<li class="item-name col-md-4 col-xs-12">
			<input class="inputbox" placeholder="<?php echo JText::_('K2_NAME'); ?>" type="text" name="userName" id="userName" value=""/>
		</li>
		<li class="item-email col-md-4 col-xs-12">
			<input class="inputbox"  placeholder="<?php echo JText::_('K2_EMAIL'); ?>" type="text" name="commentEmail" id="commentEmail" value=""  />
		</li>
		<li class="item-website col-md-4 col-xs-12">
			<input class="inputbox"  placeholder="<?php echo JText::_('K2_WEBSITE_URL'); ?>" type="text" name="commentURL" id="commentURL" value="" />
		</li>
		<li class="item-message col-xs-12">
			<textarea rows="20" cols="10" placeholder="<?php echo JText::_('K2_MESSAGE'); ?>"  class="inputbox"  name="commentText" id="commentText"></textarea>
		</li>
	</ul>
	<?php if($this->params->get('recaptcha') && ($this->user->guest || $this->params->get('recaptchaForRegistered', 1))): ?>
	<?php if(!$this->params->get('recaptchaV2')): ?>
	<label class="formRecaptcha"><?php echo JText::_('K2_ENTER_THE_TWO_WORDS_YOU_SEE_BELOW'); ?></label>
	<?php endif; ?>
	<div id="recaptcha" class="<?php echo $this->recaptchaClass; ?>"></div>
	<?php endif; ?>

	<input type="submit" class="button" id="submitCommentButton" value="<?php echo JText::_('K2_SEND_US'); ?>" />

	<span id="formLog"></span>

	<input type="hidden" name="option" value="com_k2" />
	<input type="hidden" name="view" value="item" />
	<input type="hidden" name="task" value="comment" />
	<input type="hidden" name="itemID" value="<?php echo JRequest::getInt('id'); ?>" />
	<?php echo JHTML::_('form.token'); ?>
</form>
