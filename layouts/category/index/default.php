<?php
/**
 * Kunena Component
 *
 * @package         Kunena.Template.BlueEagle5
 * @subpackage      Layout.Category
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license         http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

/** @var KunenaForumCategory $section */
/** @var KunenaForumCategory $category */
/** @var KunenaForumCategory $subcategory */

defined('_JEXEC') or die;
?>

<div class="klist-markallcatsread">
    <div class="fltlft">
        <?php if (!empty(KunenaForumCategoryHelper::get()->getMarkReadUrl())) : ?>
            <form action="<?php echo KunenaRoute::_('index.php?option=com_kunena') ?>" name="markAllForumsRead" method="post">
                <input type="hidden" name="view" value="category" />
                <input type="hidden" name="task" value="markread" />

                <?php echo JHtml::_( 'form.token' ); ?>
                <input type="submit" class="kbutton ks" value="<?php echo JText::_('COM_KUNENA_MARK_ALL_READ'); ?>" />
            </form>
        <?php endif;?>
    </div>
    <div class="fltrt">
        <?php if ($this->config->enableforumjump)
        {
        echo $this->subLayout('Widget/Forumjump')->set('categorylist', $this->categorylist);
        } ?>
    </div>
</div>

<?php
$mmm    = 0;
$config = KunenaFactory::getTemplate()->params;

if ($config->get('displayModule'))
{
	echo $this->subLayout('Widget/Module')->set('position', 'kunena_index_top');
}

