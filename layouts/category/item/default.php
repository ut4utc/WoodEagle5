<?php
/**
 * Kunena Component
 *
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Category
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

$categoryActions = $this->getCategoryActions();
$cols            = empty($this->checkbox) ? 7 : 6;
$this->addStyleSheet('assets/css/rating.css');
?>
<br />
<?php if (!$this->category->isSection()) : ?>
	<?php if ($this->category->headerdesc) : ?>
		<div class="kblock" id="kcatheader">
			<div class="kheader">
				<div class="close" data-toggle="collapse" data-target="#kfrontstats_tbody">&times;</div>
				<h2><span><?php echo JText::_('COM_KUNENA_FORUM_HEADER'); ?></span></h2>
			</div>
			<div class="collapse in" id="kfrontstats_tbody">
				<div class="kbody">
					<div class="kfheadercontent">
						<?php echo $this->category->displayField('headerdesc'); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

<table class="klist-actions">
	<tr class="topic-list-tr">
		<td class="klist-actions-goto">
			<a id="forumtop"> </a>
			<a class="kbuttongoto" href="#forumbottom" rel="nofollow"><?php echo $this->getIcon ( 'kforumbottom', JText::_('COM_KUNENA_GEN_GOTOBOTTOM') ) ?></a>
		</td>
		<?php if ($categoryActions) : ?>
			<td class="klist-actions-forum"><?php echo implode($categoryActions); ?></td>
		<?php endif; ?>
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
		<h2><span><?php echo $this->escape($this->headerText); ?></span></h2>
	</div>
	<div class="kcontainer">
		<div class="kbody">
<?php endif; ?>

<?php if ($this->category->isSection()) : ?>
	<div>
		<div class="kcontainer">
			<div class="kbody">
<?php endif; ?>

<?php if (!$this->category->isSection()) : ?>

<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena'); ?>" method="post" id="ktopicsform">
	<input type="hidden" name="view" value="topics" />
	<?php echo JHtml::_('form.token'); ?>
	<?php if ($this->topics) : ?>
	<table class="kblocktable" id="kflattable">
		<?php endif; ?>
		<?php
			/** @var KunenaForumTopic $previous */
			$previous = null;
			$kcount = 0;

			foreach ($this->topics as $position => $topic)
			{
				$count = $kcount++ %2 ? 1 : 2;

				echo $this->subLayout('Topic/Row')
					->set('topic', $topic)
					->set('row', $count)
					->set('spacing', $previous && $previous->ordering != $topic->ordering)
					->set('position', 'kunena_topic_' . $position)
					->set('checkbox', !empty($this->topicActions))
					->setLayout('category');
				$previous = $topic;
			}
		?>
		<?php endif; ?>
		<?php if ($this->topics) : ?>
			<tr class="topic-list-tr">
				<td class="klist-actions-goto center" colspan="1">
					<a id="forumbottom"> </a>
					<a class="kbuttongoto" href="#forumtop" rel="nofollow"><?php echo $this->getIcon ( 'kforumtop', JText::_('COM_KUNENA_GEN_GOTOTOP') ) ?></a>
				</td>
				<td colspan="6" class="hidden-phone">
					<div class="input-append">

						<?php if (!empty($this->moreUri))
						{
							echo JHtml::_(
								'kunenaforum.link', $this->moreUri,
								JText::_('COM_KUNENA_MORE'), null, null, 'follow');
						} ?>

						<?php if (!empty($this->topicActions)) : ?>
							<?php echo JHtml::_(
								'select.genericlist', $this->topicActions, 'task',
								'class="inputbox kchecktask"', 'value', 'text', 0, 'kchecktask'); ?>

							<?php if ($this->actionMove) : ?>
								<?php
								$options = array(JHtml::_('select.option', '0', JText::_('COM_KUNENA_BULK_CHOOSE_DESTINATION')));
								echo JHtml::_(
									'kunenaforum.categorylist', 'target', 0, $options, array(),
									' disabled="disabled"', 'value', 'text', 0,
									'kchecktarget'
								);
								?>
								<button class="btn" name="kcheckgo" type="submit"><?php echo JText::_('COM_KUNENA_GO') ?></button>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</td>
			</tr>
		<?php endif; ?>
	</table>
</form>
		</div>
	</div>
</div>

<?php if ($this->topics) : ?>
	<div class="pull-left">
		<?php echo $this->subLayout('Widget/Pagination/List')
	->set('pagination', $this->pagination)
	->set('display', true); ?>
	</div>
<?php endif; ?>
<div class="clearfix"></div>

<?php if (!empty($this->moderators))
{
	echo $this->subLayout('Category/Moderators')
		->set('moderators', $this->moderators);
}
?>

<?php if ($this->ktemplate->params->get('writeaccess')) : ?>
<div><?php echo $this->subLayout('Widget/Writeaccess')->set('id', $this->category->id); ?></div>
<?php endif; ?>
