<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Message
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

/*
  @var KunenaLayout $this */
// @var KunenaForumMessage $message
$this->addStyleSheet('assets/css/rating.css');

$message = $this->message;
$author = $message->getAuthor();
$topic = $message->getTopic();
$category = $message->getCategory();
$isReply = $message->id != $topic->first_post_id;
$category = $message->getCategory();
$avatar = $topic->getLastPostAuthor()->getAvatarImage(KunenaFactory::getTemplate()->params->get('avatarType'), 'posts');
$config = KunenaFactory::getConfig();
$cols = empty($this->checkbox) ? 5 : 6;
$txt   = '';
$userTopic = $topic->getUserTopic();


if ($topic->ordering)
{
	if ($topic->getCategory()->class_sfx)
	{
		$txt .= '';
	}
	else
	{
		$txt .= '-stickymsg';
	}
}

if ($topic->hold == 1 || $message->hold == 1)
{
	$txt .= ' ' . 'unapproved';
}
else
{
	if ($topic->hold)
	{
		$txt .= ' ' . 'deleted';
	}
}

if ($topic->moved_id > 0)
{
	$txt .= ' ' . 'moved';
}
?>

<tr class="category<?php echo $this->escape($category->class_sfx) . $txt; ?>">
	<?php if ($topic->unread) : ?>
	<td class="hidden-phone span1 center topic-item-unread">
		<?php echo $this->getTopicLink($topic, 'unread', $topic->getIcon($topic->getCategory()->iconset), $this->escape($message->message), 'hasTooltip', $category, true, true); ?>
	<?php else :  ?>
	<td class="hidden-phone span1 center">
		<?php echo $this->getTopicLink($topic, $this->message, $topic->getIcon($topic->getCategory()->iconset), $this->escape($message->message), 'hasTooltip', $category, true, false); ?>
	<?php endif;?>
	</td>
	<td class="span<?php echo $cols?>">
		<div class="krow">
			<?php
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
			<div class="pull-right"><?php echo $this->subLayout('Widget/Rating')->set('config', $config)->set('category', $category)->set('topic', $topic)->setLayout('default'); ?></div>
		</div>
		<div class="pull-right">
			<?php if ($userTopic->favorite) : ?>
				<span data-toggle="tooltip" title="<?php echo JText::_('COM_KUNENA_FAVORITE'); ?>"><?php echo KunenaIcons::star(); ?></span>
			<?php endif; ?>

			<?php if ($userTopic->posts) : ?>
				<span data-toggle="tooltip" title="<?php echo JText::_('COM_KUNENA_MYPOSTS'); ?>"><?php echo KunenaIcons::flag(); ?></span>
			<?php endif; ?>

			<?php if ($topic->attachments) : ?>
				<span data-toggle="tooltip" title="<?php echo JText::_('COM_KUNENA_ATTACH'); ?>"><?php echo KunenaIcons::attach(); ?></span>
			<?php endif; ?>

			<?php if ($topic->poll_id) : ?>
				<span data-toggle="tooltip" title="<?php echo JText::_('COM_KUNENA_ADMIN_POLLS'); ?>"><?php echo KunenaIcons::poll(); ?></span>
			<?php endif; ?>
		</div>
		<div class="hidden-phone">
			<?php echo $topic->getAuthor()->getLink(null, null, '', '', null, $category->id); ?>,
			<?php echo $topic->getFirstPostTime()->toKunena('config_post_dateformat'); ?> <br />
			<?php echo JText::sprintf('COM_KUNENA_CATEGORY_X', $this->getCategoryLink($topic->getCategory(),null, null,'hasTooltip')); ?>
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
	</td>
	<td class="span2 hidden-phone">
		<div class="replies"><?php echo JText::_('COM_KUNENA_GEN_REPLIES'); ?>:<span class="repliesnum"><?php echo $this->formatLargeNumber($topic->getReplies()); ?></span></div>
		<div class="views"><?php echo JText::_('COM_KUNENA_GEN_HITS');?>:<span class="viewsnum"><?php echo  $this->formatLargeNumber($topic->hits); ?></span></div>
	</td>
	<td class="span2">
		<div class="container-fluid">
			<div class="row-fluid">
			<?php if ($config->avataroncat) : ?>
				<div class="span3">
					<?php echo $avatar; ?>
				</div>
			<?php endif; ?>
				<div class="span9">
					<span>
						<?php echo $this->getTopicLink($topic, 'last', JText::_('COM_KUNENA_GEN_LAST_POST'), null, 'hasTooltip', $category, true, true); ?>
						<?php echo ' ' . JText::_('COM_KUNENA_BY') . ' ' . $topic->getLastPostAuthor()->getLink(null, null, '', '', null, $category->id);?>
					</span>
					<br />
					<span><?php echo $topic->getLastPostTime()->toKunena('config_post_dateformat'); ?></span>
				</div>
			</div>
		</div>
	</td>

	<?php if (!empty($this->checkbox)) : ?>
		<td class="span1 center">
			<input class ="kcheck" type="checkbox" name="posts[<?php echo $message->id?>]" value="1" />
		</td>
	<?php endif; ?>

	<?php
	if (!empty($this->position)) {
		echo $this->subLayout('Widget/Module')
			->set('position', $this->position)
			->set('cols', $cols)
			->setLayout('table_row'); }
	?>
</tr>
