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

JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');

// Load scripts to handle fileupload process
JText::script('COM_KUNENA_UPLOADED_LABEL_INSERT_ALL_BUTTON');
JText::script('COM_KUNENA_EDITOR_INSERT');
JText::script('COM_KUNENA_EDITOR_IN_MESSAGE');
JText::script('COM_KUNENA_GEN_REMOVE_FILE');
JText::sprintf('COM_KUNENA_UPLOADED_LABEL_ERROR_REACHED_MAX_NUMBER_FILES', $this->config->attachment_limit, array('script' => true));
JText::script('COM_KUNENA_UPLOADED_LABEL_UPLOAD_BUTTON');
JText::script('COM_KUNENA_UPLOADED_LABEL_PROCESSING_BUTTON');
JText::script('COM_KUNENA_UPLOADED_LABEL_ABORT_BUTTON');
JText::script('COM_KUNENA_UPLOADED_LABEL_DRAG_AND_DROP_OR_BROWSE');
JText::script('COM_KUNENA_EDITOR_BOLD');
JText::script('COM_KUNENA_EDITOR_COLORS');
JText::script('COM_KUNENA_EDITOR_UNORDERED_LIST');
JText::script('COM_KUNENA_EDITOR_TABLE');
JText::script('COM_KUNENA_EDITOR_LINK');
JText::script('COM_KUNENA_EDITOR_EBAY');
JText::script('COM_KUNENA_EDITOR_MAP');
JText::script('COM_KUNENA_EDITOR_POLL_SETTING');
JText::script('COM_KUNENA_EDITOR_TWEET');

