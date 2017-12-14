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

// @var KunenaForumTopic $topic

$topic = $this->topic;
$me = KunenaUserHelper::getMyself();

$this->addScriptDeclaration(
	'// <![CDATA[
var kunena_anonymous_name = "' . JText::_('COM_KUNENA_USERNAME_ANONYMOUS') . '";
// ]]>');

JText::script('COM_KUNENA_RATE_LOGIN');
JText::script('COM_KUNENA_RATE_NOT_YOURSELF');
JText::script('COM_KUNENA_RATE_ALLREADY');
JText::script('COM_KUNENA_RATE_SUCCESSFULLY_SAVED');

JText::script('COM_KUNENA_SOCIAL_EMAIL_LABEL');
JText::script('COM_KUNENA_SOCIAL_TWITTER_LABEL');
JText::script('COM_KUNENA_SOCIAL_FACEBOOK_LABEL');
JText::script('COM_KUNENA_SOCIAL_GOOGLEPLUS_LABEL');
JText::script('COM_KUNENA_SOCIAL_LINKEDIN_LABEL');
JText::script('COM_KUNENA_SOCIAL_PINTEREST_LABEL');
JText::script('COM_KUNENA_SOCIAL_STUMBLEUPON_LABEL');
JText::script('COM_KUNENA_SOCIAL_WHATSAPP_LABEL');

$this->addStyleSheet('assets/css/jquery.atwho.css');

// Load caret.js always before atwho.js script and use it for autocomplete, emojiis...
$this->addScript('assets/js/jquery.caret.js');
$this->addScript('assets/js/jquery.atwho.js');
$this->addScript('assets/js/topic.js');

$this->addStyleSheet('assets/css/rating.css');
$this->addScript('assets/js/krating.js');

$this->addScript('assets/js/rating.js');

$this->ktemplate = KunenaFactory::getTemplate();
$social = $this->ktemplate->params->get('socialshare');
$quick = $this->ktemplate->params->get('quick');
?>

<?php if ($this->category->headerdesc) : ?>
<div id="kforum-head" class="<?php echo isset ($this->category->class_sfx) ? ' kforum-headerdesc' . $this->escape($this->category->class_sfx) : '' ?>">
	<?php echo $this->category->displayField('headerdesc'); ?>
</div>
<?php endif; ?>

<div class="ktopactions">
	<table id="topic-actions">
		<tbody>
		<tr>
			<?php echo $this->subRequest('Topic/Item/Actions')->set('id', $topic->id); ?>

			<td class="klist-pages-all">
				<?php echo $this->subLayout('Widget/Pagination/List')
					->set('pagination', $this->pagination)
					->set('display', true); ?>
			</td>
		</tr>
		</tbody>
	</table>
</div>

<div class="clearfix"></div>

<?php if ($social) : ?>
	<div><?php echo $this->subLayout('Widget/Social'); ?></div>
<?php endif; ?>

<?php
if ($this->ktemplate->params->get('displayModule'))
{
	echo $this->subLayout('Widget/Module')->set('position', 'kunena_topictitle');
}

echo $this->subRequest('Topic/Poll')->set('id', $topic->id);

if ($this->ktemplate->params->get('displayModule'))
{
	echo $this->subLayout('Widget/Module')->set('position', 'kunena_poll');
}
?>

<div class="kblock">
	<div class="kheader">
		<h1 class="topic">
			<?php
			//echo JText::_('COM_KUNENA_TOPIC');
			if ($this->ktemplate->params->get('labels') != 0)
			{
				echo $this->subLayout('Widget/Label')->set('topic', $this->topic)->setLayout('default');
			}
			?>
			<span><?php echo $this->headerText; ?></span>
			<?php echo $this->subLayout('Topic/Item/Rating')->set('category', $this->category)->set('topicid', $topic->id)->set('config', $this->config);?>
		</h1>
	</div>

	<?php
	$count = 1;
	foreach ($this->messages as $id => $message)
	{
		echo $this->subRequest('Topic/Item/Message')
			->set('mesid', $message->id)
			->set('location', $id);

		if ($this->ktemplate->params->get('displayModule'))
		{
			echo $this->subLayout('Widget/Module')
				->set('position', 'kunena_msg_row_' . $count++);
		}
	}

	if ($quick == 2)
	{
		echo $this->subLayout('Message/Edit')
			->set('message', $this->message)
			->setLayout('full');
	}
	?>
</div>

<div class="ktopactions">
	<table id="topic-actions">
		<tbody>
			<tr>
				<?php echo $this->subRequest('Topic/Item/Actions')->set('id', $topic->id); ?>

				<td class="klist-pages-all">
					<?php echo $this->subLayout('Widget/Pagination/List')
						->set('pagination', $this->pagination)
						->set('display', true); ?>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<?php if ($this->ktemplate->params->get('writeaccess')) : ?>
<div><?php echo $this->subLayout('Widget/Writeaccess')->set('id', $topic->id); ?></div>
<?php endif;

if ($this->config->enableforumjump)
{
	echo $this->subLayout('Widget/Forumjump')->set('categorylist', $this->categorylist);
}?>

<div class="pull-right"><?php echo $this->subLayout('Category/Moderators')->set('moderators', $this->category->getModerators(false)); ?></div>

<div class="clearfix"></div>
