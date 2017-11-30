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

$message = $this->message;
$template = KunenaTemplate::getInstance();

if (!$message->isAuthorised('reply'))
{
	return;
}

$author   = isset($this->author) ? $this->author : $message->getAuthor();
$topic    = isset($this->topic) ? $this->topic : $message->getTopic();
$category = isset($this->category) ? $this->category : $message->getCategory();
$config   = isset($this->config) ? $this->config : KunenaFactory::getConfig();
$me       = isset($this->me) ? $this->me : KunenaUserHelper::getMyself();

// Load caret.js always before atwho.js script and use it for autocomplete, emojiis...
$this->addStyleSheet('assets/css/jquery.atwho.css');
$this->addScript('assets/js/jquery.caret.js');
$this->addScript('assets/js/jquery.atwho.js');

$this->addScriptDeclaration("kunena_topicicontype = '';");

$this->addScript('assets/js/edit.js');

if (KunenaFactory::getTemplate()->params->get('formRecover'))
{
	$this->addScript('assets/js/sisyphus.js');
}

if ($me->canDoCaptcha() )
{
	if (JPluginHelper::isEnabled('captcha'))
	{
		$plugin = JPluginHelper::getPlugin('captcha');
		$params = new JRegistry($plugin[0]->params);

		$captcha_pubkey = $params->get('public_key');
		$catcha_privkey = $params->get('private_key');

		if (!empty($captcha_pubkey) && !empty($catcha_privkey))
		{
			JPluginHelper::importPlugin('captcha');
			$dispatcher = JDispatcher::getInstance();
			$result = $dispatcher->trigger('onInit', 'dynamic_recaptcha_' . $this->message->id);
			$output = $dispatcher->trigger('onDisplay', array(null, 'dynamic_recaptcha_' . $this->message->id,
				'class="controls g-recaptcha" data-sitekey="' . $captcha_pubkey . '" data-theme="light"'));
			$this->quickcaptchaDisplay = $output[0];
			$this->quickcaptchaEnabled = $result[0];
		}
	}
}
?>

