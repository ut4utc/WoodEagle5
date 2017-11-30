<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Pagination
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;

$display = isset($this->display);

$data = $this->pagination->getData();

$count = count($data->pages);

if ($count == 0)
{
	return;
}
elseif ($count == 1 && empty($display)) return;
$last = 0;
?>

<ul class="kpagination">
	<?php
	echo '<li class="page">' . JText::_('COM_KUNENA_PAGE') . '</li>';
	foreach ($data->pages as $k => $item)
	{
		if ($last + 1 != $k)
		{
			echo '...';
		}

		$last = $k;

		echo $this->subLayout('Widget/Pagination/Item')->set('item', $item);
	}
	?>
</ul>
