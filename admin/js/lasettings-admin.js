jQuery(function( $ ) {
	'use strict';
	$('#lasettings_turn_onOff').on('click', function () {
		if ($(this).val() === 'null' || $(this).val() === '') {
			if ($('#lasettings_api__key').val() !== "" && $('#lasettings_secret__key').val() !== "") {
				$(this).val('checked');
			}
		} else {
			$(this).val('null');
		}
	});
});