<div class="kreply span12 well" id="kreply<?php echo $message->displayField('id'); ?>_form" style="display: inline-block;">
	<div class="modal-header">
		<h3>
			<?php echo JText::sprintf('COM_KUNENA_MESSAGE_ACTIONS_LABEL_QUICK_REPLY', $author->getLink()); ?>
		</h3>
	</div>

	<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=topic'); ?>" method="post"
	      enctype="multipart/form-data" name="postform" id="postform" class="form-inline">
		<input type="hidden" name="task" value="post" />
		<input type="hidden" name="parentid" value="<?php echo $topic->last_post_id; ?>" />
		<input type="hidden" name="catid" value="<?php echo $category->displayField('id'); ?>" />
		<?php if (!$config->allow_change_subject) : ?>
			 <input type="hidden" name="subject" value="<?php echo $this->escape($this->message->subject); ?>" />
		<?php endif; ?>
		<?php echo JHtml::_('form.token'); ?>

		<div class="modal-body">

			<?php if (!$me->exists()) : ?>
				<div class="controls">
					<label>
						<?php echo JText::_('COM_KUNENA_GEN_NAME'); ?>:
					</label>
					<input type="text" name="authorname" class="span12" maxlength="35" placeholder="<?php echo JText::_('COM_KUNENA_GEN_NAME'); ?>" value="" required />
				</div>
			<?php endif; ?>

			<?php if ($config->askemail && !$me->exists()): ?>
				<div class="controls">
					<?php echo $config->showemail == '0' ? JText::_('COM_KUNENA_POST_EMAIL_NEVER') : JText::_('COM_KUNENA_POST_EMAIL_REGISTERED'); ?>
					<input type="text" id="email" name="email" placeholder="<?php echo JText::_('COM_KUNENA_TOPIC_EDIT_PLACEHOLDER_EMAIL') ?>" class="inputbox span12" maxlength="35" value="" required />
				</div>
			<?php endif; ?>

			<div class="controls">
				<label for="kanonymous<?php echo intval($message->id); ?>">
					<?php echo JText::_('COM_KUNENA_GEN_SUBJECT'); ?>:
				</label>
				<input type="text" id="subject" name="subject" class="inputbox span12"
				       maxlength="<?php echo $template->params->get('SubjectLengthMessage'); ?>"
				       <?php if (!$config->allow_change_subject): ?>disabled<?php endif; ?>
				       value="<?php echo $message->displayField('subject'); ?>" />
			</div>
			<div class="controls">
				<label>
					<?php echo JText::_('COM_KUNENA_MESSAGE'); ?>:
				</label>
				<textarea class="span12 qreply" id="kbbcode-message" name="message" rows="6" cols="60" placeholder="<?php echo JText::_('COM_KUNENA_ENTER_MESSAGE') ?>"></textarea>
			</div>

			<?php if ($topic->isAuthorised('subscribe')) : ?>
			<div class="control-group">
				<div class="controls">
					<input style="float: left; margin-right: 10px;" type="checkbox" name="subscribeMe" id="subscribeMe" value="1" <?php if ($config->subscriptionschecked == 1 && $me->canSubscribe != 0 || $config->subscriptionschecked == 0 && $me->canSubscribe == 1)
					{
						echo 'checked="checked"';
					} ?> />
					<label class="string optional" for="subscribeMe"><?php echo JText::_('COM_KUNENA_POST_NOTIFIED'); ?></label>
				</div>
				<?php if ($me->exists() && $category->allow_anonymous) : ?>
				<div class="controls">
					<input type="checkbox" id="kanonymous<?php echo $message->displayField('id'); ?>" name="anonymous"
							value="1" class="kinputbox postinput" <?php if ($category->post_anonymous) echo 'checked="checked"'; ?> />
					<label for="kanonymous<?php echo intval($message->id); ?>">
						<?php echo JText::_('COM_KUNENA_POST_AS_ANONYMOUS_DESC'); ?>
					</label>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<a href="index.php?option=com_kunena&view=topic&layout=reply&catid=<?php echo $message->catid;?>&id=<?php echo $message->thread;?>&mesid=<?php echo $message->id;?>&Itemid=<?php echo KunenaRoute::getItemID();?>" role="button" class="btn btn-small btn-link pull-right" rel="nofollow"><?php echo JText::_('COM_KUNENA_GO_TO_EDITOR'); ?></a>
		</div>
		<?php if (!empty($this->quickcaptchaEnabled)) : ?>
			<div class="control-group">
				<?php echo $this->quickcaptchaDisplay;?>
			</div>
		<?php endif; ?>
		<div class="modal-footer">
			<small><?php echo JText::_('COM_KUNENA_QMESSAGE_NOTE'); ?></small>
			<input type="submit" class="btn btn-primary kreply-submit" name="submit"
			       value="<?php echo JText::_('COM_KUNENA_SUBMIT'); ?>"
			       title="<?php echo (JText::_('COM_KUNENA_EDITOR_HELPLINE_SUBMIT')); ?>" />
			<?php //TODO: remove data on cancel. ?>
			<input type="reset" name="reset" class="btn"
				value="<?php echo (' ' . JText::_('COM_KUNENA_CANCEL') . ' ');?>"
				title="<?php echo (JText::_('COM_KUNENA_EDITOR_HELPLINE_CANCEL'));?>" data-dismiss="modal" aria-hidden="true" />
		</div>
		<input type="hidden" id="kurl_emojis" name="kurl_emojis" value="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=topic&layout=listemoji&format=raw') ?>" />
		<input type="hidden" id="kemojis_allowed" name="kemojis_allowed" value="<?php echo $config->disemoticons ? 0 : 1 ?>" />
	</form>
</div>
<div class="clearfix"></div>
