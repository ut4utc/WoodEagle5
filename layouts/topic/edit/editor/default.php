<?php
/**
 * Kunena Component
 *
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  Topic
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die();

$this->getBBcodesEnabled();

// Kunena bbcode editor
?>

<!-- Bootstrap modal to be used with bbcode editor -->
<tr class="modal hide fade" id="modal-map" data-dismiss="modal" data-backdrop="false" tabindex="-1">
	<td class="kcol-first"><strong><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_MAP_SETTINGS') ?></strong></td>
	<td class="kcol-mid">
		<div class="modal-body">
			<p><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_MAP_SETTINGS_TYPE') ?>: <select id="modal-map-type"><option value="HYBRID"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_MAP_SETTINGS_HYBRID') ?></option><option value="ROADMAP"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_MAP_SETTINGS_ROADMAP') ?></option><option value="TERRAIN"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_MAP_SETTINGS_TERRAIN') ?></option><option value="SATELLITE"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_MAP_SETTINGS_SATELLITE') ?></option></select><br />
				<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_MAP_SETTINGS_ZOOM_LEVEL') ?>: <select id="modal-map-zoomlevel"><option value="2">2</option><option value="4">4</option><option value="6">6</option><option value="8">8</option><option value="10">10</option><option value="12">12</option><option value="14">14</option><option value="16">16</option><option value="18">18</option></select><br />
				<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_MAP_SETTINGS_CITY') ?>: <input name="modal-map-city" id="modal-map-city" type="text" value="" placeholder="<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_MAP_SETTINGS_CITY_DESC') ?>" /></p>
		</div>
		<div class="modal-footer">
			<button id="map-modal-submit" class="kbutton"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_ADD_LABEL') ?></button>
			<button class="kbutton" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_CLOSE_LABEL') ?></button>
		</div>
	</td>
</tr>

<?php $codeTypes = $this->getCodeTypes(); if (!empty($codeTypes)) :	?>
<tr id="modal-code" class="modal hide fade" tabindex="-1" data-dismiss="modal" data-backdrop="false">
	<td class="kcol-first"><strong><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_CODE_SETTINGS') ?></strong></td>
	<td class="kcol-mid">
		<div class="modal-body">
			<p>
				<?php echo $codeTypes; ?>
			</p>
		</div>
		<div class="modal-footer">
			<button id="code-modal-submit" class="kbutton"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_ADD_LABEL') ?></button>
			<button class="kbutton" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_CLOSE_LABEL') ?></button>
		</div>
	</td>
</tr>
<?php endif; ?>
<tr id="modal-picture" class="modal hide fade" tabindex="-1" data-dismiss="modal" data-backdrop="false">
	<td class="kcol-first"><strong><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_PICTURE_SETTINGS') ?></strong></td>
	<td class="kcol-mid">
		<div class="modal-body">
			<p><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_PICTURE_SETTINGS_SIZE') ?>:
			<select id="kpicture-size-list-modal"
				name="modal-picture-size" class="kbutton">
				<?php
					$vid_provider = array ('', '20', '40', '80', '100', '150', '200', '250', '500', '1000');
						foreach ( $vid_provider as $vid_type ) {
							$vid_type = explode ( ',', $vid_type );
							echo '<option value = "' . (!empty ( $vid_type [1] ) ? $this->escape($vid_type [1]) : Joomla\String\StringHelper::strtolower($this->escape($vid_type [0])) . '') . '">' . $this->escape($vid_type [0]) . '</option>';
						}
					?>
			</select>
			<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_PICTURE_SETTINGS_ALT') ?>: <input class="form-control" name="modal-picture-alt" id="modal-picture-alt" type="text" value="" placeholder="<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_PICTURE_SETTINGS_ALT_PLACEHOLDER') ?>" />
			<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_PICTURE_SETTINGS_URL') ?>: <input name="modal-picture-url" id="modal-picture-url" type="text" value="" placeholder="<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_PICTURE_SETTINGS_URL_PLACEHOLDER') ?>" /></p>
		</div>
		<div class="modal-footer">
			<button id="picture-modal-submit" class="kbutton"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_ADD_LABEL') ?></button>
			<button class="kbutton" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_CLOSE_LABEL') ?></button>
		</div>
	</td>
</tr>
<tr id="modal-link" class="modal hide fade" tabindex="-1" data-dismiss="modal" data-backdrop="false">
	<td class="kcol-first"><strong><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_LINK_SETTINGS') ?></strong></td>
	<td class="kcol-mid">
		<div class="modal-body">
			<p><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_LINK_SETTINGS_URL') ?>: <input name="modal-link-url" id="modal-link-url" type="text" value="" placeholder="<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_LINK_SETTINGS_URL_PLACEHOLDER') ?>" />
			<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_LINK_SETTINGS_TEXT') ?>: <input name="modal-link-text" id="modal-link-text" type="text" value="" placeholder="<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_LINK_SETTINGS_TEXT_PLACEHOLDER') ?>" /></p>
		</div>
		<div class="modal-footer">
			<button id="link-modal-submit" class="kbutton"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_ADD_LABEL') ?></button>
			<button class="kbutton" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_CLOSE_LABEL') ?></button>
		</div>
	</td>
</tr>
<tr id="modal-video-settings" class="modal hide fade" tabindex="-1" data-dismiss="modal" data-backdrop="false">
	<td class="kcol-first"><strong><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_VIDEO_SETTINGS') ?></strong></td>
	<td class="kcol-mid">
		<div class="modal-body">
			<p><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_LINK_SETTINGS_SIZE') ?>: <input name="modal-video-size" id="modal-video-size" type="text" maxlength="5" size="5" value="" />
			<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_LINK_SETTINGS_WIDTH') ?>: <input name="modal-video-width" id="modal-video-width" type="text" maxlength="5" size="5" value="" />
			<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_LINK_SETTINGS_HEIGHT') ?>: <input name="modal-video-height" id="modal-video-height" type="text" maxlength="5" size="5" value="" />
			<?php
				echo JText::_('COM_KUNENA_EDITOR_VIDEO_PROVIDER');
			?>
			<select id="kvideoprovider-list-modal"
				name="provider" class="kbutton">
				<?php
					$vid_provider = array ('', 'Bofunk', 'Break', 'Clipfish', 'DivX,divx]http://', 'Flash,flash]http://', 'FlashVars,flashvars param=]http://', 'MediaPlayer,mediaplayer]http://', 'Metacafe', 'MySpace', 'QuickTime,quicktime]http://', 'RealPlayer,realplayer]http://', 'RuTube', 'Sapo', 'Streetfire', 'Veoh', 'Videojug', 'Vimeo', 'Wideo.fr', 'YouTube' );
						foreach ( $vid_provider as $vid_type ) {
							$vid_type = explode ( ',', $vid_type );
							echo '<option value = "' . (!empty ( $vid_type [1] ) ? $this->escape($vid_type [1]) : Joomla\String\StringHelper::strtolower($this->escape($vid_type [0])) . '') . '">' . $this->escape($vid_type [0]) . '</option>';
						}
					?>
			</select>
			<?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_LINK_SETTINGS_ID') ?>: <input name="modal-video-id" id="modal-video-id" type="text" maxlength="30" size="11" value="" /></p>
		</div>
		<div class="modal-footer">
			<button id="videosettings-modal-submit" class="kbutton"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_ADD_LABEL') ?></button>
			<button class="kbutton" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_CLOSE_LABEL') ?></button>
		</div>
	</td>
</tr>
<tr id="modal-video-urlprovider" class="modal hide fade" tabindex="-1" data-dismiss="modal" data-backdrop="false">
	<td class="kcol-first"><strong><?php echo JText::_('COM_KUNENA_EDITOR_VIDEO') ?></strong></td>
	<td class="kcol-mid">
		<div class="modal-body">
			<p><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_VIDEO_URL_PROVIDER_URL') ?>: <input name="modal-video-urlprovider-input" id="modal-video-urlprovider-input" type="text" value="" /></p>
		</div>
		<div class="modal-footer">
			<button id="videourlprovider-modal-submit" class="kbutton modal-submit"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_ADD_LABEL') ?></button>
			<button class="kbutton" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_CLOSE_LABEL') ?></button>
		</div>
	</td>
</tr>
<?php if (!$this->message->parent && isset($this->poll)) : ?>
<tr id="modal-poll-settings" class="modal hide fade" tabindex="-1" data-dismiss="modal" data-backdrop="false">
	<td class="kcol-first"><strong><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_TITLE_POLL_SETTINGS') ?></strong></td>
	<td class="kcol-mid">
		<div class="modal-body">
				<div id="kbbcode-poll-options">
					<div>
						<label class="kpoll-title-lbl" for="kpoll-title"><?php echo JText::_('COM_KUNENA_POLL_TITLE'); ?></label>
						<input type="text" class="inputbox" name="poll_title" id="kpoll-title"
								maxlength="100" size="40"
								value="<?php echo $this->escape($this->poll->title) ?>" />
						<?php echo KunenaIcons::poll_add();?>
						<?php echo KunenaIcons::poll_rem();?>
					</div>
					<br />
					<div>
						<label class="kpoll-term-lbl" for="kpoll-time-to-live"><?php echo JText::_('COM_KUNENA_POLL_TIME_TO_LIVE'); ?></label>
						<div id="datepoll-container" class="span5 col-md-5">
							<div class="input-append date">
								<input type="text" class="kpoll-time-to-live-input" name="poll_time_to_live" data-date-format="mm/dd/yyyy" value="<?php echo !empty($this->poll->polltimetolive) ? $this->poll->polltimetolive : '' ?>"><span class="add-on"><i class="icon-grid-view-2 "></i></span>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div id="kpoll-alert-error" class="alert" style="display:none;">
						<button type="button" class="close kbutton" data-dismiss="alert">&times;</button>
						<?php echo JText::sprintf('COM_KUNENA_ALERT_WARNING_X', JText::_('COM_KUNENA_POLL_NUMBER_OPTIONS_MAX_NOW')) ?>
					</div>
					<div>
						<?php
						if ($this->poll->exists())
						{
							$x = 1;

							foreach ($this->poll->getOptions() as $poll_option)
							{
								echo '<div class="polloption"><label>Option ' . $x . '</label><input type="text" size="100" id="field_option' . $x . '" name="polloptionsID[' . $poll_option->id . ']" value="' . $poll_option->text . '" /></div>';
								$x++;
							}
						} ?>
					</div>
					<input type="hidden" name="nb_options_allowed" id="nb_options_allowed" value="<?php echo $this->config->pollnboptions; ?>" />
					<input type="hidden" name="number_total_options" id="numbertotal"
						value="<?php echo !empty($this->polloptionstotal) ? $this->escape($this->polloptionstotal) : '' ?>" />
				</div>
		</div>
		<div class="modal-footer">
			<button id="poll-settings-modal-submit" class="kbutton"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_ADD_LABEL') ?></button>
			<button class="kbutton" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_CLOSE_LABEL') ?></button>
			<button id="clearpoll" class="kbutton" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_KUNENA_CLEAR_MODAL') ?></button>
		</div>
	</td>
</tr>
<?php endif; ?>
<tr id="modal-emoticons" class="modal hide fade" tabindex="-1" data-dismiss="modal" data-backdrop="false">
	<td class="kcol-first"><strong>Emoticons</strong></td>
	<td class="kcol-mid">
		<div class="modal-body">
		<p><div id="smilie"><?php
			$emoticons = KunenaHtmlParser::getEmoticons(0, 1);
			foreach ($emoticons as $emo_code => $emo_url) {
				$data = getimagesize(JPATH_ROOT . '/' . $emo_url);
				$width = $data[0];
				$height = $data[1];
				echo '<img class="smileyimage" src="' . $emo_url . '" border="0" width="' . $width .'" height="' . $height . '"  alt="' . $emo_code . ' " title="' . $emo_code . ' " style="cursor:pointer"/> ';
			}
			?>
			</div></p>
		</div>
		<div class="modal-footer">
			<button class="kbutton" data-dismiss="modal" aria-hidden="true"><?php echo JText::_('COM_KUNENA_EDITOR_MODAL_CLOSE_LABEL') ?></button>
		</div>
	</td>
</tr>


<tr id="kpost-toolbar" class="krow<?php echo 1 + $this->k^=1;?>">
	<td class="kcol-first kcol-editor-label">
		<strong><?php echo (JText::_('COM_KUNENA_MESSAGE'));?></strong></td>
	<td class="kcol-last kcol-editor-field">
		<table class="kpostbuttonset">
			<tr>
				<div class="controls">
					<ul id="tabs_kunena_editor" class="nav nav-tabs">
						<li><a href="#write" data-toggle="tab"><?php echo JText::_('COM_KUNENA_EDITOR_TAB_WRITE_LABEL') ?></a></li>
						<li><a href="#preview" data-toggle="tab"><?php echo JText::_('COM_KUNENA_PREVIEW') ?></a></li>
					</ul>
					<textarea name="message" id="kbbcode-message" rows="12" tabindex="7" required="required" placeholder="<?php echo JText::_('COM_KUNENA_ENTER_MESSAGE') ?>"><?php echo $this->escape($this->message->message); ?></textarea>
				</div>

				<!-- Hidden preview placeholder -->
				<div class="controls" id="kbbcode-preview" style="display: none;"></div>
			</tr>
		</table>
	</td>
</tr>
