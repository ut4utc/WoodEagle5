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

/*
  @var KunenaLayout $this */
// @var KunenaForumTopic $topic

$topic = $this->topic;
$category = $topic->getCategory();
$userTopic = $topic->getUserTopic();
$template = KunenaFactory::getTemplate();
$topicPages = $topic->getPagination(null, KunenaConfig::getInstance()->messages_per_page, 3);
$author = $topic->getLastPostAuthor();
$avatar = $author->getAvatarImage($template->params->get('avatarType'), 'list');
$config = KunenaConfig::getInstance();
$cols = empty($this->checkbox) ? 5 : 6;
$txt   = '';

if ($this->topic->ordering)
{
	/** @var TYPE_NAME $this */
	$txt = $this->topic->getCategory()->class_sfx ? $txt . '' : $txt . '-stickymsg';
}

if ($this->topic->hold == 1)
{
	$txt .= 'unapproved';
}
else
{
	/** @var TYPE_NAME $this */
	if ($this->topic->hold)
	{
		$txt .= 'deleted';
	}
}

/** @var TYPE_NAME $this */
if ($this->topic->moved_id > 0)
{
	$txt .= 'moved';
}

if (!empty($this->spacing)) : ?>
<tr class="kcontenttablespacer">
	<td colspan="<?php echo $cols; ?>">&nbsp;</td>
</tr>
<?php endif; ?>

