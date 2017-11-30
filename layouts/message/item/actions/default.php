<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Message
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

$config = KunenaConfig::getInstance();
$this->ktemplate = KunenaFactory::getTemplate();
$fullactions = $this->ktemplate->params->get('fullactions');
$quick = $this->ktemplate->params->get('quick');
$me = KunenaUserHelper::getMyself();
$this->addScriptDeclaration("kreplyid = '#kreply".$this->message->id."';");
$this->addScriptDeclaration("kform = '#kreply".$this->message->id."_form';");
?>
<?php if ($this->message->getAuthor()->getSignature()) : ?>
	<div class="kmsgsignature">
		<?php echo $this->message->getAuthor()->getSignature() ?>
	</div>
<?php endif ?>
<div class="kmessage-editmarkup-cover hidden-phone">
	<?php if ($this->message->modified_by && $config->editmarkup) : ?>

	<span class="kmessage-editmarkup hidden-phone">
		<?php echo JText::_('COM_KUNENA_EDITING_LASTEDIT') . ': ' . JText::_('COM_KUNENA_BY') . ' ' .
			$this->message->getModifier()->getLink() . '.'; ?>
		<?php if ($this->message->modified_reason) echo JText::_('COM_KUNENA_REASON') . ': ' .
			$this->escape ( $this->message->modified_reason ); ?>
	</span>
	<?php endif ?>


	<?php if ($config->reportmsg && $me->exists()) :?>
		<span class="kmessage-informmarkup hidden-phone"><a href="<?php echo 'index.php?option=com_kunena&view=topic&layout=report&catid=' . $this->message->getCategory()->id . '&id=1&mesid=' . $this->message->id ;?>"><?php echo JText::_('COM_KUNENA_REPORT');?><a/></span>
	<?php endif ?>
	<?php if ($config->hide_ip && !empty($this->message->ip) && $me->isModerator()) :?>
		<span class="kmessage-informmarkup hidden-phone">IP <?php echo $this->message->ip ?></span>
	<?php endif ?>
</div>

<div class="kmessage-buttons-cover">
	<div class="kmessage-buttons-row">
		<?php if (empty($this->message_closed)) : ?>
			<?php if($this->quickreply && $quick != 2) : ?>
				<a data-related="kreply<?php echo $this->message->displayField('id'); ?>_form" role="button" class="btn btn-default Kreplyclick"
				   rel="nofollow"><?php echo KunenaIcons::undo() . ' ' . JText::_('COM_KUNENA_MESSAGE_ACTIONS_LABEL_QUICK_REPLY'); ?>
				</a>
			<?php endif; ?>
			<?php echo $this->messageButtons->get('reply'); ?>
			<?php echo $this->messageButtons->get('quote'); ?>
			<?php echo $this->messageButtons->get('edit'); ?>
			<?php echo $this->messageButtons->get('moderate'); ?>
			<?php echo $this->messageButtons->get('delete'); ?>
			<?php echo $this->messageButtons->get('permdelete'); ?>
			<?php echo $this->messageButtons->get('undelete'); ?>
			<?php echo $this->messageButtons->get('publish'); ?>
		<?php else : ?>
			<?php echo $this->message_closed; ?>
			<?php if( !$this->topic->locked ) : ?>
				<?php echo $this->messageButtons->get('edit'); ?>
				<?php echo $this->messageButtons->get('moderate'); ?>
				<?php echo $this->messageButtons->get('delete'); ?>
				<?php echo $this->messageButtons->get('permdelete'); ?>
				<?php echo $this->messageButtons->get('undelete'); ?>
				<?php echo $this->messageButtons->get('publish'); ?>
			<?php endif ?>
		<?php endif ?>
	</div>
</div>
<?php if($this->messageButtons->get('thankyou')): ?>
	<div class="kpost-thankyou">
		<?php echo $this->messageButtons->get('thankyou'); ?>
	</div>
<?php endif; ?>
<?php if($this->messageButtons->get('unthankyou')): ?>
	<div class="kpost-unthankyou">
		<?php echo $this->messageButtons->get('unthankyou'); ?>
	</div>
<?php endif; ?>
