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

$options = $this->getOptions();
JHtml::_('behavior.core');
?>

<div class="kblock" id="announcements-list">
	<div class="kheader">
		<h2>
			<?php echo JText::_('COM_KUNENA_ANN_ANNOUNCEMENTS'); ?>

			<?php if (!empty($options)) : ?>
				<div class="input-append pull-right">
					<?php echo JHtml::_('select.genericlist', $options, 'task', '', 'value', 'text', 0, 'kchecktask'); ?>
					<input type="submit" name="kcheckgo" class="btn" value="<?php echo JText::_('COM_KUNENA_GO') ?>" />
					<a class="btn"
					   href="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=announcement&layout=create'); ?>">
						<?php echo JText::_('COM_KUNENA_ANNOUNCEMENT_ACTIONS_LABEL_ADD'); ?>
					</a>
				</div>
			<?php endif; ?>
		</h2>
	</div>
	<div class="kcontainer">
		<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=announcement'); ?>" method="post"
		      id="adminForm" name="adminForm">
			<input type="hidden" name="boxchecked" value="0" />
			<?php echo JHtml::_('form.token'); ?>

			<table class="kannouncement">
				<tbody id="kannouncement_body">
				<tr class="ksth">
					<th class="kcol-anndate">
						<?php echo JText::_('COM_KUNENA_ANN_DATE'); ?>
					</th>
					<th class="kcol-anntitle">
						<?php echo JText::_('COM_KUNENA_ANN_TITLE'); ?>
					</th>

					<?php if ($options) : ?>
						<th class="kcol-annpublish">
							<?php echo JText::_('COM_KUNENA_ANN_PUBLISH'); ?>
						</th>
						<th class="kcol-annedit">
							<?php echo JText::_('COM_KUNENA_ANN_EDIT'); ?>
						</th>
						<th class="kcol-anndelete">
							<?php echo JText::_('COM_KUNENA_ANN_DELETE'); ?>
						</th>
						<th class="kcol-author">
							<?php echo JText::_('COM_KUNENA_ANNOUNCEMENT_AUTHOR'); ?>
						</th>
					<?php endif; ?>

					<th class="kcol-annid">
						<?php echo JText::_('COM_KUNENA_ANN_ID'); ?>
					</th>

					<?php if ($options) : ?>
						<th class="kcol-annid">
							<input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
						</th>
					<?php endif; ?>

				</tr>
				</thead>

				<?php if ($this->pagination->pagesTotal > 1) : ?>
					<tfoot>
					<tr>
						<td colspan="<?php echo $options ? 8 : 3; ?>">
							<div class="pull-right">
								<?php echo $this->subLayout('Widget/Pagination/List')->set('pagination', $this->pagination); ?>
							</div>
						</td>
					</tr>
					</tfoot>
				<?php endif; ?>

				<tbody>
				<?php foreach ($this->announcements as $row => $announcement) {
					echo $this->subLayout('Announcement/List/Row')
						->set('announcement', $announcement)
						->set('row', $row)
						->set('checkbox', !empty($options)); }
				?>
				</tbody>
			</table>
		</form>
	</div>
</div>
