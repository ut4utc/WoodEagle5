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
    <?php echo $this->subRequest('Widget/Menu'); ?>
</div>
<div id="kprofilebox">
    <?php if (KunenaUserHelper::getMyself()) : ?>
        <?php echo $this->subRequest('Widget/Login'); ?>
    <?php else : ?>
        <?php echo $this->subRequest('Widget/Logout'); ?>
    <?php endif; ?>
</div>
