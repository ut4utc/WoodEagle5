<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Category
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>
<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=category') ?>" method="post" name="kcategoryform" id="kcategoryform">
	<?php echo JHtml::_('form.token'); ?>

	<table class="kblocktable" id="kflattable">

		<?php if (!empty($this->actions) && !empty($this->categories)) : ?>
			<thead>
				<tr>
					<th colspan="3"></th>
					<th class="center">
						<input class="kcheckallcategories" type="checkbox" name="toggle" value="" />
					</th>
				</tr>
			</thead>
		<?php endif; ?>

		<?php if (empty($this->categories)) : ?>
			<tbody>
				<tr>
					<td>
						<?php echo JText::_('COM_KUNENA_CATEGORY_SUBSCRIPTIONS_NONE') ?>
					</td>
				</tr>
			</tbody>
		<?php else : ?>
			<tbody>
				<?php
				foreach ($this->categories as $this->category)
				{
					echo $this->subLayout('Category/List/Row')
						->set('category', $this->category)
						->set('config', $this->config)
						->set('checkbox', !empty($this->actions));
				}
				?>
			</tbody>
		<?php endif; ?>

	</table>
</form>
