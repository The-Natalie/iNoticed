$(document).ready(function(){

	// function cardSlotPopup () {
		$('#next').click(function(e) {
			if ( ($('div#card-kindness').css('visibility') == 'hidden') && ($('div#card-valued').css('visibility') == 'hidden')) {
				$('#caption-kindness').css({'left': '-1000px'});
				$('#caption-valued').css({'left': '-1000px'});
				$('div#card-dating').animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
					$('div#card-dating').css({'visibility': 'hidden', 'box-shadow': 'none'});					
				});			
				$('#caption-dating').delay(1300).animate({'left': '+=1000px'}, 2000, 'linear', function() {
					$('#caption-dating').css({'display': 'none', 'left': '-1000px'});
					$('#caption-kindness').css({'display': 'block'});
				});
				$('#caption-kindness').delay(3000).animate({'left': '0px'}, 2000, 'linear');
				$('div#card-kindness').css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}	else if (($('div#card-dating').css('visibility') == 'hidden') && ($('div#card-valued').css('visibility') == 'hidden')) {
					$('#caption-dating').css({'left': '-1000px'});
					$('#caption-valued').css({'left': '-1000px'});
					$('div#card-kindness').animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
						$('div#card-kindness').css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					$('#caption-kindness').delay(1300).animate({'left': '+=1000px'}, 2000, 'linear', function() {
						$('#caption-kindness').css({'display': 'none', 'left': '-1000px'});
						$('#caption-valued').css({'display': 'block'});
					});
					$('#caption-valued').delay(3000).animate({'left': '0px'}, 2000, 'linear');
					$('div#card-valued').css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}	else {
					$('#caption-dating').css({'left': '-1000px'});
					$('#caption-kindness').css({'left': '-1000px'});
					$('div#card-valued').animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
						$('div#card-valued').css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					$('#caption-valued').delay(1300).animate({'left': '+=1000px'}, 2000, 'linear', function() {
						$('#caption-valued').css({'display': 'none', 'left': '-1000px'});
						$('#caption-dating').css({'display': 'block'});
					});
					$('#caption-dating').delay(3000).animate({'left': '0px'}, 2000, 'linear');
					$('div#card-dating').css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}
		});


		$('#prev').click(function(e) {
			if ( ($('div#card-kindness').css('visibility') == 'hidden') && ($('div#card-valued').css('visibility') == 'hidden')) {
				$('#caption-kindness').css({'left': '1000px'});
				$('#caption-valued').css({'left': '1000px'});
				$('div#card-dating').animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
					$('div#card-dating').css({'visibility': 'hidden', 'box-shadow': 'none'});					
				});			
				$('#caption-dating').delay(1300).animate({'left': '-=1000px'}, 2000, 'linear', function() {
					$('#caption-dating').css({'display': 'none', 'left': '1000px'});
					$('#caption-valued').css({'display': 'block'});
				});
				$('#caption-valued').delay(3000).animate({'left': '0px'}, 2000, 'linear');
				$('div#card-valued').css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}	else if (($('div#card-dating').css('visibility') == 'hidden') && ($('div#card-kindness').css('visibility') == 'hidden')) {
					$('#caption-dating').css({'left': '1000px'});
					$('#caption-kindness').css({'left': '1000px'});				
					$('div#card-valued').animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
						$('div#card-valued').css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					$('#caption-valued').delay(1300).animate({'left': '-=1000px'}, 2000, 'linear', function() {
						$('#caption-valued').css({'display': 'none', 'left': '1000px'});
						$('#caption-kindness').css({'display': 'block'});
					});
					$('#caption-kindness').delay(3000).animate({'left': '0px'}, 2000, 'linear');
					$('div#card-kindness').css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}	else {
					$('#caption-dating').css({'left': '1000px'});
					$('#caption-valued').css({'left': '1000px'});
					$('div#card-kindness').animate({'height': '0', 'marginTop': '229'}, 1000, 'linear', function() {
						$('div#card-kindness').css({'visibility': 'hidden', 'box-shadow': 'none'});					
					});			
					$('#caption-kindness').delay(1300).animate({'left': '-=1000px'}, 2000, 'linear', function() {
						$('#caption-kindness').css({'display': 'none', 'left': '1000px'});
						$('#caption-dating').css({'display': 'block'});
					});
					$('#caption-dating').delay(3000).animate({'left': '0px'}, 2000, 'linear');
					$('div#card-dating').css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': '229', 'marginTop': '-229'}, 1000, 'linear');
			}
		});

		
	//cardSwipe function() {}




});