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
$email = $this->profile->email && !$this->profile->hideEmail && $this->profile->config->showemail || $this->me->isModerator() || $this->profile->userid == $this->me->userid;
$tabs = $this->getTabs();
?>

<div class="kblock k-profile">
	<div class="kheader">
		<h2><span class="k-name"><?php echo JText::_('COM_KUNENA_USER_PROFILE'); ?> <?php echo $this->profile->getLink();?></span>
			<?php if ($this->profile->isAuthorised('edit') || $this->me->isAdmin()) : ?>
				<?php echo $this->profile->getLink(
					KunenaIcons::edit() . ' ' . JText::_('COM_KUNENA_EDIT'),
					JText::_('COM_KUNENA_EDIT'), 'nofollow', 'edit', 'btn pull-right'
				); ?>
			<?php endif; ?></h2>
	</div>
	<div class="kcontainer">
		<div class="kbody">
			<table class = "kblocktable" id ="kprofile">
				<tr>
					<td class = "kcol-first kcol-left">
						<div id="kprofile-leftcol">
							<?php
							echo $this->subLayout('User/Item/Summary')
								->set('profile', $this->profile)
								->set('config', $this->config);
							?>
						</div>
					</td>
					<td class="kcol-mid kcol-right">
						<div id="kprofile-rightcol">
							<div id="kprofile-rightcoltop">
								<div class="kprofile-rightcol2">
									<?php
									echo $this->subLayout('User/Item/Social')
										->set('profile', $this->profile)
										->set('config', $this->config);
									?>
								</div>
								<div class="kprofile-rightcol1">
									<ul>
										<?php if (!empty($this->profile->location)) :?>
										<li><span class="kicon-profile kicon-profile-location"></span><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_LOCATION'); ?>:</strong> <?php echo $this->profile->location; ?></li>
										<?php endif; ?>

										<?php if (!empty($this->profile->genderclass) && $this->profile->genderclass > 0 ) :?>
										<li><span class="kicon-profile kicon-profile-gender-<?php echo $this->profile->genderclass; ?>"></span><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_GENDER'); ?>:</strong> <?php echo $this->profile->gender; ?></li>
										<?php endif; ?>

										<?php if (!empty($this->profile->birthdate) && $this->profile->birthdate != '0001-01-01') :?>
										<li class="bd"><span class="kicon-profile kicon-profile-birthdate"></span><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_BIRTHDATE'); ?>:</strong> <span title="<?php echo KunenaDate::getInstance($this->profile->birthdate)->toKunena('ago', 'GMT'); ?>"><?php echo KunenaDate::getInstance($this->profile->birthdate)->toKunena('date', 'GMT'); ?></span>
										</li>
										<?php endif; ?>
									</ul>
								</div>
							</div>

							<div id="kprofile-rightcolbot">
								<div class="kprofile-rightcol2">
									<?php if ($this->profile->email || !empty($this->profile->websiteurl)): ?>
										<ul>
											<?php if ($email): ?>
												<li><span class="kicon-profile kicon-profile-email"></span><?php echo $this->profile->email; ?></li>
											<?php endif; ?>
											<?php if (!empty($this->profile->websiteurl)): ?>
												<li><span class="kicon-profile kicon-profile-website"></span><a href="<?php echo $this->escape($this->profile->websiteurl); ?>" target="_blank"><?php echo KunenaHtmlParser::parseText(trim($this->profile->websitename) ? $this->profile->websitename : $this->profile->websiteurl); ?></a></li>
											<?php endif; ?>
										</ul>
									<?php endif;?>
								</div>
								<div class="kprofile-rightcol1">
									<h4><?php echo JText::_('COM_KUNENA_MYPROFILE_SIGNATURE'); ?></h4>
									<div class="kmsgsignature"><div><?php echo $this->profile->signature ?></div></div>
								</div>
							</div>
							<div class="clrline"></div>

							<div class="tabs hidden-phone">
								<br />
								<br />

								<ul class="nav nav-tabs">
									<?php foreach ($tabs as $name => $tab) : ?>
										<li<?php echo $tab->active ? ' class="active"' : ''; ?>>
											<a href="#<?php echo $name; ?>" data-toggle="tab" rel="nofollow"><?php echo $tab->title; ?></a>
										</li>
									<?php endforeach; ?>
								</ul>
								<div class="tab-content">

									<?php foreach ($tabs as $name => $tab) : ?>
										<div class="tab-pane fade<?php echo $tab->active ? ' in active' : ''; ?>" id="<?php echo $name; ?>">
											<div>
												<?php echo $tab->content; ?>
											</div>
										</div>
									<?php endforeach; ?>

								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="clearfix"></div>
