var $ = jQuery;

window.onload = function() {

	// Custom <select> styling
	customSelectAttach();
	
	// Tidying up repeating dates form
	repeatingDatesClear();
}

$(function() {	
	
	// Attach  selectbox on checkbox click
	$("#edit-field-event-date input[type=checkbox]").click(function() {
		customSelectAttach();
		setTimeout("customSelectAttach()",1);
	});
	// Attach selectbox on selectbox update
	$("#edit-field-event-date-und-0-rrule-freq").change(function() {
		setTimeout("customSelectAttach()",1);	
	});
	
	// Attach checkbox on Ajax update
	Drupal.behaviors.customSelect = {
		attach: function (context, settings) {		
			customSelectAttach();
		}
	};
	
	$("#edit-field-event-date-und-0-show-repeat-settings").click(function() {
		repeatingDatesClear();
	});
	
	// Administration menu toggle
	$("#block-menu-block-2 .menu-settings").click(function(e) {
		e.preventDefault();
		$("#block-menu-block-3").slideToggle();
	});
	
});

function customSelectAttach() {
	$('.form-select:visible').not('.customised-select').customSelect();
}

function repeatingDatesClear() {
	// Exclude/Include dates
	$(".form-item-field-event-date-und-0-rrule-show-exceptions").hide();
	$(".form-item-field-event-date-und-0-rrule-show-additions").hide();
	
	/**
	 * Dagligt
	 */
	// Gentages hver
	$("#edit-field-event-date-und-0-rrule-daily-byday-radios").children().not(".interval").not(".weekday").hide();
	// Stop med at gentage
	$("#edit-field-event-date-und-0-rrule-range-of-repeat .until").hide();
	
	/**
	 * Ugentligt
	 */
	$(".form-item-field-event-date-und-0-rrule-weekly-BYDAY").hide();
	/**
	 * Månedligt
	 */
	 $(".byday-bymonth").hide();
}

$(document).ready(function() {
	$(".page-media-browser").width($(window).width());
	
    
    jQuery(".button.launcher").click(function(e) {

			$(".media-wrapper").css({
				"position":"absolute",
				"top":30,
				"left":0,
				"width":"auto",
		    });
		    $("#mediaBrowser").css({			
				"width":"auto",
		    });
		    $("#media-browser-tabset").css({			
				"padding":5,
		    });			
		    	   
	});    
});