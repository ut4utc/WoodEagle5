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

$state = isset($this->state) ? ' ' . $this->state : ' hide';
$transition = isset($this->transition) ? ' ' . $this->transition : ' fade';

$id = ' id="' . $this->id . '"';
$class = 'class="modal' . $state . $transition . '"';
$name = ' name="' . $this->name . '"';
$label  = $this->label;
$description  = $this->description;
$data = $this->data;
$form = $this->form;
?>
<div <?php echo $class . $id?> data-backdrop="false">
	<div class="modal-header">
		<button type="button" role="presentation" class="close" data-dismiss="modal">x</button>
		<h3><?php echo $label ?></h3>
	</div>
	<div class="modal-body">
		<p><?php echo $description ?></p>
		<div class="control-group">
			<div class="controls">
				<textarea <?php echo $name ?> style="resize: none; text-align: left;" class="input-block-level" rows="3" maxlength="255"><?php echo $data; ?></textarea>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" type="button" data-dismiss="modal">
			<?php echo JText::_('JCANCEL'); ?>
		</button>
		<button class="btn btn-primary" type="submit" onclick="Joomla.submitbutton('<?php echo $form ?> ');">
			<?php echo JText::_('JSUBMIT'); ?>
		</button>
	</div>
</div>
