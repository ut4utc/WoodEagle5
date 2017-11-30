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
<div id="ktop">
	<div id="ktopmenu">
		<div id="ktab">
			<?php echo $this->subRequest('Widget/Menu'); ?>
		</div>
	</div>
</div>
<div class="kblock kpbox">
	<div class="kcontainer" id="kprofilebox">
		<div class="kbody">
			<?php if (KunenaUserHelper::getMyself()) : ?>
				<?php echo $this->subRequest('Widget/Login'); ?>
			<?php else : ?>
				<?php echo $this->subRequest('Widget/Logout'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
