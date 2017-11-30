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

echo $attachment->isImage() ? $this->render('image') : $this->render('general');
