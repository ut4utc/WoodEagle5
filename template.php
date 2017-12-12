<?php
/**
 * Kunena Component
 *
 * @package     Kunena.Template.WoodEagle5
 * @subpackage  Template
 *
 * @copyright   (C) 2017 Proinsurer. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link        https://www.proinsurer.com.ua
 **/
defined('_JEXEC') or die;

/**
 * Wood Eagle 5 template.
 *
 * @since  K5.0
 */
class KunenaTemplateWood_Eagle5 extends KunenaTemplate
{
	/**
	 * Template initialization.
	 *
	 * @return void
	 */
	public function initialize()
	{
		KunenaTemplate::getInstance()->loadLanguage();

		// Template requires Bootstrap javascript
		// JHtml::_('bootstrap.framework');

        // TODO-alex make checkbox in a theme where chose using bootstrap

		// Template also requires jQuery framework.
	//	JHtml::_('jquery.framework');
	//	JHtml::_('stylesheet', 'media/jui/css/bootstrap.min.css');
	//	JHtml::_('stylesheet', 'media/jui/css/bootstrap-responsive.min.css');
	//	JHtml::_('stylesheet', 'media/jui/css/bootstrap-extended.css');

		// Load JavaScript.
		$this->addScript('assets/js/main.js');

		$this->ktemplate = KunenaFactory::getTemplate();
		$storage = $this->ktemplate->params->get('storage');

		if ($storage)
		{
			$this->addScript('assets/js/localstorage.js');
		}

		// Add CSS
        $filename = JPATH_SITE . '/components/com_kunena/template/wood_eagle5/assets/css/kunena.css';

		if (file_exists($filename) )
		{
			$this->addStyleSheet('assets/css/kunena.css');
		}

		parent::initialize();
	}

	/**
	 * @param  string $filename
	 * @param  string $group
	 *
	 * @return JDocument
	 */
	public function addStyleSheet($filename, $group = 'forum')
	{
		$filename = $this->getFile($filename, false, '', "media/kunena/cache/wood_eagle5/css");

		return JFactory::getDocument()->addStyleSheet(JUri::root(true) . "/{$filename}");
	}
}
