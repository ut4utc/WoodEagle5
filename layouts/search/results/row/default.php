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

// @var KunenaForumMessage $message

$message  = $this->message;
$topic    = $message->getTopic();
$category = $topic->getCategory();
$author   = $message->getAuthor();
$isReply  = $message->id != $topic->first_post_id;
$config   = KunenaFactory::getConfig();
$name     = $config->username ? $author->username : $author->name;
$me       = isset($this->me) ? $this->me : KunenaUserHelper::getMyself();
?>
<table>
	<thead>
		<tr class="ksth">
			<th colspan="2">
				<span class="kmsgdate">
					<?php echo KunenaDate::getInstance($message->time)->toSpan() ?>
				</span>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td rowspan="2" valign="top" class="kprofile-left kresultauthor">
				<ul class="kpost-profile">
					<li class="kpost-username">
						<?php echo $author->getLink(null, null, 'nofollow', '', null, $topic->getCategory()->id); ?>
					</li>
					<li>
						<span class="kavatar">
							<?php echo $author->getLink($author->getAvatarImage(KunenaFactory::getTemplate()->params->get('avatarType'), 'post')); ?>
						</span>
					</li>
				</ul>
			</td>
			<td class="kmessage-left resultmsg">
				<div class="kmsgbody">
					<div class="kmsgtitle kresult-title">
						<span class="kmsgtitle">
							<?php echo $this->getTopicLink($topic, $message, null, null, 'hasTooltip'); ?>
						</span>
					</div>
					<div class="kmsgtext resultmsg">
						<?php  if (!$isReply) :
							echo $message->displayField('message');
						else :
							echo (!$me->userid && $config->teaser) ? JText::_('COM_KUNENA_TEASER_TEXT') : $this->message->displayField('message');
						endif;?>
					</div>
					<div class="resultcat">
						<?php echo JText::sprintf('COM_KUNENA_CATEGORY_X', $this->getCategoryLink($category, $this->escape($category->name))) ?>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table>
