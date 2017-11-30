<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Widget
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

?>
<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_announcement'); ?>
<div class="kblock kannouncement" id="announcement<?php echo $this->announcement->id; ?>">
	<div class="kheader">
		<div class="close" data-toggle="collapse" data-target="#kannouncement">&times;</div>
		<h2>
			<a class="btn-link" href="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=announcement&layout=list'); ?>" title="<?php echo JText::_('COM_KUNENA_VIEW_COMMON_ANNOUNCE_LIST')?>">
				<?php echo $this->announcement->displayField('title');?>
			</a>
		</h2>
	</div>
	<div class="collapse in" id="kannouncement">
		<div class="kbody">
			<div class="kanndesc">
				<?php if ($this->announcement->showdate) : ?>
					<div class="anncreated">
						<?php echo $this->announcement->displayField('created', 'date_today'); ?>
					</div>
				<?php endif; ?>
				<div class="anndesc">
					<?php echo $this->announcement->displayField('sdescription'); ?>
					<?php if (!empty($this->announcement->description)) : ?>
						<br />
						<a class="btn-link" href="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=announcement&layout=default&id=' . $this->announcement->id); ?>" title="<?php echo  $this->announcement->displayField('title')?>">
							<?php echo JText::_('COM_KUNENA_ANN_READMORE');?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

