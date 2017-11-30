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
// Goto up / down
$locations = array('top','bottom');
if (!isset($this->location)) $this->location = 0;
$goto = '<a name="forum'.$locations[$this->location].'"></a>';
$this->location ^= 1;
$goto .= '<a class="kbuttongoto" href="#forum'.$locations[$this->location].'" rel="nofollow">' . $this->getIcon ( 'kforum'.$locations[$this->location], JText::_('COM_KUNENA_GEN_GOTO'.strtoupper($locations[$this->location] )) ) . '</a>';
?>

<td class="klist-actions-goto">
	<?php echo $goto ?>
</td>
<td class="klist-actions-forum">
	<div class="kmessage-buttons-row">
		<?php echo $this->topicButtons->get('reply') ?>
		<?php echo $this->topicButtons->get('subscribe') ?>
		<?php echo $this->topicButtons->get('favorite') ?>
	</div>
	<div class="kmessage-buttons-row">
		<?php echo $this->topicButtons->get('delete') ?>
		<?php echo $this->topicButtons->get('undelete') ?>
		<?php echo $this->topicButtons->get('moderate') ?>
		<?php echo $this->topicButtons->get('sticky') ?>
		<?php echo $this->topicButtons->get('lock') ?>
	</div>
</td>
