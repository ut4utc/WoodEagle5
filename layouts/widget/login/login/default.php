<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Widget
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>
<table class="kprofilebox">
	<tbody>
		<tr class="krow1">
			<td valign="top" class="kprofileboxcnt">
				<div class="k_guest">
					<?php echo JText::_('COM_KUNENA_PROFILEBOX_WELCOME'); ?>,
					<b><?php echo JText::_('COM_KUNENA_PROFILEBOX_GUEST'); ?></b>
				</div>
				<form action="<?php echo JRoute::_('index.php?option=com_kunena'); ?>" method="post" class="form-inline">
					<input type="hidden" name="view" value="user" />
					<input type="hidden" name="task" value="login" />
					<?php echo JHtml::_('form.token'); ?>
						<div class="input">
							<span>
								<?php echo JText::_('COM_KUNENA_LOGIN_USERNAME') ?>
								<input type="text" name="username" class="inputbox ks" alt="username" size="18" />
							</span>
							<span>
								<?php echo JText::_('COM_KUNENA_LOGIN_PASSWORD'); ?>
								<input type="password" name="password" class="inputbox ks" size="18" alt="password" />
							</span>
							<?php $login = KunenaLogin::getInstance(); ?>
							<?php if ($login->getTwoFactorMethods() > 1) : ?>
								<span>
								<?php echo JText::_('COM_KUNENA_LOGIN_SECRETKEY'); ?>
									<input id="k-lgn-secretkey" type="text" name="secretkey" class="input-small" size="18" />
							</span>
							<?php endif; ?>
							<span>
								<?php if ($this->rememberMe) : ?>
									<?php echo JText::_('COM_KUNENA_LOGIN_REMEMBER_ME'); ?>
									<input type="checkbox" name="remember" alt="" value="1" />
								<?php endif; ?>
								<input type="submit" name="submit" class="kbutton" value="<?php echo JText::_('COM_KUNENA_PROFILEBOX_LOGIN'); ?>" />
							</span>
						</div>
						<div class="klink-block">
							<span class="kprofilebox-pass">
								<a href="<?php echo $this->resetPasswordUrl; ?>" rel="nofollow"><?php echo JText::_('COM_KUNENA_PROFILEBOX_FORGOT_PASSWORD') ?></a>
							</span>
							<span class="kprofilebox-user">
								<a href="<?php echo $this->remindUsernameUrl; ?>" rel="nofollow"><?php echo JText::_('COM_KUNENA_PROFILEBOX_FORGOT_USERNAME') ?></a>
							</span>
							<?php
							if ($this->registrationUrl) : ?>
								<span class="kprofilebox-register">
								<a href="<?php echo $this->registrationUrl;  ?>" rel="nofollow"><?php echo JText::_('COM_KUNENA_PROFILEBOX_CREATE_ACCOUNT') ?></a>
							</span>
							<?php endif; ?>
						</div>
					</form>
			</td>
			<!-- Module position -->
			<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_login'); ?>
		</tr>
	</tbody>
</table>
