/*!
	WLC - Bootstrap 4 Admin Menu (https://wlcunited.com) Copyright 2016 - 2019 WLC United. All Rights Reserved.
	Licensed under Regular License (http://codecanyon.net/licenses/regular) or Extended License (http://codecanyon.net/licenses/extended)
	We will take legal action against those who copy our HTML content, CSS style sheets and JavaScript functions without a license.
*/


// Bootstrap Tabs
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	$(this).parents('.nav-tabs').find('.active').removeClass('active');
	$(this).parents('.nav-pills').find('.active').removeClass('active');
	$(this).addClass('active').parent().addClass('active');
});


// Bootstrap Toggle
(function($) {

	'use strict';
	var $window = $( window );

	var toggleClass = function( $el ) {
		if ( !!$el.data('toggleClassBinded') ) {
			return false;
		}

		var $target,
			className,
			eventName;

		$target = $( $el.attr('data-target') );
		className = $el.attr('data-toggle-class');
		eventName = $el.attr('data-event');


		$el.on('click.toggleClass', function(e) {
			e.preventDefault();
			$target.toggleClass( className );

			var hasClass = $target.hasClass( className );

			if ( !!eventName ) {
				$window.trigger( eventName, {
					added: hasClass,
					removed: !hasClass
				});
			}
		});

		$el.data('toggleClassBinded', true);

		return true;
	};

	$(function() {
		$('[data-toggle-class][data-target]').each(function() {
			toggleClass( $(this) );
		});
	});

}).apply(this, [jQuery]);

// Bootstrap Datepicker
if (typeof($.fn.datepicker) != 'undefined') {
	$.fn.bootstrapDP = $.fn.datepicker.noConflict();
}