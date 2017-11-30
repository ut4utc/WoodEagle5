<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Announcement
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

$announcement = $this->announcement;
$actions = $this->getActions();
?>
<div class="kblock kannouncement">
	<div class="kheader">
		<h2>
			<?php echo $announcement->displayField('title'); ?>
		</h2>
	</div>
	<div class="kcontainer">
		<?php if (!empty($actions)) : ?>
			<div class="kactions">
				<?php echo implode(' ', $actions); ?>
			</div>
		<?php endif; ?>

		<div class="kbody">
			<div class="kanndesc">
				<div class=""><?php if ($this->announcement->showdate) : ?>
					<small title="<?php echo $announcement->displayField('created', 'ago'); ?>">
						<?php echo $announcement->displayField('created', 'date_today'); ?>
					</small>
					<?php endif; ?>
				</div>
				<div class="anndesc">
					<div><?php echo $announcement->displayField('sdescription'); ?></div>
					<div><?php echo $announcement->displayField('description'); ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