foreach ($this->sections as $section) :
	$markReadUrl = $section->getMarkReadUrl();

	if ($config->get('displayModule'))
	{
		echo $this->subLayout('Widget/Module')->set('position', 'kunena_section_top_' . ++$mmm);
	}
	?>
	<?php if ($this->categories[$section->id]) :?>
	<div class="kblock kcategories-<?php echo $section->id; ?>">
		<div class="kheader">
			<?php if (count($this->sections) > 0) : ?>
				<div class="close" data-toggle="collapse" data-target="#section<?php echo $section->id; ?>">&times;</div>
			<?php endif; ?>

			<h1>
				<?php echo $this->getCategoryLink($section, $this->escape($section->name), null, 'hasTooltip', true, false); ?>
			</h1>
			<?php if (!empty($section->description)) : ?>
				<div class="ktitle-desc km hidden-phone ">
					<?php echo $section->displayField('description'); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="kblock kflat collapse in" id="section<?php echo $section->id; ?>">
			<div>
				<div class="kbody">
					<table class="kblocktable" id="kflattable">
						<?php if ($section->isSection() && empty($this->categories[$section->id]) && empty($this->more[$section->id])) : ?>
							<tr>
								<td>
									<h4>
										<?php echo JText::_('COM_KUNENA_GEN_NOFORUMS'); ?>
									</h4>
								</td>
							</tr>
						<?php else : ?>
							<?php
							foreach ($this->categories[$section->id] as $category) : ?>
								<tr class="krow2" id="kcat2">
									<td class="kcol-first kcol-category-icon hidden-phone">
										<?php if (empty($category->icon) && empty (KunenaFactory::getTemplate()->params->get('DefaultCategoryicon'))) : ?>
											<?php if ($category->getNewCount()) :?>
												<span class="kicon kunreadforum icon-knewchar"></span>
											<?php else : ?>
												<span class="kicon kreadforum"></span>
											<?php endif; ?>
										<?php else : ?>
											<?php echo $this->getCategoryLink($category, $this->getCategoryIcon($category), ''); ?>
										<?php endif; ?>
									</td>
									<td class="kcol-mid kcol-kcattitle">
										<div class="kthead-title kl">
												<span>
													<?php echo $this->getCategoryLink($category, $category->name, null, KunenaTemplate::getInstance()->tooltips(), true, false); ?>
												</span>

												<?php if (($new = $category->getNewCount()) > 0) : ?>
													<span class="knewchar"> (<?php echo $new . ' ' . JText::_('COM_KUNENA_A_GEN_NEWCHAR'); ?>)</span>
												<?php endif; ?>

												<?php if ($category->locked) : ?>
													<span <?php echo KunenaTemplate::getInstance()->tooltips(true);?> title="<?php echo JText::_('COM_KUNENA_LOCKED_CATEGORY') ?>"><?php echo KunenaIcons::lock(); ?></span>
												<?php endif; ?>
												<?php if ($category->review) : ?>
													<span <?php echo KunenaTemplate::getInstance()->tooltips(true);?> title="<?php echo JText::_('COM_KUNENA_GEN_MODERATED') ?>"><?php echo KunenaIcons::shield(); ?></span>
												<?php endif; ?>
												<?php if (KunenaFactory::getConfig()->enablerss) : ?>
													<span>
														<a href="<?php echo $this->getCategoryRSSURL($category->id); ?>" rel="alternate" type="application/rss+xml">
															<?php echo KunenaIcons::rss(); ?>
														</a>
													</span>
												<?php endif; ?>
										</div>

										<?php if (!empty($category->description)) : ?>
											<div class="kthead-desc km hidden-phone"><?php echo $category->displayField('description'); ?></div>
										<?php endif; ?>

										<?php
										// Display subcategories
										if (!empty($this->categories[$category->id])) : ?>
											<div class="kthead-child">
												<div class="kcc-table">
													<div class="kcc-subcat km">

														<?php foreach ($this->categories[$category->id] as $subcategory) : ?>
															<?php if (!empty($subcategory->icon)) : ?>
															<span>
																<?php $totaltopics = $subcategory->getTopics() > 0 ? JText::plural('COM_KUNENA_X_TOPICS_MORE', $this->formatLargeNumber($subcategory->getTopics())) : JText::_('COM_KUNENA_X_TOPICS_0'); ?>

																<?php echo $this->getCategoryLink($subcategory, $this->getSmallCategoryIcon($subcategory), '', null, true, false) . $this->getCategoryLink($subcategory, '', null, null, true, false) . '<small class="hidden-phone muted"> ('
																	. $totaltopics . ')</small>';

																if (($new = $subcategory->getNewCount()) > 0)
																{
																	echo '<span class="knewchar">(' . $new . ' ' . JText::_('COM_KUNENA_A_GEN_NEWCHAR') . ')</span>';
																}
																?>
															</span>
															<?php else :; ?>
																<span class="kicon kreadforum-sm">
																<?php $totaltopics = $subcategory->getTopics() > 0 ? JText::plural('COM_KUNENA_X_TOPICS_MORE', $this->formatLargeNumber($subcategory->getTopics())) : JText::_('COM_KUNENA_X_TOPICS_0'); ?>

																<?php echo '<span style="padding-left: 15px;">' . $this->getCategoryLink($subcategory, null, null, null, true, false) . '</span>'; ?>

																<?php echo	'<small class="hidden-phone muted"> ('
																	. $totaltopics . ')</small>';

																if (($new = $subcategory->getNewCount()) > 0)
																{
																	echo '<sup class="knewchar">(' . $new . ' ' . JText::_('COM_KUNENA_A_GEN_NEWCHAR') . ')</sup>';
																}
																?>
															</span>
															<?php endif; ?>
														<?php endforeach; ?>

														<?php if (!empty($this->more[$category->id])) : ?>
															<span class="kchildcount ks">
																<?php echo $this->getCategoryLink($category, JText::_('COM_KUNENA_SEE_MORE'), null, null, true, false); ?>
																<small class="hidden-phone muted">
																	(<?php echo JText::sprintf('COM_KUNENA_X_HIDDEN', (int) $this->more[$category->id]); ?>
																	)
																</small>
															</span>
														<?php endif; ?>

													</div>
												</div>
											</div>

										<?php endif; ?>
										<div class="clearfix"></div>
										<?php if ($category->getmoderators() && KunenaConfig::getInstance()->listcat_show_moderators) : ?>
											<br/>
											<div class="moderators">
												<?php
												// get the Moderator list for display
												$modslist = array();
												foreach ($category->getmoderators() as $moderator)
												{
													$modslist[] = KunenaFactory::getUser($moderator)->getLink(null, null, '');
												}

												echo JText::_('COM_KUNENA_MODERATORS') . ': ' . implode(', ', $modslist);
												?>
											</div>
										<?php endif; ?>

										<?php if (!empty($this->pending[$category->id])) : ?>
											<div class="alert" style="margin-top:20px;">
												<a class="alert-link"
												   href="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=topics&layout=posts&mode=unapproved&userid=0&catid=' . intval($category->id)); ?>"
												   title="<?php echo JText::_('COM_KUNENA_SHOWCAT_PENDING') ?>"
												   rel="nofollow"><?php echo intval($this->pending[$category->id]) . ' ' . JText::_('COM_KUNENA_SHOWCAT_PENDING') ?></a>
											</div>
										<?php endif; ?>
									</td>

									<td class="kcol-mid kcol-kcattopics hidden-phone">
										<span class="kcat-topics-number"><?php echo $this->formatLargeNumber ( $category->getTopics() ) ?></span>
										<span class="kcat-topics"><?php echo JText::_('COM_KUNENA_TOPICS');?></span>
									</td>

									<td class="kcol-mid kcol-kcatreplies hidden-phone">
										<span class="kcat-replies-number"><?php echo $this->formatLargeNumber ( $category->getReplies() ) ?></span>
										<span class="kcat-replies"><?php echo JText::_('COM_KUNENA_GEN_REPLIES');?> </span>
									</td>

									<?php $last = $category->getLastTopic(); ?>

									<?php if ($last->exists()) :
										$author = $last->getLastPostAuthor();
										$time = $last->getLastPostTime();
										$avatar = $this->config->avataroncat ? $author->getAvatarImage(KunenaFactory::getTemplate()->params->get('avatarType'), 'list') : null;
										?>

										<td class="kcol-mid kcol-kcatlastpost">
											<?php if ($avatar) : ?>
											<div class="klatest-avatar hidden-phone">
												<?php echo $author->getLink($avatar); ?>
											</div>
											<?php endif; ?>
											<div class="klatest-subject-by ks hidden-phone">
												<div><?php echo $this->getLastPostLink($category, null, null, null, null, false, true) ?></div>
												<div><?php echo JText::sprintf('COM_KUNENA_BY_X', $author->getLink(null, '', '', '', null, $category->id)); ?></div>
												<div><?php echo $time->toKunena('config_post_dateformat'); ?></div>
											</div>
										</td>
									<?php else : ?>
										<td class="kcol-mid kcol-knoposts">
                                            <?php echo JText::_('COM_KUNENA_X_TOPICS_0'); ?>
										</td>
									<?php endif; ?>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>

						<?php if (!empty($this->more[$section->id])) : ?>
							<tr>
								<td colspan="3">
									<h4>
										<?php echo $this->getCategoryLink($section, JText::sprintf('COM_KUNENA_SEE_ALL_SUBJECTS')); ?>
										<small>(<?php echo JText::sprintf('COM_KUNENA_X_HIDDEN', (int) $this->more[$section->id]); ?>)</small>
									</h4>
								</td>
							</tr>
						<?php endif; ?>

					</table>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

	<!-- Begin: Category Module Position -->
	<?php
	if ($config->get('displayModule'))
	{
		echo $this->subLayout('Widget/Module')->set('position', 'kunena_section_' . ++$mmm);
	} ?>
	<!-- Finish: Category Module Position -->
<?php endforeach;

if ($config->get('displayModule'))
{
	echo $this->subLayout('Widget/Module')->set('position', 'kunena_index_bottom');
}
