$(document).ready(function(){

	var dateCard = $('div#card-dating');
	var dateCaption = $('#caption-dating');
	var kindCard = $('div#card-kindness');
	var kindCaption = $('#caption-kindness');
	var valCard = $('div#card-valued');
	var valCaption = $('#caption-valued');
	var screenWidth = $(window).width();
	var negScreenWidth = -screenWidth;
	var plusScreenWidth = '+=' + screenWidth;
	var minusScreenWidth = '-=' + screenWidth;
	var cardHeight;
	

	if ($('div.arrows-and-cards').width() < 600) {
		cardHeight = (($('div.arrows-and-cards').height()) - 6) / 2.3;
	}	else {
		cardHeight = ($('div.arrows-and-cards').height()) - 6;
	}

	var cardWidth = cardHeight * 1.75;
	var negMarginTop = -cardHeight;

	dateCard.css({'height': cardHeight, 'width': cardWidth});
	kindCard.css({'width': cardWidth, 'margin-left': -((cardHeight * 1.75) + 6)});
	valCard.css({'width': cardWidth, 'margin-left': -((cardHeight * 1.75) + 6)});
	$('div.card-slot').css({'width': cardWidth + 30});


	$('div#next').click(function(e) {
		if ( (kindCard.css('visibility') == 'hidden') && (valCard.css('visibility') == 'hidden')) {
			kindCaption.css({'left': negScreenWidth});
			valCaption.css({'left': negScreenWidth});
			kindCard.css({'height': '0'});
			valCard.css({'height': '0'});
			dateCard.animate({'height': '0', 'marginTop': cardHeight}, 1000, 'linear', function() {
				dateCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
			});			
			dateCaption.delay(1300).animate({'left': plusScreenWidth}, 2000, 'linear', function() {
				dateCaption.css({'display': 'none', 'left': negScreenWidth});
				kindCaption.css({'display': 'block'});
			});
			kindCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
			kindCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
		}	else if ((dateCard.css('visibility') == 'hidden') && (valCard.css('visibility') == 'hidden')) {
				dateCaption.css({'left': negScreenWidth});
				valCaption.css({'left': negScreenWidth});
				dateCard.css({'height': '0'});
				valCard.css({'height': '0'});
				kindCard.animate({'height': '0', 'marginTop': cardHeight}, 1000, 'linear', function() {
					kindCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
				});			
				kindCaption.delay(1300).animate({'left': plusScreenWidth}, 2000, 'linear', function() {
					kindCaption.css({'display': 'none', 'left': negScreenWidth});
					valCaption.css({'display': 'block'});
				});
				valCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
				valCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
		}	else {
				dateCaption.css({'left': negScreenWidth});
				kindCaption.css({'left': negScreenWidth});
				dateCard.css({'height': '0'});
				kindCard.css({'height': '0'});
				valCard.animate({'height': '0', 'marginTop': cardHeight}, 1000, 'linear', function() {
					valCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
				});			
				valCaption.delay(1300).animate({'left': plusScreenWidth}, 2000, 'linear', function() {
					valCaption.css({'display': 'none', 'left': negScreenWidth});
					dateCaption.css({'display': 'block'});
				});
				dateCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
				dateCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
		}
	});


	$('div#prev').click(function(e) {
		if ( (kindCard.css('visibility') == 'hidden') && (valCard.css('visibility') == 'hidden')) {
			kindCaption.css({'left': screenWidth});
			valCaption.css({'left': screenWidth});
			kindCard.css({'height': '0'});
			valCard.css({'height': '0'});
			dateCard.animate({'height': '0', 'marginTop': cardHeight}, 1000, 'linear', function() {
				dateCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
			});			
			dateCaption.delay(1300).animate({'left': minusScreenWidth}, 2000, 'linear', function() {
				dateCaption.css({'display': 'none', 'left': screenWidth});
				valCaption.css({'display': 'block'});
			});
			valCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
			valCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
		}	else if ((dateCard.css('visibility') == 'hidden') && (kindCard.css('visibility') == 'hidden')) {
				dateCaption.css({'left': screenWidth});
				kindCaption.css({'left': screenWidth});		
				dateCard.css({'height': '0'});
				kindCard.css({'height': '0'});		
				valCard.animate({'height': '0', 'marginTop': cardHeight}, 1000, 'linear', function() {
					valCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
				});			
				valCaption.delay(1300).animate({'left': minusScreenWidth}, 2000, 'linear', function() {
					valCaption.css({'display': 'none', 'left': screenWidth});
					kindCaption.css({'display': 'block'});
				});
				kindCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
				kindCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
		}	else {
				dateCaption.css({'left': screenWidth});
				valCaption.css({'left': screenWidth});
				dateCard.css({'height': '0'});
				valCard.css({'height': '0'});
				kindCard.animate({'height': '0', 'marginTop': cardHeight}, 1000, 'linear', function() {
					kindCard.css({'visibility': 'hidden', 'box-shadow': 'none'});					
				});			
				kindCaption.delay(1300).animate({'left': minusScreenWidth}, 2000, 'linear', function() {
					kindCaption.css({'display': 'none', 'left': screenWidth});
					dateCaption.css({'display': 'block'});
				});
				dateCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
				dateCard.css({'visibility': 'visible', 'box-shadow': '-7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
		}
	});



});