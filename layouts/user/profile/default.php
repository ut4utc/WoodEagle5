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

// @var KunenaUser $user

$user = $this->user;
$avatar = $user->getAvatarImage(KunenaFactory::getTemplate()->params->get('avatarType'), 'post');
$show = KunenaConfig::getInstance()->showuserstats;
$activityIntegration = KunenaFactory::getActivityIntegration();
$points = $activityIntegration->getUserPoints($user->userid);
$medals = $activityIntegration->getUserMedals($user->userid);

if ($show)
{
	if (KunenaConfig::getInstance()->showkarma)
	{
		$karma = $user->getKarma();
	}

	$rankImage = $user->getRank($this->category_id, 'image');
	$rankTitle = $user->getRank($this->category_id, 'title');
	$personalText = $user->getPersonalText();
}
?>
<ul class="kpost-profile">
	<li class="kpost-username">
		<strong><?php echo $user->getLink(null, null, 'canonical', '', null, $this->category_id); ?></strong>
	</li>

	<?php if ($avatar) : ?>
	<li>
		<?php echo $user->getLink($avatar, null, ''); ?>
		<?php if (isset($this->topic_starter) && $this->topic_starter) : ?>
				<span class="hidden-phone topic-starter <?php if (KunenaFactory::getTemplate()->params->get('avatarType') == 'img-circle') {echo 'topic-starter-circle';};?>"><?php echo JText::_('COM_KUNENA_TOPIC_AUTHOR') ?></span>
		<?php endif;?>
		<?php /*if ($user->isModerator()) : */?><!--
			<span class="<?php /*if (KunenaFactory::getTemplate()->params->get('avatarType') == 'img-circle') {echo 'topic-moderator-circle';};*/?> topic-moderator"><?php /*echo JText::_('COM_KUNENA_TEAM_MEMBER') */?></span>
		--><?php /*endif;*/?>
	</li>
	<?php endif; ?>

	<?php if ($user->exists()) : ?>
	<li>
		<?php echo $this->subLayout('User/Item/Status')->set('user', $user); ?>
	</li>
	<?php endif; ?>

	<?php if (!empty($rankTitle)) : ?>
	<li>
		<?php echo $this->escape($rankTitle); ?>
	</li>
	<?php endif; ?>

	<?php if (!empty($rankImage)) : ?>
	<li>
		<?php echo $rankImage; ?>
	</li>
	<?php endif; ?>

	<?php if (!empty($personalText)) : ?>
	<li>
		<?php echo $personalText; ?>
	</li>
	<?php endif; ?>

<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_profile_default'); ?>
<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_topicprofile'); ?>
<?php if ($user->userid > 1) : ?>

			<?php if ($user->posts >= 1) : ?>
			<li>
				<?php echo JText::_('COM_KUNENA_POSTS') . ' ' . (int) $user->posts; ?>
			</li>
			<?php endif; ?>

			<?php if (!empty($karma) && KunenaConfig::getInstance()->showkarma) : ?>
			<li>
				<?php echo JText::_('COM_KUNENA_KARMA') . ': ' . $karma; ?>
			</li>
			<?php endif; ?>

			<?php if ($show && isset($user->thankyou) && KunenaConfig::getInstance()->showthankyou) : ?>
			<li>
				<?php echo JText::_('COM_KUNENA_MYPROFILE_THANKYOU_RECEIVED') . ' ' . (int) $user->thankyou; ?>
			</li>
			<?php endif; ?>

			<?php if ($show && !empty($points)) : ?>
			<li>
				<?php echo JText::_('COM_KUNENA_AUP_POINTS') . ' ' . $points; ?>
			</li>
			<?php endif; ?>

			<?php if ($show && !empty($medals)) : ?>
			<li>
				<?php echo implode(' ', $medals); ?>
			</li>
			<?php endif; ?>

			<?php if ($user->gender) :?>
				<li>
					<?php echo $user->profileIcon('gender'); ?>
				</li>
			<?php endif; ?>

			<?php if ($user->birthdate) :?>
				<li>
					<?php echo $user->profileIcon('birthdate'); ?>
				</li>
			<?php endif; ?>

			<?php if ($user->location) :?>
				<li>
					<?php echo $user->profileIcon('location'); ?>
				</li>
			<?php endif; ?>

			<?php if ($user->websiteurl) :?>
				<li>
					<?php echo $user->profileIcon('website'); ?>
				</li>
			<?php endif; ?>

			<?php if (KunenaFactory::getPrivateMessaging()) :?>
				<li>
					<?php echo $user->profileIcon('private'); ?>
				</li>
			<?php endif; ?>

			<?php if ($user->email && !$user->hideEmail) :?>
				<li>
					<?php echo $user->profileIcon('email'); ?>
				</li>
			<?php endif; ?>

			<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_topicprofilemore'); ?>
		</ul>
<?php endif;
