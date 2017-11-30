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

// [size=6]HUGE![/size]

// Change text size.
$size_css = array(1 => '0.6em', '0.8em', '1em', '1.2em', '1.4em', '1.8em');

if (isset($size_css[$this->size]))
{
	$class = 'style="font-size:' . $size_css[$this->size] . '"';
}
elseif ($this->size)
{
	// One of: px em pt %
	$class = 'style="font-size:' . $this->size . '"';
}
else
{
	$class = 'style="font-size:' . $size_css[3] . '"';
}
?>
<span <?php echo $class; ?>><?php echo $this->content; ?></span>