JFactory::getDocument()->addScriptDeclaration('
	var imageheight = ' . $this->config->imageheight . ';
	var imagewidth = ' . $this->config->imagewidth . ';
');

JHtml::_('jquery.ui');
$this->addScript('assets/js/load-image.min.js');
$this->addScript('assets/js/canvas-to-blob.min.js');
$this->addScript('assets/js/jquery.iframe-transport.js');
$this->addScript('assets/js/jquery.fileupload.js');
$this->addScript('assets/js/jquery.fileupload-process.js');
$this->addScript('assets/js/jquery.fileupload-image.js');
$this->addScript('assets/js/upload.main.js');
$this->addStyleSheet('assets/css/fileupload.css');

$this->addScript('assets/js/markitup.js');

$editor = KunenaBbcodeEditor::getInstance();
$editor->initialize();

$this->addScript('assets/js/markitup.editor.js');
$this->addScript('assets/js/markitup.set.js');

$this->k = 0;

$this->addScriptDeclaration("kunena_upload_files_rem = '" . KunenaRoute::_('index.php?option=com_kunena&view=topic&task=removeattachments&format=json&' . JSession::getFormToken() . '=1', false) . "';");
$this->addScriptDeclaration("kunena_upload_files_preload = '" . KunenaRoute::_('index.php?option=com_kunena&view=topic&task=loadattachments&format=json&' . JSession::getFormToken() . '=1', false) . "';");
$this->addScriptDeclaration("kunena_upload_files_maxfiles = '" . $this->config->attachment_limit . "';");

// If polls are enabled, load also poll JavaScript.

if ($this->config->pollenabled)
{
	JText::script('COM_KUNENA_POLL_OPTION_NAME');
	JText::script('COM_KUNENA_EDITOR_HELPLINE_OPTION');
	$this->addScript('assets/js/poll.js');
}

$this->addScript('assets/js/pollcheck.js');

$this->addStyleSheet('assets/css/bootstrap.datepicker.css');
$this->addScript('assets/js/bootstrap.datepicker.js');

// Load caret.js always before atwho.js script and use it for autocomplete, emojiis...
$this->addScript('assets/js/jquery.caret.js');
$this->addScript('assets/js/jquery.atwho.js');
$this->addStyleSheet('assets/css/jquery.atwho.css');

$this->ktemplate = KunenaFactory::getTemplate();
$topicicontype = $this->ktemplate->params->get('topicicontype');

$this->addScriptDeclaration("kunena_topicicontype = '" . $topicicontype . "';");

$this->addScript('assets/js/edit.js');

if (KunenaFactory::getTemplate()->params->get('formRecover'))
{
	$this->addScript('assets/js/sisyphus.js');
}
?>

	<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena') ?>" method="post" class="postform form-validate"
		id="postform" name="postform" enctype="multipart/form-data" data-page-identifier="1">
		<input type="hidden" name="view" value="topic" />
		<input id="kurl_topicons_request" type="hidden" value="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=topic&layout=topicicons&format=raw', false); ?>" />
		<input id="kcategory_poll" type="hidden" name="kcategory_poll" value="<?php echo $this->message->catid; ?>" />
		<input id="kpreview_url" type="hidden" name="kpreview_url" value="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=topic&layout=edit&format=raw', false) ?>" />
		<?php if ($this->message->exists()) : ?>
			<input type="hidden" name="task" value="edit" />
			<input id="kmessageid" type="hidden" name="mesid" value="<?php echo intval($this->message->id) ?>" />
		<?php else: ?>
			<input type="hidden" name="task" value="post" />
			<input type="hidden" name="parentid" value="<?php echo intval($this->message->parent) ?>" />
		<?php endif; ?>
		<?php if (!isset($this->selectcatlist)) : ?>
			<input type="hidden" name="catid" value="<?php echo intval($this->message->catid) ?>" />
		<?php endif; ?>
		<?php if ($this->category->id && $this->category->id != $this->message->catid) : ?>
			<input type="hidden" name="return" value="<?php echo intval($this->category->id) ?>" />
		<?php endif; ?>
		<?php if ($this->message->getTopic()->first_post_id == $this->message->id && $this->message->getTopic()->getPoll()->id) : ?>
			<input type="hidden" id="poll_exist_edit" name="poll_exist_edit" value="<?php echo intval($this->message->getTopic()->getPoll()->id) ?>" />
		<?php endif; ?>
		<input type="hidden" id="kunena_upload" name="kunena_upload" value="<?php echo intval($this->message->catid) ?>" />
		<input type="hidden" id="kunena_upload_files_url" value="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=topic&task=upload&format=json&' . JSession::getFormToken() . '=1', false) ?>" />
		<?php echo JHtml::_('form.token'); ?>

		<div class="kblock">
			<div class="kheader">
				<h2><span><?php echo $this->escape($this->headerText)?></span></h2>
			</div>
			<div class="kcontainer">
				<div class="kbody">

					<table class="kblocktable<?php echo !empty ( $this->category->class_sfx ) ? ' kblocktable' . $this->escape($this->category->class_sfx) : ''?>" id="kpostmessage">
						<tbody id="kpost-message">
						<?php if (isset($this->selectcatlist)) : ?>
							<tr id="kpost-category" class="krow<?php echo 1 + $this->k^=1 ?>">
								<td class="kcol-first"><strong><?php echo JText::_('COM_KUNENA_CATEGORY')?></strong></td>
								<td class="kcol-mid"><?php echo $this->selectcatlist?></td>
							</tr>
						<?php endif; ?>
						<?php if ($this->message->userid) : ?>
							<tr class="krow<?php echo 1 + $this->k^=1 ?>" id="kanynomous-check" <?php if (!$this->category->allow_anonymous): ?>style="display:none;"<?php endif; ?>>
								<td class="kcol-first">
									<strong><?php echo JText::_('COM_KUNENA_POST_AS_ANONYMOUS'); ?></strong>
								</td>
								<td class="kcol-mid">
									<input type="checkbox" id="kanonymous" name="anonymous" value="1" <?php if ($this->post_anonymous) echo 'checked="checked"'; ?> />
									<label for="kanonymous"><?php echo JText::_('COM_KUNENA_POST_AS_ANONYMOUS_DESC'); ?></label>
								</td>
							</tr>
						<?php endif; ?>
						<tr class="krow<?php echo 1 + $this->k^=1 ?>" id="kanynomous-check-name"
						    <?php if ( $this->me->userid && !$this->category->allow_anonymous ): ?>style="display:none;"<?php endif; ?>>
							<td class="kcol-first">
								<strong><?php echo JText::_('COM_KUNENA_GEN_NAME'); ?></strong>
							</td>
							<td class="kcol-mid">
								<input type="text" id="kauthorname" name="authorname" size="35" class="kinputbox postinput required" maxlength="35" value="<?php echo $this->escape($this->message->name);?>" />
							</td>
						</tr>
						<?php if ($this->config->askemail && !$this->me->userid) : ?>
							<tr class = "krow<?php echo 1+ $this->k^=1 ?>">
								<td class = "kcol-first"><strong><?php echo JText::_('COM_KUNENA_GEN_EMAIL');?></strong></td>
								<td class="kcol-mid">
									<input type="text" id="email" name="email"  size="35" class="kinputbox postinput required validate-email" maxlength="35" value="<?php echo !empty($this->message->email) ? $this->escape($this->message->email) : '' ?>" />
									<br />
									<?php echo $this->config->showemail == '0' ? JText::_('COM_KUNENA_POST_EMAIL_NEVER') : JText::_('COM_KUNENA_POST_EMAIL_REGISTERED'); ?>
								</td>
							</tr>
						<?php endif; ?>
						<tr id="kpost-subject" class="krow<?php echo 1 + $this->k^=1 ?>">
							<td class="kcol-first">
								<strong><?php echo JText::_('COM_KUNENA_GEN_SUBJECT'); ?></strong>
							</td>

							<td class="kcol-mid"><input type="text" class="kinputbox postinput required" name="subject" id="subject" size="35"
							                            maxlength="<?php echo $this->escape($this->config->maxsubject); ?>" <?php if (!$this->config->allow_change_subject && $this->message->parent): ?>disabled<?php endif; ?> value="<?php echo $this->escape($this->message->subject); ?>" tabindex="1" />
								<?php if (!$this->config->allow_change_subject && $this->topic->exists()): ?>
									<input type="hidden" name="subject" value="<?php echo $this->escape($this->message->subject); ?>" />
								<?php endif; ?>
							</td>
						</tr>
						<?php if (!empty($this->topicIcons)) : ?>
						<tr id="kpost-topicicons" class="krow<?php echo 1 + $this->k^=1 ?>">
							<td class="kcol-first">
								<strong><?php echo JText::_('COM_KUNENA_GEN_TOPIC_ICON'); ?></strong>
							</td>

							<td class="kcol-mid">
								<div id="iconset_inject" class="controls controls-select">
									<div id="iconset_topic_list">
										<?php foreach ($this->topicIcons as $id => $icon): ?>
										<input type="radio" id="radio<?php echo $icon->id ?>" name="topic_emoticon" value="<?php echo $icon->id ?>" <?php echo !empty($icon->checked) ? ' checked="checked" ' : '' ?> />
										<?php if ($this->config->topicicons && $topicicontype == 'B2') : ?>
										<label class="radio inline" for="radio<?php echo $icon->id; ?>"><span class="icon icon-<?php echo $icon->b2; ?> icon-topic" aria-hidden="true"></span>
											<?php elseif ($this->config->topicicons && $topicicontype == 'fa') : ?>
											<label class="radio inline" for="radio<?php echo $icon->id; ?>"><i class="fa fa-<?php echo $icon->fa; ?> glyphicon-topic fa-2x"></i>
												<?php else : ?>
												<label class="radio inline" for="radio<?php echo $icon->id; ?>"><img src="<?php echo $icon->relpath; ?>" alt="" border="0" />
													<?php endif; ?>
												</label>
												<?php endforeach; ?>
									</div>
								</div>
							</td>
						</tr>
						<?php endif; ?>
						<?php
						// Show bbcode editor
						echo $this->subLayout('Topic/Edit/Editor')->setProperties($this->getProperties());
						?>
						<?php if ($this->message->exists() && $this->config->editmarkup) : ?>
							<tr>
								<td class="kcol-first" id="modified_reason">
									<label class="control-label"><?php echo(JText::_('COM_KUNENA_EDITING_REASON')) ?></label>
								</td>
								<td class="kcol-mid">
										<input class="kinputbox postinput" name="modified_reason" maxlength="200" size="35" type="text"
										       value="<?php echo $this->message->modified_reason; ?>" title="reason"/>
								</td>
							</tr>

						<?php endif; ?>
						<?php if ($this->allowedExtensions) : ?>
						<tr id="kpost-attachments" class="krow<?php echo 1 + $this->k^=1;?>">
							<td class="kcol-first">
								<strong><?php echo JText::_('COM_KUNENA_EDITOR_ATTACHMENTS') ?></strong>
							</td>
							<td class="kcol-mid">
								<div id="kattachment-id" class="kattachment">
									<button class="btn" id="kshow_attach_form" type="button"><?php echo KunenaIcons::attach() . ' ' . JText::_('COM_KUNENA_EDITOR_ATTACHMENTS'); ?></button>
									<div id="kattach_form" style="display: none;"><br />
										<span class="label label-info"><?php echo JText::_('COM_KUNENA_FILE_EXTENSIONS_ALLOWED') ?>: <?php echo $this->escape(implode(', ', $this->allowedExtensions)) ?></span><br /><br />
										<span class="label label-info"><?php echo JText::_('COM_KUNENA_UPLOAD_MAX_FILES_WEIGHT') ?>: <?php echo $this->config->filesize != 0 ? round($this->config->filesize / 1024, 1) : $this->config->filesize ?> <?php echo JText::_('COM_KUNENA_UPLOAD_ATTACHMENT_FILE_WEIGHT_MB') ?> <?php echo JText::_('COM_KUNENA_UPLOAD_MAX_IMAGES_WEIGHT') ?>: <?php echo $this->config->imagesize != 0 ? round($this->config->imagesize / 1024, 1) : $this->config->imagesize ?> <?php echo JText::_('COM_KUNENA_UPLOAD_ATTACHMENT_FILE_WEIGHT_MB') ?></span><br /><br />
										<!-- The fileinput-button span is used to style the file input field as button -->
										<span class="kbutton fileinput-button">
											<?php echo KunenaIcons::plus();?>
											<span><?php echo JText::_('COM_KUNENA_UPLOADED_LABEL_ADD_FILES_BUTTON') ?></span>
											<!-- The file input field used as target for the file upload widget -->
											<input id="fileupload" type="file" name="file" multiple>
										</span>
										<button id="insert-all" class="btn btn-primary" type="submit" style="display:none">
											<?php echo KunenaIcons::upload();?>
											<span><?php echo JText::_('COM_KUNENA_UPLOADED_LABEL_INSERT_ALL_BUTTON') ?></span>
										</button>
										<button id="remove-all" class="btn btn-danger" type="submit" style="display:none">
											<?php echo KunenaIcons::cancel();?>
											<span><?php echo JText::_('COM_KUNENA_UPLOADED_LABEL_REMOVE_ALL_BUTTON') ?></span>
										</button>
										<!-- The container for the uploaded files -->
										<div id="files" class="files"></div>
										<div id="dropzone">
											<div class="dropzone">
												<div class="default message">
													<span id="klabel_info_drop_browse"><?php echo JText::_('COM_KUNENA_UPLOADED_LABEL_DRAG_AND_DROP_OR_BROWSE') ?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->canSubscribe) : ?>
							<tr id="kpost-subscribe" class="krow<?php echo 1 + $this->k^=1;?>">
								<td class="kcol-first">
									<strong><?php echo JText::_('COM_KUNENA_POST_SUBSCRIBE'); ?></strong>
								</td>
								<td class="kcol-mid">
									<input style="float: left; margin-right: 10px;" type="checkbox" name="subscribeMe" id="subscribeMe" value="1" <?php if ($this->subscriptionschecked == 1 && $this->me->canSubscribe != 0 || $this->subscriptionschecked == 0 && $this->me->canSubscribe == 1)
									{
										echo 'checked="checked"';
									} ?> />
									<label for="subscribeMe"><i><?php echo JText::_('COM_KUNENA_POST_NOTIFIED'); ?></i></label>
								</td>
							</tr>
						<?php endif; ?>
						<?php if (!empty($this->captchaEnabled)) : ?>
							<tr class="control-group">
								<?php echo $this->captchaDisplay;?>
							</tr>
						<?php endif; ?>
						<tr id="kpost-buttons" class="krow1">
							<td id="kpost-buttons" colspan="2">
								<input type="submit" name="ksubmit" class="kbutton"
								       value="<?php echo (' ' . JText::_('COM_KUNENA_SUBMIT') . ' ');?>"
								       title="<?php echo (JText::_('COM_KUNENA_EDITOR_HELPLINE_SUBMIT'));?>" tabindex="4" />
								<input type="button" name="cancel" class="kbutton"
								       value="<?php echo (' ' . JText::_('COM_KUNENA_CANCEL') . ' ');?>"
								       onclick="window.history.back();"
								       title="<?php echo (JText::_('COM_KUNENA_EDITOR_HELPLINE_CANCEL'));?>" tabindex="5" />
							</td>
						</tr>
						</tbody>
				</table>
			</div>
		</div>
		<?php
		if (!$this->message->name)
		{
			echo '<script type="text/javascript">document.postform.authorname.focus();</script>';
		}
		else
		{
			if (!$this->topic->subject)
			{
				echo '<script type="text/javascript">document.postform.subject.focus();</script>';
			}
			else
			{
				echo '<script type="text/javascript">document.postform.message.focus();</script>';
			}
		}
		?>
		<div id="kattach-list"></div>
		</div>
	</form>
<?php
if ($this->config->showhistory && $this->topic->exists())
{
	echo $this->subRequest('Topic/Form/History', new JInput(array('id' => $this->topic->id)));
}
