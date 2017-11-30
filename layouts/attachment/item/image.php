<?php
/**
 * Kunena Component
 *
 * @package     Kunena.Template.BlueEagle5
 * @subpackage  BBCode
 *
 * @copyright   (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.kunena.org
 **/
defined('_JEXEC') or die();

// @var KunenaAttachment $attachment

$attachment = $this->attachment;

$location = JUri::root() . $attachment->getUrl();
$data = getimagesize($location);
$width = $data[0];
$height = $data[1];

if (!$attachment->isImage())
{
	return;
}

echo $this->subLayout('Widget/Lightbox');

$config = KunenaConfig::getInstance();

$attributesLink = $config->lightbox ? ' class="fancybox-button" rel="fancybox-button"' : '';
$attributesImg  = ' style="max-height:' . (int) $config->imageheight . 'px;"';
?>

<a href="<?php echo $attachment->getUrl(); ?>" title="<?php echo $attachment->getShortName($config->attach_start, $config->attach_end); ?>"<?php echo $attributesLink; ?>>
	<img src="<?php echo $attachment->getUrl(); ?>"<?php echo $attributesImg; ?> width="<?php echo $width ;?>" height="<?php echo $height ;?>" alt="" />
</a>
