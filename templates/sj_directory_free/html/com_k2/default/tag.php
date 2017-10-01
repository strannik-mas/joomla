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
// includes placehold
$yt_temp = JFactory::getApplication()->getTemplate();
include (JPATH_BASE . '/templates/'.$yt_temp.'/includes/placehold.php');
?>

<!-- Start K2 Tag Layout -->
<div id="k2Container" class="itemListView <?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if($this->params->get('tagFeedIcon',1)): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if(count($this->items)): ?>
	<div class="itemList row">
		<?php foreach($this->items as $item): ?>

		<!-- Start K2 Item Layout -->
		<div class="itemContainer col-md-6 col-xs-12">
			<div class="catItemView grid">
				<?php if($item->params->get('tagItemImage',1) ): ?>
				<div class="catItemImageBlock">
						<?php if(!empty($item->imageGeneric)){ ?>
						<a class="img" href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
							<?php 
								//Create placeholder items images
							
								$src = $item->imageGeneric;
								if (!empty( $src)) {?>								
									<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" />
								<?php } else if ($is_placehold) {					
									$thumb_img = yt_placehold($placehold_size['listing'],$this->item->title,$this->item->title);
									echo $thumb_img;
								}	
								
							?>
						</a>
						<?php } else{ ?>
							<a class="img"  href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
								<?php 
									//Create placeholder items images
									$thumb_img = yt_placehold($placehold_size['listing'],$item->title,$item->title);
									echo $thumb_img;
								?>
							</a>
						<?php } ?>
				</div>
				 <?php endif; ?>
				
				<div class="main-item">
					<div class="catItemHeader">
						<?php if($item->params->get('tagItemTitle',1)): ?>
						<!-- Item title -->
						<h3 class="catItemTitle">
							<?php if ($item->params->get('tagItemTitleLinked',1)): ?>
							<a href="<?php echo $item->link; ?>">
								<?php echo $item->title; ?>
							</a>
							<?php else: ?>
							<?php echo $item->title; ?>
							<?php endif; ?>
						</h3>
						<?php endif; ?>
							
					</div>
					
					<div class="catItemBody">
						<ul class="catToolbar">
							<?php if($item->params->get('tagItemDateCreated',1)): ?>
							  <li class="catItemDateCreated">
								  <?php echo JHTML::_('date', $item->created , JText::_('F d, Y')); ?>
							 </li>
							<?php endif; ?>
							<?php if($item->params->get('tagItemCategory')): ?>
							<li>
								<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
							</li>
							<?php endif; ?>						
						</ul>
			
						<div class="clr"></div>
						
						<?php if($item->params->get('tagItemExtraFields',0) && count($item->extra_fields)): ?>
						<!-- Item extra fields -->
						<div class="tagItemExtraFields">
						  <h4><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
						  <ul>
							  <?php foreach ($item->extra_fields as $key=>$extraField): ?>
							  <?php if($extraField->value != ''): ?>
							  <li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
								  <?php if($extraField->type == 'header'): ?>
								  <h4 class="tagItemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
								  <?php else: ?>
								  <span class="tagItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
								  <span class="tagItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
								  <?php endif; ?>
							  </li>
							  <?php endif; ?>
							  <?php endforeach; ?>
							  </ul>
						  <div class="clr"></div>
						</div>
						<?php endif; ?>
						<?php if($item->params->get('tagItemIntroText',1)): ?>
						<div class="catItemIntroText">
							<!-- Item introtext -->
							<p>
							  <?php echo $item->introtext; ?>
							</p>
						</div>
						<?php endif; ?>
						<?php if ($item->params->get('tagItemReadMore')): ?>
						<a class="read-more" href="<?php echo $item->link; ?>" title="<?php echo JText::_('READ_MORE_K2'); ?>"><?php echo JText::_('READ_MORE_K2'); ?></a>
						<?php endif; ?>
						
					</div>
				</div>
				<div class="clr"></div>
			</div>
		</div>
		<!-- End K2 Item Layout -->

		<?php endforeach; ?>
	</div>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="k2Pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<div class="clr"></div>
		<?php echo $this->pagination->getPagesCounter(); ?>
	</div>
	<?php endif; ?>

	<?php endif; ?>

</div>
<!-- End K2 Tag Layout -->
