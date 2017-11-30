<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Statistics
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>
<?php if ($this->config->showgenstats) : ?>
	<div class="kblock kgenstats">
		<div class="kheader">
			<span class="ktoggler"><a title="Collapse" class="ktoggler close" rel=""></a></span>
			<h1>
				<?php echo JText::_('COM_KUNENA_STAT_FORUMSTATS'); ?>
			</h1>
		</div>
		<div class="kcontainer" id="kgenstats_tbody">
			<div class="kbody">
				<table class="kblocktable">
					<tbody>
						<tr class="ksth">
							<th colspan="2"><?php echo JText::_('COM_KUNENA_STAT_GENERAL_STATS'); ?></th>
						</tr>
						<tr class="krow1">
							<td class="kcol-first"><div class="kstatsicon"></div></td>
							<td class="kcol-mid">
								<?php echo JText::_('COM_KUNENA_STAT_TOTAL_USERS'); ?>:
								<b>
									<?php if ($this->userlistUrl) : ?>
										<a href="<?php echo $this->userlistUrl; ?>"><?php echo $this->memberCount; ?></a>
									<?php else : ?>
										<?php echo $this->memberCount; ?>
									<?php endif; ?>
								</b>

								<?php echo JText::_('COM_KUNENA_STAT_LATEST_MEMBERS'); ?>:
								<b><?php echo $this->latestMemberLink ?></b>

								<br/>

								<?php echo JText::_('COM_KUNENA_STAT_TOTAL_MESSAGES'); ?>:
								<b><?php echo (int) $this->messageCount; ?></b>

								<?php echo JText::_('COM_KUNENA_STAT_TOTAL_SUBJECTS'); ?>:
								<b><?php echo (int) $this->topicCount; ?></b>

								<?php echo JText::_('COM_KUNENA_STAT_TOTAL_SECTIONS'); ?>:
								<b><?php echo (int) $this->sectionCount; ?></b>

								<?php echo JText::_('COM_KUNENA_STAT_TOTAL_CATEGORIES'); ?>:
								<b><?php echo (int) $this->categoryCount; ?></b>

								<br/>

								<?php echo JText::_('COM_KUNENA_STAT_TODAY_OPEN_THREAD'); ?>:
								<b><?php echo (int) $this->todayTopicCount; ?></b>

								<?php echo JText::_('COM_KUNENA_STAT_YESTERDAY_OPEN_THREAD'); ?>:
								<b><?php echo (int) $this->yesterdayTopicCount; ?></b>

								<?php echo JText::_('COM_KUNENA_STAT_TODAY_TOTAL_ANSWER'); ?>:
								<b><?php echo (int) $this->todayReplyCount; ?></b>

								<?php echo JText::_('COM_KUNENA_STAT_YESTERDAY_TOTAL_ANSWER'); ?>:
								<b><?php echo (int) $this->yesterdayReplyCount; ?></b>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php
$tabclass = array("row1","row2");
$k = 0;
?>
<?php foreach ($this->top as $top) : ?>
	<div class="kblock kpopsubjstats">
		<div class="kheader">
			<span class="ktoggler"><a class="ktoggler close" title="<?php echo JText::_('COM_KUNENA_TOGGLER_COLLAPSE') ?>" rel="kpopsubstats-tbody"></a></span>
			<h2><span><?php echo $top[0]->title ?></span></h2>
		</div>
		<div class="kcontainer" id="kpopsubstats-tbody">
			<div class="kbody">
				<table class="kblocktable">
					<tbody>
					<tr class="ksth" >
						<th>#</th>
						<th class="kname"><?php echo $top[0]->titleName ?></th>
						<th class="kbar">&nbsp;</th>
						<th class="kname"><?php echo $top[0]->titleCount ?></th>
					</tr>
					<?php foreach ($top as $id=>$item) : ?>
						<tr class="k<?php echo $this->escape($tabclass[$id & 1]); ?>">
							<td class="kcol-first"><?php echo $id+1 ?></td>
							<td class="kcol-mid">
								<?php echo $item->link ?>
							</td>
							<td class="kcol-mid">
								<img class="kstats-bar" src="<?php echo JURI::root(true) ?>/components/com_kunena/template/blue_eagle5/assets/images/bar.png" alt="" height="10" width="<?php echo $item->percent ?>%" />
							</td>
							<td class="kcol-last">
								<?php echo $item->count ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endforeach; ?>
