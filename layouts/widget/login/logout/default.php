<?php
/**
 * Kunena Component
 *
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Widget
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>
<div class="kprofilebox-left">
    <?php if ($this->me->getAvatarImage('welcome')) : ?>
        <?php echo $this->me->getAvatarImage('kavatar', 'welcome'); ?>
    <?php endif; ?>
</div>
<div class="kprofilebox-right">
    <form action="<?php echo KunenaRoute::_('index.php?option=com_kunena'); ?>" method="post" id="logout-form" class="form-inline">
        <input type="hidden" name="view" value="user" />
        <input type="hidden" name="task" value="logout" />
        <?php echo JHtml::_('form.token'); ?>
        <input type="submit" name="submit" class="kbutton" value="<?php echo JText::_('COM_KUNENA_PROFILEBOX_LOGOUT'); ?>" />
    </form>
	<?php if (!empty($this->profile_edit_url)) : ?>
        <a href="<?php echo $this->profile_edit_url; ?>" class="btn btn-link">
            <?php echo JText::_('COM_KUNENA_LOGOUTMENU_LABEL_PREFERENCES'); ?>
        </a>
	<?php endif ?>
    <br />
	<?php if (!empty($this->announcementsUrl)) : ?>
        <a href="<?php echo $this->announcementsUrl; ?>" class="btn btn-link">
            <?php echo JText::_('COM_KUNENA_ANN_ANNOUNCEMENTS') ?>
        </a>
	<?php endif ?>
</div>

<div class="kprofileboxcnt">
    <ul class="kprofilebox-welcome">
        <li>
			<?php echo JText::_('COM_KUNENA_PROFILEBOX_WELCOME'); ?>, <strong><?php echo $this->me->getLink() ?></strong>
        </li>
        <li class="kms">
            <strong><?php echo JText::_('COM_KUNENA_MYPROFILE_LASTLOGIN'); ?>:</strong>
            <span title="<?php echo KunenaDate::getInstance($this->me->lastvisitDate)->toKunena('ago'); ?>">
                <?php echo KunenaDate::getInstance($this->me->lastvisitDate)->toKunena('config_post_dateformat'); ?>
            </span>
        </li>
    </ul>
    <ul class="kprofilebox-link">
        <?php if (!empty($this->pm_link)) : ?>
            <li>
                <a href="<?php echo $this->pm_link; ?>" class="btn btn-link">
                    <?php echo $this->inboxCount; ?>
                </a>
            </li>
        <?php endif ?>

    </ul>
</div>
<!-- Module position -->
<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_logout'); ?>
