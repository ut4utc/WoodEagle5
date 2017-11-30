<?php
/**
 * Kunena Component
 * @package         Kunena.Template.BlueEagle5
 * @subpackage      Layout.Topic
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license         http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die;
$topicStarter = $this->topic->first_post_userid == $this->message->userid;
$template     = KunenaTemplate::getInstance();
$direction    = $template->params->get('avatarPosition');
$sideProfile  = $this->profile->getSideProfile($this);
$quick        = $template->params->get('quick');
$config       = KunenaConfig::getInstance();

if ($config->ordering_system == 'mesid')
{
	$this->numLink = $this->location;
}
else
{
	$this->numLink = $this->message->replynum;
}
?>

<div class="kcontainer">
	<div class="kbody">

		<?php if ($direction === "left") : ?>
			<div class="kmsg-header kmsg-header-left">
				<h2>
					<span class="kmsgtitle kmsg-title-left">
						<?php echo $this->escape($this->message->subject) ?>
					</span>
					<span class="kmsgdate kmsgdate-left"
					      title="<?php echo KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat_hover') ?>">
						<?php echo KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat') ?>
					</span>
					<span class="kmsg-id-left">
						<a href="#<?php echo $this->message->id; ?>" id="<?php echo $this->message->id; ?>"
						   rel="canonical">#<?php echo $this->numLink; ?></a>
					</span>
				</h2>
			</div>
			<table class="kmsg k<?php echo $this->message->getState(); ?>">
				<tbody>
					<tr>
						<td class="kprofile-left" rowspan="2">
							<?php echo($sideProfile ? $sideProfile : $this->subLayout('User/Profile')->set('user', $this->profile)->setLayout('default')->set('topic_starter', $topicStarter)->set('category_id', $this->category->id)); ?>
						</td>
						<td class="kmessage-left">
							<?php echo $this->subLayout('Message/Item')->setProperties($this->getProperties()); ?>
							<?php echo $this->subLayout('Message/Edit')->set('message', $this->message)->set('captchaEnabled', $this->captchaEnabled)->setLayout('quickreply'); ?>
						</td>
					</tr>
					<tr>
						<td class="kbuttonbar-left">
							<?php echo $this->subRequest('Message/Item/Actions')->set('mesid', $this->message->id)->set('message', $this->message); ?>
						</td>
					</tr>
				</tbody>
			</table>
		<?php elseif ($direction === "right") : ?>
			<div class="kmsg-header kmsg-header-right">
				<h2>
					<span class="kmsgtitle kmsg-title-right">
						<?php echo $this->escape($this->message->subject) ?>
					</span>
					<span class="kmsgdate kmsgdate-right"
					      title="<?php echo KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat_hover') ?>">
						<?php echo KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat') ?>
					</span>
					<span class="kmsg-id-right">
						<a href="#<?php echo $this->message->id; ?>" id="<?php echo $this->message->id; ?>"
						   rel="canonical">#<?php echo $this->numLink; ?></a>
					</span>
				</h2>
			</div>
			<table class="kmsg k<?php echo $this->message->getState(); ?>">
				<tbody>
				<tr>
					<td class="kmessage-right">
						<?php echo $this->subLayout('Message/Item')->setProperties($this->getProperties()); ?>
						<?php echo $this->subLayout('Message/Edit')->set('message', $this->message)->set('captchaEnabled', $this->captchaEnabled)->setLayout('quickreply'); ?>
					</td>
					<td class="kprofile-right" rowspan="2">
						<?php echo($sideProfile ? $sideProfile : $this->subLayout('User/Profile')->set('user', $this->profile)->setLayout('default')->set('topic_starter', $topicStarter)->set('category_id', $this->category->id)); ?>
					</td>
				</tr>
				<tr>
					<td class="kbuttonbar-right">
						<?php echo $this->subRequest('Message/Item/Actions')->set('mesid', $this->message->id)->set('message', $this->message); ?>
					</td>
				</tr>
				</tbody>
			</table>
		<?php elseif ($direction === "top") : ?>
			<div class="kmsg-header kmsg-header-top">
				<h2>
					<span class="kmsgtitle kmsg-title-top">
						<?php echo $this->escape($this->message->subject) ?>
					</span>
					<span class="kmsgdate kmsgdate-top"
					      title="<?php echo KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat_hover') ?>">
						<?php echo KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat') ?>
					</span>
					<span class="kmsg-id-top">
						<a href="#<?php echo $this->message->id; ?>" id="<?php echo $this->message->id; ?>"
						   rel="canonical">#<?php echo $this->numLink; ?></a>
					</span>
				</h2>
			</div>
			<table class="kmsg k<?php echo $this->message->getState(); ?>">
				<tbody>
				<tr>
					<td class="kprofile-top">
						<?php echo $this->subLayout('User/Profile')->set('user', $this->profile)->setLayout('horizontal')->set('topic_starter', $topicStarter)->set('category_id', $this->category->id); ?>
					</td>
				</tr>
				<tr>
					<td class="kmessage-top">
						<?php echo $this->subLayout('Message/Item')->setProperties($this->getProperties()); ?>
						<?php echo $this->subLayout('Message/Edit')->set('message', $this->message)->set('captchaEnabled', $this->captchaEnabled)->setLayout('quickreply'); ?>
					</td>
				</tr>
				<tr>
					<td class="kbuttonbar-top">
						<?php echo $this->subRequest('Message/Item/Actions')->set('mesid', $this->message->id)->set('message', $this->message); ?>
					</td>
				</tr>
				</tbody>
			</table>
		<?php elseif ($direction === "bottom") : ?>
			<div class="kmsg-header kmsg-header-bottom">
				<h2>
					<span class="kmsgtitle kmsg-title-bottom">
						<?php echo $this->escape($this->message->subject) ?>
					</span>
					<span class="kmsgdate kmsgdate-bottom"
					      title="<?php echo KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat_hover') ?>">
						<?php echo KunenaDate::getInstance($this->message->time)->toKunena('config_post_dateformat') ?>
					</span>
					<span class="kmsg-id-bottom">
						<a href="#<?php echo $this->message->id; ?>" id="<?php echo $this->message->id; ?>"
						   rel="canonical">#<?php echo $this->numLink; ?></a>
					</span>
				</h2>
			</div>
			<table class="kmsg k<?php echo $this->message->getState(); ?>">
				<tbody>
				<tr>
					<td class="kmessage-bottom">
						<?php echo $this->subLayout('Message/Item')->setProperties($this->getProperties()); ?>
						<?php echo $this->subLayout('Message/Edit')->set('message', $this->message)->set('captchaEnabled', $this->captchaEnabled)->setLayout('quickreply'); ?>
					</td>
				</tr>
				<tr>
					<td class="kbuttonbar-bottom">
						<?php echo $this->subRequest('Message/Item/Actions')->set('mesid', $this->message->id)->set('message', $this->message); ?>
					</td>
				</tr>
				<tr>
					<td class="kprofile-bottom">
						<?php echo $this->subLayout('User/Profile')->set('user', $this->profile)->setLayout('horizontal')->set('topic_starter', $topicStarter)->set('category_id', $this->category->id); ?>
					</td>
				</tr>
				</tbody>
			</table>
		<?php endif; ?>

		<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_msg_' . $this->message->replynum); ?>
	</div>
</div>
