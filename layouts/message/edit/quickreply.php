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

// @var KunenaLayout $this


// @var KunenaForumMessage  $message  Message to reply to.

$message = $this->message;

if (!$message->isAuthorised('reply'))
{
	return;
}

// @var KunenaUser  $author  Author of the message.

$author = isset($this->author) ? $this->author : $message->getAuthor();
// @var KunenaForumTopic  $topic Topic of the message.

$topic = isset($this->topic) ? $this->topic : $message->getTopic();
// @var KunenaForumCategory  $category  Category of the message.

$category = isset($this->category) ? $this->category : $message->getCategory();
// @var KunenaConfig  $config  Kunena configuration.

$config = isset($this->config) ? $this->config : KunenaFactory::getConfig();
// @var KunenaUser  $me  Current user.

$me = isset($this->me) ? $this->me : KunenaUserHelper::getMyself();

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

// Fixme: can't get the controller working on this
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
$template = KunenaTemplate::getInstance();
$quick = $template->params->get('quick');

?>
