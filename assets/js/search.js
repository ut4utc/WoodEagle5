/**
 * Kunena Component
 * @package Kunena.Template.Crypsis
 *
 * @copyright (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link https://www.kunena.org
 **/

jQuery(document).ready(function($) {

	/* Hide search form when there are search results found */
	if ( $('#ksearchresult').is(':visible') ) {
		$('#searchform').hide();
	}

	if ( $('#ksearchresult').is(':visible') ) {
		$('#toggler').click(function (e) {
			$('#searchform').removeClass('collapse in');
			$('#searchform').show();
		});
	}

	if (jQuery.fn.datepicker != undefined) {
		jQuery('#searchatdate .input-append.date').datepicker({
			orientation: "top auto"
		});
	}
});

