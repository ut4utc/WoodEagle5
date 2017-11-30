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

$pathway = $this->breadcrumb->getPathway();
$item = array_shift($pathway);

if ($item) : ?>
<div class="kblock kpathway breadcrumbs-2">
	<div class="kcontainer">
		<div class="ksectionbody">
			<div class="kforum-pathway">
				<div class="path-element-first">
					<a href="<?php echo $item->link; ?>" rel="nofollow"><?php echo $this->escape($item->name); ?></a>
				</div>

				<?php foreach($pathway as $item) : ?>
				<div class="path-element">
					<a href="<?php echo $item->link; ?>" rel="nofollow"><?php echo $this->escape($item->name); ?></a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
