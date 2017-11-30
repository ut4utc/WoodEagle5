<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Credits
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>

<h1>
	<?php echo JText::_('COM_KUNENA') . ' - ' . JText::_('COM_KUNENA_CREDITS_PAGE_TITLE'); ?>
</h1>

<div id="credits">
	<h2 class="container-fluid pull-left">
		<img src="<?php echo $this->logo; ?>" width="48" height="48" alt="Kunena" />
	</h2>
	<p class="intro">
		<?php echo $this->intro; ?>
	</p>
	<div class="clearfix"></div>

	<div class="credits">

		<dl class="dl-horizontal">
			<?php foreach($this->memberList as $member) : ?>
			<dt>
				<a href="<?php echo $member['url']; ?>" target="_blank" rel="follow"><?php echo $this->escape($member['name']); ?></a>
			</dt>
			<dd>
				<?php echo $member['title']; ?>
			</dd>
			<hr class="hr-condensed">
			<?php endforeach ?>
			<dt><a><?php echo JText::_('COM_KUNENA_DONATE');?></a></dt>
			<dd>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input name="cmd" type="hidden" value="_s-xclick">
					<input name="hosted_button_id" type="hidden" value="TPKVQFBQPFSLU">
					<input name="submit" type="image" alt="PayPal - The safer, easier way to pay online!" src="https://www.paypalobjects.com/en_US/NL/i/btn/btn_donateCC_LG.gif" border="0">
					<img width="1" height="1" alt="" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" border="0">
				</form>
			</dd>
			<hr class="hr-condensed">
		</dl>

		<p>
			<?php echo $this->thanks; ?>
		</p>

		<p>
			<?php echo JText::_('COM_KUNENA_CREDITS_GO_BACK'); ?>
			<a href="javascript:window.history.back()" title="<?php echo JText::_('COM_KUNENA_CREDITS_GO_BACK'); ?>">
				<?php echo JText::_('COM_KUNENA_USER_RETURN_B'); ?>
			</a>
		</p>

		<p class="center">
			<?php echo JText::_('COM_KUNENA_COPYRIGHT'); ?> &copy; 2008 - 2017 <a href = "https://www.kunena.org" target = "_blank">Kunena</a>,
			<?php echo JText::_('COM_KUNENA_LICENSE'); ?>: <a href = "http://www.gnu.org/copyleft/gpl.html" target = "_blank">GNU GPL</a>
		</p>
	</div>
</div>
