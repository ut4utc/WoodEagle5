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

// @var KunenaUser $profile

$profile = $this->profile;
$me = KunenaUserHelper::getMyself();
$avatar = $profile->getAvatarImage(KunenaFactory::getTemplate()->params->get('avatarType'), 'post');
$banInfo = $this->config->showbannedreason
	? KunenaUserBan::getInstanceByUserid($profile->userid)
	: null;
$private = KunenaFactory::getPrivateMessaging();
$websiteURL = $profile->getWebsiteURL();
$websiteName = $profile->getWebsiteName();
$personalText = $profile->getPersonalText();
$signature = $profile->getSignature();
$email = $profile->email && !$profile->hideEmail && $profile->config->showemail || $me->isModerator() || $profile->userid == $me->userid;
$activityIntegration = KunenaFactory::getActivityIntegration();
$points = $activityIntegration->getUserPoints($profile->userid);
$medals = $activityIntegration->getUserMedals($profile->userid);

if ($this->config->showuserstats)
{
	$showKarma = KunenaConfig::getInstance()->showkarma;
	$rankImage = $profile->getRank(0, 'image');
	$rankTitle = $profile->getRank(0, 'title');
}
?>
<?php if ($avatar) : ?>
	<div class="kavatar-lg"><?php echo $avatar; ?></div>
	<div class="center">
		<strong><?php echo $this->subLayout('User/Item/Status')->set('user', $profile); ?></strong>
	</div>
<?php endif; ?>
<div id="kprofile-stats">
	<ul>
		<?php if ( !empty($profile->banReason) ) : ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_BANINFO'); ?>:</strong> <?php echo $profile->escape($profile->banReason); ?></li><?php endif ?>
		<?php if (!empty($profile->usertype)): ?><li class="usertype"><?php echo JText::_($profile->usertype); ?></li><?php endif; ?>
		<?php if (!empty($profile->getRank(0, 'title'))): ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_RANK'); ?>: </strong><?php echo $profile->escape($profile->getRank(0, 'title')); ?></li><?php endif; ?>
		<?php if (!empty($profile->getRank(0, 'image'))): ?><li class="kprofile-rank"><?php echo $profile->getRank(0, 'image'); ?></li><?php endif; ?>
		<?php if ($this->config->userlist_joindate || $me->isModerator()) : ?>
			<li>
				<strong> <?php echo JText::_('COM_KUNENA_MYPROFILE_REGISTERDATE'); ?>:</strong>
				<span title="<?php echo $profile->getRegisterDate()->toKunena('ago'); ?>"> <?php echo $profile->getRegisterDate()->toKunena('date_today', 'utc'); ?> </span>
			</li>
		<?php endif; ?>
		<?php if ($this->config->userlist_lastvisitdate || $me->isModerator()) : ?>
			<li>
				<strong> <?php echo JText::_('COM_KUNENA_MYPROFILE_LASTLOGIN'); ?>:</strong>
				<span title="<?php echo $profile->getLastVisitDate()->toKunena('ago'); ?>"> <?php echo $profile->getLastVisitDate()->toKunena('config_post_dateformat'); ?> </span>
			</li>
		<?php endif; ?>
		<li>
			<strong> <?php echo JText::_('COM_KUNENA_MYPROFILE_TIMEZONE'); ?>:</strong>
			<span> UTC <?php echo $profile->getTime()->toTimezone(); ?> </span>
		</li>
		<li>
			<strong> <?php echo JText::_('COM_KUNENA_MYPROFILE_LOCAL_TIME'); ?>:</strong>
			<span> <?php echo $profile->getTime()->toKunena('time'); ?> </span>
		</li>
		<?php if (!empty($profile->posts)): ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_POSTS'); ?>:</strong> <?php echo intval($profile->posts); ?></li><?php endif; ?>
		<?php if (!empty($profile->thankyou)): ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_THANKYOU_RECEIVED'); ?></strong> <?php echo intval($profile->thankyou); ?></li><?php endif; ?>
		<?php if (!empty($profile->userpoints)): ?><li><strong><?php echo JText::_('COM_KUNENA_AUP_POINTS'); ?></strong> <?php echo intval($profile->userpoints); ?></li><?php endif; ?>
		<?php if (!empty($profile->usermedals)) : ?><li><?php foreach ( $profile->usermedals as $medal ) : echo $medal,' '; endforeach ?></li><?php endif ?>
		<li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_PROFILEVIEW'); ?>:</strong> <?php echo intval($profile->uhits); ?></li>
		<?php if (!empty($showKarma) && !empty($profile->karma) && KunenaConfig::getInstance()->showkarma) : ?>
			<li>
				<strong> <?php echo JText::_('COM_KUNENA_KARMA'); ?>:</strong>
				<span> <?php echo JText::sprintf((int) $profile->karma); ?> </span>
			</li>
		<?php endif; ?>
		<?php if ($private) : ?>
			<?php echo $private->shownewIcon($profile->userid); ?>
		<?php endif; ?>
		<?php if ($email) : ?>
			<a class="btn btn-small" href="mailto:<?php echo $profile->email; ?>" rel="nofollow"><?php echo KunenaIcons::email(); ?></a>
		<?php endif; ?>
		<?php if (!empty($websiteName) && $websiteURL != 'http://') : ?>
			<a class="btn btn-small" rel="nofollow" target="_blank" href="<?php echo $websiteURL ?>"><?php echo KunenaIcons::globe() . ' ' . $websiteName ?></a>
		<?php elseif(empty($websiteName) && $websiteURL != 'http://') : ?>
			<a class="btn btn-small" href="<?php echo $websiteURL ?>"><?php echo KunenaIcons::globe() . ' ' . $websiteURL ?></a>
		<?php elseif(!empty($websiteName) && $websiteURL == 'http://') : ?>
			<button class="btn btn-small"><?php echo KunenaIcons::globe() . ' ' . $websiteName ?></button>
		<?php endif; ?>
		<?php if( !empty($profile->personalText) ) { ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_ABOUTME'); ?>:</strong> <?php echo KunenaHtmlParser::parseText($profile->personalText); ?></li><?php } ?>
	</ul>
</div>

