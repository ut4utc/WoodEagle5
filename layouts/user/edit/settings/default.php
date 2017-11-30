<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.User
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>

<div class="kblock kedituser">
	<div class="kheader">
		<h2>
			<?php echo $this->headerText; ?>
		</h2>
	</div>
	<div class="kcontainer">
		<div class="kbody">
			<table class="table table-bordered table-striped table-hover">
				<tbody>
				<?php foreach ($this->settings as $field) : ?>
					<tr>
						<td class="span3">
							<?php echo $field->label; ?>
						</td>
						<td>
							<?php echo $field->field; ?>
						</td>
					</tr>
				<?php endforeach ?>
				<tr>
					<td class="span3"><?php echo JText::_('COM_KUNENA_USER_SETTINGS_CLEAR');?></td>
					<td>
						<button type="button" class="kbutton" onClick="window.localStorage.clear()" data-loading-text="Loading..."><?php echo JText::_('COM_KUNENA_USER_SETTINGS_CLEAR');?></button>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