<tr class="krow<?php echo $this->row;?> k<?php echo $this->escape($category->class_sfx) . $txt;?>">
	<td class="kcol-first kcol-ktopicreplies hidden-phone">
		<strong><?php echo $this->formatLargeNumber ( max(0,$this->topic->getTotal()-1) ); ?></strong> <?php echo JText::_('COM_KUNENA_GEN_REPLIES') ?>
	</td>
	<?php if ($topic->unread) : ?>
		<td class="kcol-mid kcol-ktopicicon hidden-phone">
		<?php echo $this->getTopicLink($topic, 'unread', $topic->getIcon($topic->getCategory()->iconset), $this->escape($topic->subject),'hasTooltip', $category, true, true); ?>
	<?php else :  ?>
	<td class="kcol-mid kcol-ktopicicon hidden-phone">
		<?php echo $this->getTopicLink($topic, null, $topic->getIcon($topic-> getCategory()->iconset), $this->escape($topic->subject), 'hasTooltip', $category, true, false); ?>
		<?php endif;?>
	</td>
	<td class="kcol-mid kcol-ktopictitle">
		<div class="krow">
			<?php
			if ($template->params->get('labels') != 0)
			{
				echo $this->subLayout('Widget/Label')->set('topic', $this->topic)->setLayout('default');
			}

			if ($topic->unread)
			{
				echo $this->getTopicLink($topic, 'unread', $this->escape($topic->subject) . '<sup class="knewchar" dir="ltr">(' . (int) $topic->unread .
					' ' . JText::_('COM_KUNENA_A_GEN_NEWCHAR') . ')</sup>', null, 'hasTooltip', $category, true, true);
			}
			else
			{
				echo $this->getTopicLink($topic, null, null, null, 'hasTooltip topictitle', $category, true, false);
			}
			?>
			<?php echo $this->subLayout('Widget/Rating')->set('config', $config)->set('category', $category)->set('topic', $this->topic)->setLayout('default'); ?>
		</div>
		<div class="pull-right">
			<?php if ($userTopic->favorite) : ?>
				<span data-toggle="tooltip" title="<?php echo JText::_('COM_KUNENA_FAVORITE'); ?>"><?php echo KunenaIcons::star(); ?></span>
			<?php endif; ?>

			<?php if ($userTopic->posts) : ?>
				<span data-toggle="tooltip" title="<?php echo JText::_('COM_KUNENA_MYPOSTS'); ?>"><?php echo KunenaIcons::flag(); ?></span>
			<?php endif; ?>

			<?php if ($this->topic->attachments) : ?>
				<span data-toggle="tooltip" title="<?php echo JText::_('COM_KUNENA_ATTACH'); ?>"><?php echo KunenaIcons::attach(); ?></span>
			<?php endif; ?>

			<?php if ($this->topic->poll_id && $category->allow_polls) : ?>
				<span data-toggle="tooltip" title="<?php echo JText::_('COM_KUNENA_ADMIN_POLLS'); ?>"><?php echo KunenaIcons::poll(); ?></span>
			<?php endif; ?>
		</div>

		<div class="hidden-phone">
			<?php echo JText::_('COM_KUNENA_TOPIC_STARTED_ON')?>,
			<?php echo $topic->getFirstPostTime()->toKunena('config_post_dateformat'); ?>,
			<?php echo JText::_('COM_KUNENA_BY') ?>
			<?php echo $topic->getAuthor()->getLink(null, null, '', '', null, $category->id); ?>
			<div class="pull-right">
				<?php /** TODO: New Feature - LABELS
				<span class="label label-info">
				<?php echo JText::_('COM_KUNENA_TOPIC_ROW_TABLE_LABEL_QUESTION'); ?>
				</span>	*/ ?>
				<?php if ($topic->locked != 0) : ?>
					<span class="label label-important">
						<?php echo KunenaIcons::lock(); ?> <?php echo JText::_('COM_KUNENA_LOCKED'); ?>
					</span>
				<?php endif; ?>
			</div>
		</div>

		<div class="visible-phone">
			<?php echo JText::_('COM_KUNENA_GEN_LAST_POST')?>
			<?php echo  $topic->getLastPostTime()->toKunena('config_post_dateformat'); ?> <br>
			<?php echo JText::_('COM_KUNENA_BY') . ' ' . $this->topic->getLastPostAuthor()->getLink();?>
			<div class="pull-right">
				<?php /** TODO: New Feature - LABELS
				<span class="label label-info">
				<?php echo JText::_('COM_KUNENA_TOPIC_ROW_TABLE_LABEL_QUESTION'); ?>
				</span>	*/ ?>
				<?php if ($topic->locked != 0) : ?>
					<span class="label label-important">
						<?php echo KunenaIcons::lock(); ?> <?php echo JText::_('COM_KUNENA_LOCKED'); ?>
					</span>
				<?php endif; ?>
			</div>
		</div>

		<div class="pull-left">
			<?php echo $this->subLayout('Widget/Pagination/List')->set('pagination', $topicPages)->setLayout('simple'); ?>
		</div>
	</td>

	<td class="kcol-mid kcol-ktopicviews hidden-phone">
		<span class="ktopic-views-number"><?php echo $this->formatLargeNumber ( $this->topic->hits );?></span>
		<span class="ktopic-views"> <?php echo JText::_('COM_KUNENA_GEN_HITS');?> </span>
	</td>

	<td class="kcol-mid kcol-ktopiclastpost">
		<div class="klatest-post-info">
			<?php if ($config->avataroncat) : ?>
				<span class="ktopic-latest-post-avatar hidden-phone">
					<?php echo $author->getLink($avatar, null, '', '', null, $category->id); ?>
				</span>
			<?php endif; ?>
			<span class="ktopic-latest-post"><?php echo $this->getTopicLink($this->topic, 'last', JText::_('COM_KUNENA_GEN_LAST_POST'), null, 'hasTooltip', $category, false, true); ?>
				<?php echo ' ' . JText::_('COM_KUNENA_BY') . ' ' . $this->topic->getLastPostAuthor()->getLink(null, null, '', '', '', $category->id);?>
					</span>
			<br>
			<span class="ktopic-date"><?php echo $topic->getLastPostTime()->toKunena('config_post_dateformat'); ?></span>
		</div>
	</td>

	<?php if (!empty($this->checkbox)) : ?>
		<td class="kcol-mid center">
			<label>
				<input class="kcheck" type="checkbox" name="topics[<?php echo $topic->displayField('id'); ?>]" value="1" />
			</label>
		</td>
	<?php endif; ?>
</tr>
