<?php
/**
 * Kunena Component
 *
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Widget
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

$label = JText::_("COM_KUNENA_BUTTON_{$this->scope}_{$this->name}");


$primary = !empty($this->primary) ? ' btn-primary' : '';
?>
<a id="btn_<?php echo $this->name ?>" class="btn <?php echo $primary; ?>" href="<?php echo $this->url; ?>"
	title="<?php echo $this->name; ?>">
	<span class="<?php echo $this->name; ?>"></span>
	<?php echo $label; ?>
</a>
