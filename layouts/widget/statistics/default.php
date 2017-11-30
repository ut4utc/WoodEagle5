<?php
/**
 * Kunena Component
 * @package         Kunena.Template.BlueEagle5
 * @subpackage      Layout.Widget
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license         http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>

<div class="kblock kfrontstats">
	<div class="kheader">
		<div class="ktoggler">
			<div class="close" data-toggle="collapse" data-target="#kfrontstats-tbody">&times;</div>
		</div>
		<h2 class="btn-link">
			<?php if ($this->statisticsUrl) : ?>
				<a href="<?php echo $this->statisticsUrl; ?>">
					<?php echo JText::_('COM_KUNENA_STATISTICS'); ?>
				</a>
			<?php else : ?>
				<?php echo JText::_('COM_KUNENA_STATISTICS'); ?>
			<?php endif; ?>
		</h2>
	</div>
	<div class="collapse in" id="kfrontstats-tbody">
		<div class="kbody">
			<table class="kblocktable">
				<tbody>
				<tr class="krow1">
					<td class="kcol-first">
						<div class="kstatsicon"></div>
					</td>
					<td class="kcol-mid km">
						<ul id="kstatslistright" class="fltrt kright">
							<li class="hidden-phone"><?php echo JText::_('COM_KUNENA_STAT_TOTAL_USERS'); ?>: <strong><?php echo $this->memberCount ?></strong> <span class="divider">|</span> <?php echo JText::_('COM_KUNENA_STAT_LATEST_MEMBERS'); ?>: <strong><?php echo $this->latestMemberLink ?></strong></li>
							<li>&nbsp;</li>
							<?php if (!KunenaConfig::getInstance()->userlist_allowed) : ?>
							<li>
								<a href="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=user&layout=list'); ?>">
									<?php echo JText::_('COM_KUNENA_USRL_USERLIST') . ' &raquo;'; ?>
								</a>
							</li>
							<?php endif; ?>
							<?php if ($this->config->showpopuserstats || $this->config->showpopsubjectstats) :;?>
								<li>
								<a href="<?php echo $this->statisticsUrl; ?>">
									<?php echo JText::_('COM_KUNENA_STATISTICS') . ' &raquo;'; ?>
								</a>
								</li>
							<?php endif; ?>
						</ul>
						<ul id="kstatslistleft" class="fltlft">
							<li><?php echo JText::_('COM_KUNENA_STAT_TOTAL_MESSAGES'); ?>: <strong> <?php echo intval($this->messageCount); ?></strong> <span class="divider">|</span> <?php echo JText::_('COM_KUNENA_STAT_TOTAL_SUBJECTS'); ?>: <strong><?php echo intval($this->topicCount); ?></strong></li>
							<li><?php echo JText::_('COM_KUNENA_STAT_TOTAL_SECTIONS'); ?>: <strong><?php echo intval($this->sectionCount); ?></strong> <span class="divider">|</span> <?php echo JText::_('COM_KUNENA_STAT_TOTAL_CATEGORIES'); ?>: <strong><?php echo intval($this->categoryCount); ?></strong></li>
							<li><?php echo JText::_('COM_KUNENA_STAT_TODAY_OPEN_THREAD'); ?>: <strong><?php echo $this->todayTopicCount; ?></strong> <span class="divider">|</span> <?php echo JText::_('COM_KUNENA_STAT_YESTERDAY_OPEN_THREAD'); ?>: <strong><?php echo intval($this->yesterdayTopicCount); ?></strong></li>
							<li><?php echo JText::_('COM_KUNENA_STAT_TODAY_TOTAL_ANSWER'); ?>: <strong><?php echo intval($this->todayReplyCount); ?></strong> <span class="divider">|</span> <?php echo JText::_('COM_KUNENA_STAT_YESTERDAY_TOTAL_ANSWER'); ?>: <strong><?php echo intval($this->yesterdayReplyCount); ?></strong></li>
						</ul>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
