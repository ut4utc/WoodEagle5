<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Topic
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

$cols = !empty($this->actions) ? 6 : 5;
$view = JFactory::getApplication()->input->getWord('view');
$this->ktemplate = KunenaFactory::getTemplate();
$statistics = KunenaForumStatistics::getInstance();
$statistics->loadGeneral();
$this->addStyleSheet('assets/css/rating.css');
$kcount = 0;

?>
<table class="klist-actions">
	<tr>
		<td class="klist-actions-info-all">
			<strong><?php echo (int) $statistics->topicCount; ?></strong>
			<?php echo JText::_('COM_KUNENA_TOPICS')?>
		</td>

		<td class="klist-times-all">
			<form action="<?php echo $this->escape(JUri::getInstance()->toString());?>" id="timeselect" name="timeselect" method="post" target="_self">
				<?php $this->displayTimeFilter('sel', 'class="inputboxusl" onchange="this.form.submit()" size="1"') ?>
			</form>
		</td>

		<td class="klist-jump-all hidden-phone"><?php
			if ($this->config->enableforumjump && !$this->embedded  && $this->topics)
			{
				echo $this->subLayout('Widget/Forumjump')->set('categorylist', $this->categorylist);
			} ?></td>

		<td class="klist-pages-all"><?php echo $this->subLayout('Widget/Pagination/List')
				->set('pagination', $this->pagination->setDisplayedPages(5))
				->set('display', true); ?></td>
	</tr>
</table>

<div class="kblock kflat">
	<div class="kheader">
		<?php if (!empty($this->topicActions)) : ?>
			<span class="kcheckbox select-toggle"><input class="kcheckall" type="checkbox" name="toggle" value="" /></span>
		<?php endif; ?>
		<h1><span><?php echo $this->escape($this->headerText); ?></span></h1>
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

						<?php if (!empty($this->actions)) : ?>
						<tr class="topic-list-tr">
							<td class="kcol krowmoderation" colspan="<?php echo $cols; ?>">

								<?php if (!empty($this->actions) || !empty($this->moreUri)) : ?>
									<div class="input-append">
										<?php if (!empty($this->topics) && !empty($this->moreUri)) { echo JHtml::_('kunenaforum.link', $this->moreUri, JText::_('COM_KUNENA_MORE'), null, 'btn btn-primary', 'follow'); } ?>
										<?php if (!empty($this->actions)) : ?>
											<?php echo JHtml::_('select.genericlist', $this->actions, 'task', 'class="inputbox kchecktask" ', 'value', 'text', 0, 'kchecktask'); ?>
											<?php if (isset($this->actions['move'])) :
												$options = array (JHtml::_('select.option', '0', JText::_('COM_KUNENA_BULK_CHOOSE_DESTINATION')));
												echo JHtml::_('kunenaforum.categorylist', 'target', 0, $options, array(), 'class="inputbox fbs" disabled="disabled"', 'value', 'text', 0, 'kchecktarget');
											endif;?>
											<input type="submit" name="kcheckgo" class="kbutton" value="<?php echo JText::_('COM_KUNENA_GO') ?>" />
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</form>
		</div>
	</div>

</div>


<div class="pull-left">
	<?php echo $this->subLayout('Widget/Pagination/List')
	->set('pagination', $this->pagination->setDisplayedPages(4))
	->set('display', true); ?>
</div>

<div class="clearfix"></div>

