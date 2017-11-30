<?php
/**
 * Kunena Component
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Layout.Search
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die;
?>

<?php if($this->results): ?>
	<div class="kblock ksearchresult">
		<div class="kheader">
			<div class="close" data-toggle="collapse" data-target="#ksearchresult">&times;</div>
			<h2>
			<span>
				<?php echo JText::_('COM_KUNENA_SEARCH_RESULTS'); ?>
			</span>
			</h2>
			<div class="ksearchresult-desc km">
				<span><?php echo JText::sprintf ('COM_KUNENA_FORUM_SEARCH', $this->escape($this->state->get('searchwords')) ); ?></span>
			</div>
		</div>
		<div class="kcontainer" id="ksearchresult">
			<div class="kbody">
				<?php if ($this->error) : ?>
					<div>
						<?php echo $this->error; ?>
					</div>
				<?php endif; ?>

				<?php
				foreach ($this->results as $message)
				{
					// TODO: use the default message layout...
					echo $this->subLayout('Search/Results/Row')->set('message', $message);
				}
				?>

				<?php echo $this->subLayout('Widget/Pagination/List')->set('pagination', $this->pagination); ?>

			</div>
		</div>
	</div>

	<?php
	$start = $this->pagination->limitstart + 1;
	$stop = $this->pagination->limitstart + count($this->results);
	$range = $start . ' - ' . $stop;
	echo JText::sprintf('COM_KUNENA_FORUM_SEARCHRESULTS', $range, $this->pagination->total); ?>
<?php endif; ?>
