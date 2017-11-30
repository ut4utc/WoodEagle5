<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Topic
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

// TODO: Hide KunenaHtmlParser::parseText()
$this->addScript('assets/js/poll.js');
?>

<?php if ($this->show_title) : ?>
<div class="pull-right btn btn-small" data-toggle="collapse" data-target="#poll-results">&times;</div>
<h2>
	<?php echo JText::_('COM_KUNENA_POLL_NAME'); ?> <?php echo KunenaHtmlParser::parseText($this->poll->title); ?>
</h2>
<?php endif; ?>

<div class="collapse in" id="poll-results" <?php echo $this->show_title ? '' : 'style="display:none;"'; ?>>
<table class="table table-striped table-bordered table-condensed">

	<?php
	foreach ($this->poll->getOptions() as $option) :
		$percentage = round(($option->votes * 100) / max($this->poll->getTotal(), 1), 1);
	?>
	<tr>
		<td>
			<?php echo KunenaHtmlParser::parseText($option->text); ?>
		</td>
		<td class="span8">
			<div class="progress progress-striped">
				<div class="bar" style="height:30px;width:<?php echo $percentage; ?>%;"></div>
			</div>
		</td>
		<td>
			<?php
			if (isset($option->votes) && $option->votes > 0)
			{
				echo $option->votes;
			} else {
				echo JText::_('COM_KUNENA_POLL_NO_VOTE');
			}
			?>
		</td>
		<td>
			<?php echo $percentage; ?>%
		</td>
	</tr>
	<?php endforeach; ?>

	<tfoot>
		<tr>
			<td colspan="4">
				<?php
				echo JText::_('COM_KUNENA_POLL_VOTERS_TOTAL') . " <b>" . $this->usercount . "</b> ";
				if (!empty($this->users_voted_list)): echo " ( " . implode(', ', $this->users_voted_list) . " ) "; ?>
				<?php if ($this->usercount > '5') : ?>
					<a href="#" id="kpoll-moreusers"><?php echo JText::_('COM_KUNENA_POLLUSERS_MORE')?></a>
					<div style="display: none;" id="kpoll-moreusers-div">
						<?php echo implode(', ', $this->users_voted_morelist); ?>
					</div>
				<?php endif;
				endif; ?>
			</td>
		</tr>

		<?php if (!$this->me->exists()) : ?>
		<tr>
			<td colspan="4">
				<?php echo JText::_('COM_KUNENA_POLL_NOT_LOGGED'); ?>

				<?php elseif ($this->topic->isAuthorised('poll.vote') && $this->show_title && $this->topic->isAuthorised('reply')) : ?>

				<a href="<?php echo KunenaRoute::_("index.php?option=com_kunena&view=topic&layout=vote&catid={$this->category->id}&id={$this->topic->id}"); ?>>">
					<?php echo JText::_('COM_KUNENA_POLL_BUTTON_VOTE'); ?>
				</a>
				<?php endif; ?>

				<?php if ($this->me->isModerator($this->category)) : ?>
				<a href="#resetVotes" role="button" class="btn" data-toggle="modal">
					<?php echo JText::_('COM_KUNENA_TOPIC_VOTE_RESET'); ?>
				</a>
				<div class="clearfix"></div>
				<br />
				<div id="resetVotes" class="modal hide fade">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3>
							<?php echo JText::_('COM_KUNENA_TOPIC_MODAL_LABEL_VOTE_RESET'); ?>
						</h3>
					</div>
					<div class="modal-body">
						<p><?php echo JText::_('COM_KUNENA_TOPIC_MODAL_DESC_VOTE_RESET'); ?></p>
					</div>
					<div class="modal-footer">
						<a data-dismiss="modal" aria-hidden="true" class="btn">
							<?php echo JText::_('COM_KUNENA_TOPIC_MODAL_LABEL_CLOSE_RESETVOTE'); ?>
						</a>
						<a href="<?php echo KunenaRoute::_("index.php?option=com_kunena&view=topic&catid={$this->category->id}&id={$this->topic->id}&pollid={$this->poll->id}&task=resetvotes&" . JSession::getFormToken() . '=1') ?>" class="btn btn-primary">
							<?php echo JText::_('COM_KUNENA_TOPIC_MODAL_LABEL_CONFIRM_RESETVOTE'); ?>
						</a>
					</div>
				</div>
			</td>
		</tr>
		<?php endif; ?>
	</tfoot>
</table>
</div>
