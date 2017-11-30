<?php
/**
 * Kunena Component
 * @package         Kunena.Template.BlueEagle5
 * @subpackage      Layout.Search
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license         http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die;

// FIXME: change into JForm.

// TODO: Add generic form version

JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');

$this->addStyleSheet('assets/css/bootstrap.datepicker.css');
$this->addScript('assets/js/bootstrap.datepicker.js');
$this->addScript('assets/js/search.js');
?>
<div class="kblock kadvsearch">
	<div class="kheader">
		<div class="close" id="toggler" data-toggle="collapse" data-target="#searchform">&times;</div>
		<h2><span><?php echo JText::_('COM_KUNENA_SEARCH_ADVSEARCH'); ?></span></h2>
	</div>
	<div>
		<div class="kbody">
			<form class="collapse in" name="searchform" id="searchform" action="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=search'); ?>" method="post">
				<input type="hidden" name="task" value="results"/>
				<?php if ($this->me->exists()) : ?>
					<input type="hidden" id="kurl_users" name="kurl_users"
					       value="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=user&layout=listmention&format=raw') ?>"/>
				<?php endif; ?>
				<?php echo JHtml::_('form.token'); ?>

				<table id="kforumsearch">
					<tbody id="advsearch">
					<tr class="krow1">
						<td class="kcol">
							<fieldset class="fieldset">
								<legend>
									<?php echo JText::_('COM_KUNENA_SEARCH_SEARCHBY_KEYWORD'); ?>
								</legend>
								<label class="searchlabel" for="keywords">
									<?php echo JText::_('COM_KUNENA_SEARCH_KEYWORDS'); ?>:
								</label>
								<input type="text" name="query" class="ks input" id="keywords"
								       value="<?php echo $this->escape($this->state->get('searchwords')); ?>"/>
								<?php $this->displayModeList('mode'); ?>
							</fieldset>
						</td>
						<td class="kcol">
							<?php if (!$this->config->pubprofile && !JFactory::getUser()->guest || $this->config->pubprofile) : ?>
								<fieldset class="fieldset">
									<legend>
										<?php echo JText::_('COM_KUNENA_SEARCH_SEARCHBY_USER'); ?>
									</legend>
									<label>
										<?php echo JText::_('COM_KUNENA_SEARCH_UNAME'); ?>:
										<input id="kusersearch" data-provide="typeahead" type="text" name="searchuser" autocomplete="off"
										       value="<?php echo $this->escape($this->state->get('query.searchuser')); ?>"/>
									</label>

									<label>
										<?php echo JText::_('COM_KUNENA_SEARCH_EXACT'); ?>:
										<input type="checkbox" name="exactname" value="1"
											<?php if ($this->state->get('query.exactname'))
											{
												echo $this->checked;
											} ?> />
									</label>
								</fieldset>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<th colspan="2">
							<div class="kheader">
								<div class="close" data-toggle="collapse" data-target="#advsearch_options">&times;</div>
								<h2><span><?php echo JText::_('COM_KUNENA_SEARCH_OPTIONS'); ?></span></h2>
							</div>
						</th>
					</tr>
					<tr class="krow1 collapse in" id="advsearch_options">
						<td class="kcol">
							<fieldset class="fieldset">
								<legend>
									<?php echo JText::_('COM_KUNENA_SEARCH_FIND_POSTS'); ?>
								</legend>
								<?php $this->displayDateList('date'); ?>
								<?php $this->displayBeforeAfterList('beforeafter'); ?>
							</fieldset>
						</td>
						<td class="kcol">
							<fieldset class="fieldset">
								<legend>
									<?php echo JText::_('COM_KUNENA_SEARCH_SORTBY'); ?>
								</legend>
								<?php $this->displaySortByList('sort'); ?>
								<?php $this->displayOrderList('order'); ?>
							</fieldset>
						</td>
					</tr>
					<tr class="krow1">
						<td class="kcol">
							<fieldset class="fieldset">
								<legend>
									<?php echo JText::_('COM_KUNENA_SEARCH_AT_A_SPECIFIC_DATE'); ?>
								</legend>
								<div id="searchatdate">
									<div class="input-append date">
										<input type="text" name="searchatdate" data-date-format="mm/dd/yyyy"
										       value="<?php echo JFactory::getDate()->format('m/d/Y'); ?>">
										<span class="input-group-addon"><?php echo KunenaIcons::calendar(); ?></span>
									</div>
								</div>
							</fieldset>
						</td>
						<td class="kcol" colspan="1">
						</td>
					</tr>
					<tr class="krow1">
						<td class="kcol">
							<fieldset class="fieldset">
								<legend>
									<?php echo JText::_('COM_KUNENA_SEARCH_START'); ?>
								</legend>
								<input type="text" name="limitstart"
								       value="<?php echo $this->escape($this->state->get('list.start')); ?>" size="5"/>
								<?php $this->displayLimitlist('limit'); ?>
							</fieldset>

							<?php if ($this->isModerator) : ?>
								<fieldset class="fieldset">
									<legend>
										<?php echo JText::_('COM_KUNENA_SEARCH_SHOW'); ?>
									</legend>
									<label class="radio">
										<input type="radio" name="show" value="0"
											<?php if ($this->state->get('query.show') == 0)
											{
												echo 'checked="checked"';
											} ?> />
										<?php echo JText::_('COM_KUNENA_SEARCH_SHOW_NORMAL'); ?>
									</label>
									<label class="radio">
										<input type="radio" name="show" value="1"
											<?php if ($this->state->get('query.show') == 1)
											{
												echo 'checked="checked"';
											} ?> />
										<?php echo JText::_('COM_KUNENA_SEARCH_SHOW_UNAPPROVED'); ?>
									</label>
									<label class="radio">
										<input type="radio" name="show" value="2"
											<?php if ($this->state->get('query.show') == 2)
											{
												echo 'checked="checked"';
											} ?> />
										<?php echo JText::_('COM_KUNENA_SEARCH_SHOW_TRASHED'); ?>
									</label>
								</fieldset>
							<?php endif; ?>

						</td>
						<td class="kcol">
							<fieldset class="fieldset">
								<legend>
									<?php echo JText::_('COM_KUNENA_SEARCH_SEARCHIN'); ?>
								</legend>
								<?php $this->displayCategoryList('categorylist', 'size="10" multiple="multiple"'); ?>
								<label>
									<input type="checkbox" name="childforums" value="1"
										<?php if ($this->state->get('query.childforums'))
										{
											echo 'checked="checked"';
										} ?> />
									<?php echo JText::_('COM_KUNENA_SEARCH_SEARCHIN_CHILDREN'); ?>
								</label>
							</fieldset>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="kcenter">
							<input class="kbutton ks" type="submit" value="<?php echo JText::_('COM_KUNENA_SEARCH_SEND'); ?>"/>
							<input class="kbutton ks" type="reset" value="<?php echo JText::_('COM_KUNENA_CANCEL'); ?>"
							       onclick="window.location='<?php echo KunenaRoute::_('index.php?option=com_kunena') ?>';"/>
						</td>
					</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</div>
