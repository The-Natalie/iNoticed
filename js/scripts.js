$(document).ready(function(){

var dateCard = $('div#card-dating');
var dateCaption = $('#caption-dating');
var kindCard = $('div#card-kindness');
var kindCaption = $('#caption-kindness');
var valCard = $('div#card-valued');
var valCaption = $('#caption-valued');


// media query event handler
	if (matchMedia) {
		const mq = window.matchMedia("(min-width: 1224px)");
		mq.addListener(WidthChange);
		WidthChange(mq);
	}

	// media query change
	function WidthChange(mq) {
		if (mq.matches) {
	// window width is at least 1224px

		$('#next').click(function(e) {
			if ( (kindCard.css('visibility') == 'hidden') && (valCard.css('visibility') == 'hidden')) {
				kindCaption.css({'left': '-1000px'});
				valCaption.css({'left': '-1000px'});
				dateCard.animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
					dateCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
				});			
				dateCaption.delay(1300).animate({'left': '+=1000px'}, 2000, 'linear', function() {
					dateCaption.css({'display': 'none', 'left': '-1000px'});
					kindCaption.css({'display': 'block'});
				});
				kindCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
				kindCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}	else if ((dateCard.css('visibility') == 'hidden') && (valCard.css('visibility') == 'hidden')) {
					dateCaption.css({'left': '-1000px'});
					valCaption.css({'left': '-1000px'});
					kindCard.animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
						kindCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					kindCaption.delay(1300).animate({'left': '+=1000px'}, 2000, 'linear', function() {
						kindCaption.css({'display': 'none', 'left': '-1000px'});
						valCaption.css({'display': 'block'});
					});
					valCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
					valCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}	else {
					dateCaption.css({'left': '-1000px'});
					kindCaption.css({'left': '-1000px'});
					valCard.animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
						valCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					valCaption.delay(1300).animate({'left': '+=1000px'}, 2000, 'linear', function() {
						valCaption.css({'display': 'none', 'left': '-1000px'});
						dateCaption.css({'display': 'block'});
					});
					dateCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
					dateCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}
		});


		$('#prev').click(function(e) {
			if ( (kindCard.css('visibility') == 'hidden') && (valCard.css('visibility') == 'hidden')) {
				kindCaption.css({'left': '1000px'});
				valCaption.css({'left': '1000px'});
				dateCard.animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
					dateCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
				});			
				dateCaption.delay(1300).animate({'left': '-=1000px'}, 2000, 'linear', function() {
					dateCaption.css({'display': 'none', 'left': '1000px'});
					valCaption.css({'display': 'block'});
				});
				valCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
				valCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}	else if ((dateCard.css('visibility') == 'hidden') && (kindCard.css('visibility') == 'hidden')) {
					dateCaption.css({'left': '1000px'});
					kindCaption.css({'left': '1000px'});				
					valCard.animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
						valCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					valCaption.delay(1300).animate({'left': '-=1000px'}, 2000, 'linear', function() {
						valCaption.css({'display': 'none', 'left': '1000px'});
						kindCaption.css({'display': 'block'});
					});
					kindCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
					kindCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}	else {
					dateCaption.css({'left': '1000px'});
					valCaption.css({'left': '1000px'});
					kindCard.animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
						kindCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					kindCaption.delay(1300).animate({'left': '-=1000px'}, 2000, 'linear', function() {
						kindCaption.css({'display': 'none', 'left': '1000px'});
						dateCaption.css({'display': 'block'});
					});
					dateCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
					dateCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}
		});


		} else {
	// window width is less than 1224px

		$('#next').click(function(e) {
			if ( (kindCard.css('visibility') == 'hidden') && (valCard.css('visibility') == 'hidden')) {
				kindCaption.css({'left': '-870px'});
				valCaption.css({'left': '-870px'});
				dateCard.animate({'height': '0', 'marginTop': '273'}, 1000, 'linear', function() {
					dateCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
				});			
				dateCaption.delay(1300).animate({'left': '+=870px'}, 1000, 'linear', function() {
					dateCaption.css({'display': 'none', 'left': '-870px'});
					kindCaption.css({'display': 'block'});
				});
				kindCaption.delay(2000).animate({'left': '0px'}, 1000, 'linear');
				kindCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '3s', 'height': '0'}).delay(3000).animate({'height': '273', 'marginTop': '-273'}, 1000, 'linear');
			}	else if ((dateCard.css('visibility') == 'hidden') && (valCard.css('visibility') == 'hidden')) {
					dateCaption.css({'left': '-870px'});
					valCaption.css({'left': '-870px'});
					kindCard.animate({'height': '0', 'marginTop': '273'}, 1000, 'linear', function() {
						kindCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					kindCaption.delay(1300).animate({'left': '+=870px'}, 1000, 'linear', function() {
						kindCaption.css({'display': 'none', 'left': '-870px'});
						valCaption.css({'display': 'block'});
					});
					valCaption.delay(2000).animate({'left': '0px'}, 1000, 'linear');
					valCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '3s', 'height': '0'}).delay(3000).animate({'height': '273', 'marginTop': '-273'}, 1000, 'linear');
			}	else {
					dateCaption.css({'left': '-870px'});
					kindCaption.css({'left': '-870px'});
					valCard.animate({'height': '0', 'marginTop': '273'}, 1000, 'linear', function() {
						valCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					valCaption.delay(1300).animate({'left': '+=870px'}, 1000, 'linear', function() {
						valCaption.css({'display': 'none', 'left': '-870px'});
						dateCaption.css({'display': 'block'});
					});
					dateCaption.delay(2000).animate({'left': '0px'}, 1000, 'linear');
					dateCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '3s', 'height': '0'}).delay(3000).animate({'height': '273', 'marginTop': '-273'}, 1000, 'linear');
			}
		});


		$('#prev').click(function(e) {
			if ( (kindCard.css('visibility') == 'hidden') && (valCard.css('visibility') == 'hidden')) {
				kindCaption.css({'left': '870px'});
				valCaption.css({'left': '870px'});
				dateCard.animate({'height': '0', 'marginTop': '273'}, 1000, 'linear', function() {
					dateCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
				});			
				dateCaption.delay(1300).animate({'left': '-=870px'}, 1000, 'linear', function() {
					dateCaption.css({'display': 'none', 'left': '870px'});
					valCaption.css({'display': 'block'});
				});
				valCaption.delay(2000).animate({'left': '0px'}, 1000, 'linear');
				valCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '3s', 'height': '0'}).delay(3000).animate({'height': '273', 'marginTop': '-273'}, 1000, 'linear');
			}	else if ((dateCard.css('visibility') == 'hidden') && (kindCard.css('visibility') == 'hidden')) {
					dateCaption.css({'left': '870px'});
					kindCaption.css({'left': '870px'});				
					valCard.animate({'height': '0', 'marginTop': '273'}, 1000, 'linear', function() {
						valCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					valCaption.delay(1300).animate({'left': '-=870px'}, 1000, 'linear', function() {
						valCaption.css({'display': 'none', 'left': '870px'});
						kindCaption.css({'display': 'block'});
					});
					kindCaption.delay(2000).animate({'left': '0px'}, 1000, 'linear');
					kindCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '3s', 'height': '0'}).delay(3000).animate({'height': '273', 'marginTop': '-273'}, 1000, 'linear');
			}	else {
					dateCaption.css({'left': '870px'});
					valCaption.css({'left': '870px'});
					kindCard.animate({'height': '0', 'marginTop': '273'}, 1000, 'linear', function() {
						kindCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					kindCaption.delay(1300).animate({'left': '-=870px'}, 1000, 'linear', function() {
						kindCaption.css({'display': 'none', 'left': '870px'});
						dateCaption.css({'display': 'block'});
					});
					dateCaption.delay(2000).animate({'left': '0px'}, 1000, 'linear');
					dateCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '3s', 'height': '0'}).delay(3000).animate({'height': '273', 'marginTop': '-273'}, 1000, 'linear');
			}
		});


		}
	}

});