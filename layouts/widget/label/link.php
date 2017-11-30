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

$label = $this->label;
$link = ' href="' . $this->link . '"';
$tooltip = ' data-toggle="tooltip"';
$description = isset($this->description) ? $tooltip . ' title="' . $this->description . '"' : '';
$class = ' class="label label-' . $this->state . ' ' . '"';
?>
<a <?php echo $link . $description . $class; ?>>
	<?php echo $label; ?>
</a>
