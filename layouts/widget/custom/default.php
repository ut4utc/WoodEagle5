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
?>

<div class="kblock kdefault">
	<div class="kheader">
		<h2><?php echo $this->header; ?></h2>
	</div>
	<div class="kcontainer">
		<div class="kbody">
			<div class="kcontent khelprulescontent">
				<?php echo $this->body; ?>
			</div>
		</div>
	</div>
</div>
