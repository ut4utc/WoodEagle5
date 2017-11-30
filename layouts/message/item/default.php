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

// @var KunenaForumMessage $message
$category = $this->message->getCategory();
$message = $this->message;
$isReply = $this->message->id != $this->topic->first_post_id;
$signature = $this->profile->getSignature();
$attachments = $message->getAttachments();
$attachs = $message->getNbAttachments();
$avatarname = $this->profile->getname();
$config = KunenaConfig::getInstance();
$subjectlengthmessage = $this->ktemplate->params->get('SubjectLengthMessage', 20);
$me = KunenaUserHelper::getMyself();

if ($config->ordering_system == 'mesid')
{
	$this->numLink = $this->location;
}
else
{
	$this->numLink = $message->replynum;
}

$list = array();
?>

<div class="kmsgbody">
	<div class="kmsgtext">
		<?php echo KunenaHtmlParser::parseBBCode ($message->message, $this) ?>
	</div>
</div>
<?php if (!empty($attachments)) : ?>
	<div class="kmsgattach">
		<?php echo JText::_('COM_KUNENA_ATTACHMENTS');?>
		<ul class="kfile-attach">
			<?php foreach($attachments as $attachment) : ?>
				<li>
					<?php echo $attachment->getThumbnailLink(); ?>
					<span>
					<?php echo $attachment->getTextLink(); ?>
				</span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php elseif ($attachs->total > 0  && !$this->me->exists()):
	if ($attachs->image > 0  && !$this->config->showimgforguest)
	{
		if ( $attachs->image > 1 )
		{
			echo KunenaLayout::factory('BBCode/Image')->set('title', JText::_('COM_KUNENA_SHOWIMGFORGUEST_HIDEIMG_MULTIPLES'))->setLayout('unauthorised');
		}
		else
		{
			echo KunenaLayout::factory('BBCode/Image')->set('title', JText::_('COM_KUNENA_SHOWIMGFORGUEST_HIDEIMG_SIMPLE'))->setLayout('unauthorised');
		}
	}

	if ($attachs->file > 0 && !$this->config->showfileforguest)
	{
		if ( $attachs->file > 1)
		{
			echo KunenaLayout::factory('BBCode/Image')->set('title', JText::_('COM_KUNENA_SHOWIMGFORGUEST_HIDEFILE_MULTIPLES'))->setLayout('unauthorised');
		}
		else
		{
			echo KunenaLayout::factory('BBCode/Image')->set('title', JText::_('COM_KUNENA_SHOWIMGFORGUEST_HIDEFILE_SIMPLE'))->setLayout('unauthorised');
		}
	}
endif; ?>

<div id="kreply<?php echo intval($message->id) ?>_form" class="kreply-form" style="display: none">
	<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena') ?>" method="post" name="postform" enctype="multipart/form-data">
		<input type="hidden" name="view" value="topic" />
		<input type="hidden" name="task" value="post" />
		<input type="hidden" name="parentid" value="<?php echo intval($message->id) ?>" />
		<input type="hidden" name="catid" value="<?php echo intval($category->id) ?>" />
		<?php echo JHtml::_( 'form.token' ) ?>

		<?php if ($this->me->exists() && $category->allow_anonymous): ?>
			<input type="text" name="authorname" size="35" class="kinputbox postinput" maxlength="35" value="<?php echo $this->escape($this->profile->getName()) ?>" /><br />
			<input type="checkbox" id="kanonymous<?php echo intval($message->id) ?>" name="anonymous" value="1" class="kinputbox postinput" <?php if ($category->post_anonymous) echo 'checked="checked"'; ?> /> <label for="kanonymous<?php echo intval($message->id) ?>"><?php echo JText::_('COM_KUNENA_POST_AS_ANONYMOUS_DESC') ?></label><br />
		<?php else: ?>
			<input type="hidden" name="authorname" value="<?php echo $this->escape($me->name) ?>" />
		<?php endif; ?>
		<?php if ($config->askemail && !KunenaFactory::getUser()->id): ?>
			<input type="text" id="email" name="email" size="35" placeholder="<?php echo JText::_('COM_KUNENA_TOPIC_EDIT_PLACEHOLDER_EMAIL') ?>" class="inputbox" maxlength="35" value="" required />
			<?php echo $config->showemail == '0' ? JText::_('COM_KUNENA_POST_EMAIL_NEVER') : JText::_('COM_KUNENA_POST_EMAIL_REGISTERED'); ?>
		<?php endif; ?>
		<input type="text" name="subject" size="35" class="inputbox" maxlength="<?php echo intval($config->maxsubject); ?>" value="<?php echo  $this->escape($message->subject) ?>" /><br />
		<textarea class="inputbox" name="message" rows="6" cols="60"></textarea><br />
				<input style="float: left; margin-right: 10px;" type="checkbox" name="subscribeMe" id="subscribeMe" value="1" <?php if ($config->subscriptionschecked == 1 && $me->canSubscribe != 0 || $config->subscriptionschecked == 0 && $me->canSubscribe == 1 )
				{
					echo 'checked="checked"';
				} ?> />
			<i><?php echo JText::_('COM_KUNENA_POST_NOTIFIED'); ?></i>
			<br />
		<?php if (!$config->allow_change_subject): ?>
			<input type="hidden" name="subject" value="<?php echo $this->escape($message->subject); ?>" />
		<?php endif; ?>
		<input type="submit" class="kbutton kreply-submit" name="submit" value="<?php echo JText::_('COM_KUNENA_SUBMIT') ?>" title="<?php echo (JText::_('COM_KUNENA_EDITOR_HELPLINE_SUBMIT'));?>" />
		<input type="reset" class="kbutton kreply-cancel" name="cancel" data-related="kreply<?php echo $this->message->displayField('id'); ?>_form" value="<?php echo JText::_('COM_KUNENA_CANCEL') ?>" title="<?php echo (JText::_('COM_KUNENA_EDITOR_HELPLINE_CANCEL'));?>" />
		<small><?php echo JText::_('COM_KUNENA_QMESSAGE_NOTE') ?></small>
	</form>
</div>

<?php if (!empty($this->thankyou)) : ?>
	<div class="kmessage-thankyou">
		<?php
		foreach($this->thankyou as $userid => $thank)
		{
			if (!empty($this->thankyou_delete[$userid]))
			{
				$list[] = $thank . ' <a title="' . JText::_('COM_KUNENA_BUTTON_THANKYOU_REMOVE_LONG') . '" href="'
					. $this->thankyou_delete[$userid] . '">' . KunenaIcons::delete() . '</a>';
			}
			else
			{
				$list[] = $thank;
			}
		}

		echo JText::_('COM_KUNENA_THANKYOU') . ': ' . implode(', ', $list) . ' ';
		if ($this->more_thankyou) { echo JText::sprintf('COM_KUNENA_THANKYOU_MORE_USERS', $this->more_thankyou); }
		?>
	</div>
<?php endif;?>
