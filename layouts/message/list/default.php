<?php
/**
 * Kunena Component
 *
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Message
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

$colspan = !empty($this->actions) ? 4 : 3;
$cols    = empty($this->checkbox) ? 4 : 5;
$view = JFactory::getApplication()->input->getWord('view');
$this->ktemplate = KunenaFactory::getTemplate();
$kcount  = 0;

?>
<?php if ($view != 'user') : ?>
<div class="kblock">
	<div class="kheader">
        <h1>
            <?php echo $this->escape($this->headerText); ?>
            <small class="hidden-sm">
                (<?php echo JText::sprintf('COM_KUNENA_X_MESSAGES_MORE', $this->formatLargeNumber($this->pagination->total)); ?>)
            </small>

            <?php // ToDo:: <span class="badge badge-success"> <?php echo $this->topics->count->unread; ?/></span> ?>
        </h1>

		<h2 class="filter-time pull-right">
			<div class="filter-sel">
				<form action="<?php echo $this->escape(JUri::getInstance()->toString()); ?>" id="timeselect" name="timeselect"
					method="post" target="_self" class="form-inline hidden-phone">
					<div>
						<?php $this->displayTimeFilter('sel'); ?>
					</div>
				</form>
			</div>
		</h2>
	</div>
</div>

<div class="pull-right">
	<?php echo $this->subLayout('Widget/Search')
	->set('catid', 'all')
	->setLayout('topic'); ?>
</div>
<?php endif; ?>

<div class="pull-left">
	<?php echo $this->subLayout('Widget/Pagination/List')
		->set('pagination', $this->pagination->setDisplayedPages(4))
		->set('display', true); ?>
</div>

<div class="kblock kflat">
	<div class="kheader">
		<?php if (!empty($this->topicActions)) : ?>
			<span class="kcheckbox select-toggle"><input class="kcheckall" type="checkbox" name="toggle" value="" /></span>
		<?php endif; ?>
		<h2><span><?php echo $this->escape($this->headerText); ?></span></h2>
	</div>
	<div class="kcontainer">
		<div class="kbody">
			<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=topics'); ?>" method="post" name="ktopicsform" id="ktopicsform">
				<?php echo JHtml::_('form.token'); ?>
				<table class="kblocktable" id="kflattable">

					<tbody>
					<?php if (empty($this->topics) && empty($this->subcategories)) : ?>
						<tr class="krow1">
							<td colspan="4" class="center"><?php echo JText::_('COM_KUNENA_VIEW_NO_TOPICS') ?></td>
						</tr>
					<?php else : ?>
						<?php $counter = 2; ?>

						<?php foreach ($this->topics as $i => $topic)
						{
							$count = $kcount++ %2 ? 1 : 2;
							echo $this->subLayout('Topic/Row')
								->set('topic', $topic)
								->set('row', $count)
								->set('position', 'kunena_topic_' . $i)
								->set('checkbox', !empty($this->actions));

							if ($this->ktemplate->params->get('displayModule'))
							{
								echo $this->subLayout('Widget/Module')
									->set('position', 'kunena_topic_' . $counter++)
									->set('cols', $cols)
									->setLayout('table_row');
							}
						} ?>
					<?php endif; ?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>

<div class="pagination pull-left">
	<?php echo $this->subLayout('Widget/Pagination/List')->set('pagination', $this->pagination->setDisplayedPages(4))->set('display', true); ?>
</div>

<?php if ($view != 'user') : ?>
<form action="<?php echo $this->escape(JUri::getInstance()->toString()); ?>" id="timeselect" name="timeselect"
	method="post" target="_self" class="timefilter pull-right">
	<?php $this->displayTimeFilter('sel'); ?>
</form>
<?php endif; ?>

<div class="clearfix"></div>
