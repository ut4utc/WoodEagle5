<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.User
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

?>

<div class="inline">
	<?php if (!empty($this->profile->twitter)) : ?>
	<?php echo $this->profile->socialButton('twitter'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->facebook)) : ?>
	<?php echo $this->profile->socialButton('facebook'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->instagram)) : ?>
		<?php echo $this->profile->socialButton('instagram'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->skype)) : ?>
		<?php echo $this->profile->socialButton('skype'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->linkedin)) : ?>
		<?php echo $this->profile->socialButton('linkedin'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->delicious)) : ?>
		<?php echo $this->profile->socialButton('delicious'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->google)) : ?>
		<?php echo $this->profile->socialButton('google'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->qq)) : ?>
		<?php echo $this->profile->socialButton('qq'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->qzone)) : ?>
		<?php echo $this->profile->socialButton('qzone'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->weibo)) : ?>
		<?php echo $this->profile->socialButton('weibo'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->wechat)) : ?>
		<?php echo $this->profile->socialButton('wechat'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->microsoft)) : ?>
		<?php echo $this->profile->socialButton('microsoft'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->apple)) : ?>
		<?php echo $this->profile->socialButton('apple'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->vk)) : ?>
		<?php echo $this->profile->socialButton('vk'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->telegram)) : ?>
		<?php echo $this->profile->socialButton('telegram'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->icq)) : ?>
		<?php echo $this->profile->socialButton('icq'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->myspace)) : ?>
	<?php echo $this->profile->socialButton('myspace'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->blogspot)) : ?>
		<?php echo $this->profile->socialButton('blogspot'); ?>
	<?php endif; ?>
	<?php if (!empty($this->profile->flicker)) : ?>
	<?php echo $this->profile->socialButton('flickr'); ?>
	<?php endif; ?>
</div>
