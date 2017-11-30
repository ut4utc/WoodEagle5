<?php
/**
 * Kunena Component
 *
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Statistics
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>

<div class="kblock kwhoisonline">
	<div class="kheader">
		<div class="pull-right">
			<div class="btn-group">
				<div class="close" data-toggle="collapse" data-target="#kwho">&times;</div>
			</div>
		</div>
		<h2 class="btn-link">
			<?php if ($this->usersUrl) : ?>
				<a href="<?php echo $this->usersUrl; ?>">
					<?php echo JText::_('COM_KUNENA_MEMBERS'); ?>
				</a>
			<?php else : ?>
				<?php echo JText::_('COM_KUNENA_MEMBERS'); ?>
			<?php endif; ?>
		</h2>
	</div>

	<div class="collapse in" id="kwho">
		<div class="kbody">
			<table class="kblocktable">
				<tbody>
					<tr class="krow2">
						<td class="kcol-first">
							<div class="kwhoicon"></div>
						</td>
						<td class="kcol-mid km">
							<div class="kwhoonline kwho-total ks">
								<span>
									<?php echo JText::sprintf('COM_KUNENA_VIEW_COMMON_WHO_TOTAL', $this->membersOnline); ?>
								</span>
								<?php
								$template = KunenaTemplate::getInstance();
								$direction = $template->params->get('whoisonlineName');

								if ($direction == 'both') : ?>
									<div><?php echo $this->setLayout('both'); ?></div>
									<?php
								elseif ($direction == 'avatar') : ?>
									<div><?php echo $this->setLayout('avatar'); ?></div>
								<?php else : ?>
									<div><?php echo $this->setLayout('name'); ?></div>
									<?php
								endif;
								?>

								<?php if (!empty($this->onlineList)) : ?>
									<div class="kwholegend ks">
										<span><?php echo JText::_('COM_KUNENA_LEGEND'); ?>:</span>
										<span class="kwho-admin">
							<?php echo KunenaIcons::user(); ?> <?php echo JText::_('COM_KUNENA_COLOR_ADMINISTRATOR'); ?>
						</span>
										<span class="kwho-globalmoderator">
							<?php echo KunenaIcons::user(); ?> <?php echo JText::_('COM_KUNENA_COLOR_GLOBAL_MODERATOR'); ?>
						</span>
										<span class="kwho-moderator">
							<?php echo KunenaIcons::user(); ?> <?php echo JText::_('COM_KUNENA_COLOR_MODERATOR'); ?>
						</span>
										<span class="kwho-banned">
							<?php echo KunenaIcons::user(); ?> <?php echo JText::_('COM_KUNENA_COLOR_BANNED'); ?>
						</span>
										<span class="kwho-user">
							<?php echo KunenaIcons::user(); ?> <?php echo JText::_('COM_KUNENA_COLOR_USER'); ?>
						</span>
										<span class="kwho-guest">
							<?php echo KunenaIcons::user(); ?> <?php echo JText::_('COM_KUNENA_COLOR_GUEST'); ?>
						</span>
									</div>
								<?php endif; ?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
