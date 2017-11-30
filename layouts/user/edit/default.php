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
$this->profile = KunenaFactory::getUser($this->user->id);
$this->me = KunenaUserHelper::getMyself();
?>
<div class="kblock kedituser">
	<div class="kheader">
		<h2>
			<?php echo JText::_('COM_KUNENA_USER_PROFILE'); ?> <?php echo $this->escape($this->profile->getName()); ?>

			<span class="kheadbtn kright">
				<a type="button" name="back" onclick="window.history.back();">
					<?php echo KunenaIcons::back();?> <?php echo JText::_('COM_KUNENA_BACK'); ?>
				</a>
			</span>
		</h2>
	</div>
	<div class="kcontainer">
		<div class="kbody">
			<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=user'); ?>" method="post" enctype="multipart/form-data" name="kuserform" class="form-validate" id="kuserform">
				<input type="hidden" name="task" value="save" />
				<input type="hidden" name="userid" value="<?php echo (int) $this->user->id; ?>" />
				<?php echo JHtml::_('form.token'); ?>

				<div class="tabs">
					<ul id="KunenaUserEdit" class="nav nav-tabs">
						<?php if ($this->profile->userid == $this->me->userid): ?>
							<li class="active">
								<a href="#home" data-toggle="tab">
									<?php echo JText::_('COM_KUNENA_PROFILE_EDIT_USER'); ?>
								</a>
							</li>
						<?php endif; ?>
						<li <?php if ($this->profile->userid != $this->me->userid) { echo 'class="active"'; }?>>
							<a href="#editprofile" data-toggle="tab">
								<?php echo JText::_('COM_KUNENA_PROFILE_EDIT_PROFILE'); ?>
							</a>
						</li>
						<?php if ($this->profile->userid == $this->me->userid): ?>
							<li>
								<a href="#editavatar" data-toggle="tab">
									<?php echo JText::_('COM_KUNENA_PROFILE_EDIT_AVATAR'); ?>
								</a>
							</li>
						<?php endif; ?>
						<li>
							<a href="#editsettings" data-toggle="tab">
								<?php echo JText::_('COM_KUNENA_PROFILE_EDIT_SETTINGS'); ?>
							</a>
						</li>
					</ul>

					<div id="KunenaUserEdit" class="tab-content">
						<?php if ($this->profile->userid == $this->me->userid): ?>
							<div class="tab-pane fade in active" id="home">
								<?php echo $this->subRequest('User/Edit/User'); ?>
							</div>
						<?php endif; ?>
						<div class="tab-pane fade <?php if ($this->profile->userid != $this->me->userid) { echo 'in active'; }?>" id="editprofile">
							<?php echo $this->subRequest('User/Edit/Profile'); ?>
						</div>
						<?php if ($this->profile->userid == $this->me->userid): ?>
							<div class="tab-pane fade" id="editavatar">
								<?php echo $this->subRequest('User/Edit/Avatar'); ?>
							</div>
						<?php endif; ?>
						<div class="tab-pane fade" id="editsettings">
							<?php echo $this->subRequest('User/Edit/Settings'); ?>
						</div>

						<br />

						<div class="center">
							<button class="kbutton" type="submit">
								<?php echo KunenaIcons::save();?> <?php echo JText::_('COM_KUNENA_SAVE'); ?>
							</button>
							<button class="kbutton" type="button" name="cancel" onclick="window.history.back();" title="<?php echo (JText::_('COM_KUNENA_EDITOR_HELPLINE_CANCEL')); ?>">
								<?php echo KunenaIcons::cancel();?> <?php echo JText::_('COM_KUNENA_CANCEL'); ?>
							</button>
						</div>
						<br />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
