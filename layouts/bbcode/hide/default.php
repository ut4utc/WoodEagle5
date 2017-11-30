<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.BBCode
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

// [hide]Hidden from guests[/hide]

// Hide content from guests, on users highlight the contents as being hidden from guests.
?>

<?php if ($this->me->exists()) : ?>
	<strong><?php JText::_('COM_KUNENA_BBCODE_HIDE_IN_MESSAGE'); ?></strong>
	<div class="kmsgtext-hide"><?php echo $this->content; ?></div>
<?php else : ?>
	<strong><?php echo JText::_('COM_KUNENA_BBCODE_HIDDENTEXT'); ?></strong>
<?php endif; ?>
