$(document).ready(function(){

	var dateCard = $('#card-dating');
	var dateCaption = $('#caption-dating');
	var kindCard = $('#card-kindness');
	var kindCaption = $('#caption-kindness');
	var valCard = $('#card-valued');
	var valCaption = $('#caption-valued');
	var screenWidth = $(window).width();
	var negScreenWidth = -screenWidth;
	var plusScreenWidth = '+=' + screenWidth;
	var minusScreenWidth = '-=' + screenWidth;
	var cardHeight = $('div.arrows-and-cards').height() - 6;
	var arrowsCardsWidth = $('div.arrows-and-cards').width();
	var cardWidth = (cardHeight * 1.75) / 1.2;
	var cardSlot = $('div.card-slot');
	var emptySpace = $('#space');

	if (cardWidth > $('div.col-sm-10').width()) {
		cardWidth = $('div.col-sm-10').width() - 40;
		$('div.card-slot').css({'border-top': '12px solid black', 'border-bottom': '12px solid black', 'border-radius': '12px'});
		$('h3').css({'font-size': '3.2em', 'margin-top': '-170', 'height': '70px'});
		$('h2').css({'font-size': '4.2em'});
		$('h1').css({'font-size': '5.2em'});		
		cardSlot.css({'width': cardWidth + 30});
	}

	var cardSlotMarginTop = cardWidth / 1.75;
	dateCard.css({'width': cardWidth});
	kindCard.css({'width': cardWidth});
	valCard.css({'width': cardWidth});
	emptySpace.css({'width': cardWidth});
	cardSlot.css({'width': cardWidth + 30});
	var negMarginTop = -cardHeight - 10;

	$('div#next').click(function(e) {
		if ( (kindCard.css('display') == 'none') && (valCard.css('display') == 'none')) {
			kindCaption.css({'left': negScreenWidth});
			valCaption.css({'left': negScreenWidth});
			dateCard.hide("slide", { 'direction': "down" }, 1000, function() {
				emptySpace.show("slide", { 'direction': "down" }, 1000).delay(2000).hide("slide", { 'direction': "down" }, 1000, function(){
						kindCard.show("slide", { 'direction': "down" }, 1000);
				});
			});
			dateCaption.delay(1300).animate({'left': plusScreenWidth}, 2000, 'linear', function() {
				dateCaption.css({'display': 'none', 'left': negScreenWidth});
				kindCaption.css({'display': 'block'});
			});
			kindCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
		}	else if ((dateCard.css('display') == 'none') && (valCard.css('display') == 'none')) {
				dateCaption.css({'left': negScreenWidth});
				valCaption.css({'left': negScreenWidth});
				kindCard.hide("slide", { 'direction': "down" }, 1000, function() {
				emptySpace.show("slide", { 'direction': "down" }, 1000).delay(2000).hide("slide", { 'direction': "down" }, 1000, function(){
						valCard.show("slide", { 'direction': "down" }, 1000);
				});
			});
				kindCaption.delay(1300).animate({'left': plusScreenWidth}, 2000, 'linear', function() {
					kindCaption.css({'display': 'none', 'left': negScreenWidth});
					valCaption.css({'display': 'block'});
				});
				valCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
		}	else {
				dateCaption.css({'left': negScreenWidth});
				kindCaption.css({'left': negScreenWidth});
				valCard.hide("slide", { 'direction': "down" }, 1000, function() {
				emptySpace.show("slide", { 'direction': "down" }, 1000).delay(2000).hide("slide", { 'direction': "down" }, 1000, function(){
						dateCard.show("slide", { 'direction': "down" }, 1000);
				});
			});
				valCaption.delay(1300).animate({'left': plusScreenWidth}, 2000, 'linear', function() {
					valCaption.css({'display': 'none', 'left': negScreenWidth});
					dateCaption.css({'display': 'block'});
				});
				dateCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
		}
	});


	$('div#prev').click(function(e) {
		if ( (kindCard.css('display') == 'none') && (valCard.css('display') == 'none')) {
			kindCaption.css({'left': screenWidth});
			valCaption.css({'left': screenWidth});
			dateCard.hide("slide", { 'direction': "down" }, 1000, function() {
				emptySpace.show("slide", { 'direction': "down" }, 1000).delay(2000).hide("slide", { 'direction': "down" }, 1000, function(){
						valCard.show("slide", { 'direction': "down" }, 1000);
				});
			});
			dateCaption.delay(1300).animate({'left': minusScreenWidth}, 2000, 'linear', function() {
				dateCaption.css({'display': 'none', 'left': screenWidth});
				valCaption.css({'display': 'block'});
			});
			valCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
		}	else if ((dateCard.css('display') == 'none') && (kindCard.css('display') == 'none')) {
				dateCaption.css({'left': screenWidth});
				kindCaption.css({'left': screenWidth});			
				valCard.hide("slide", { 'direction': "down" }, 1000, function() {
				emptySpace.show("slide", { 'direction': "down" }, 1000).delay(2000).hide("slide", { 'direction': "down" }, 1000, function(){
						kindCard.show("slide", { 'direction': "down" }, 1000);
				});
			});
				valCaption.delay(1300).animate({'left': minusScreenWidth}, 2000, 'linear', function() {
					valCaption.css({'display': 'none', 'left': screenWidth});
					kindCaption.css({'display': 'block'});
				});
				kindCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
		}	else {
				dateCaption.css({'left': screenWidth});
				valCaption.css({'left': screenWidth});
				kindCard.hide("slide", { 'direction': "down" }, 1000, function() {
				emptySpace.show("slide", { 'direction': "down" }, 1000).delay(2000).hide("slide", { 'direction': "down" }, 1000, function(){
						dateCard.show("slide", { 'direction': "down" }, 1000);
				});
			});
				kindCaption.delay(1300).animate({'left': minusScreenWidth}, 2000, 'linear', function() {
					kindCaption.css({'display': 'none', 'left': screenWidth});
					dateCaption.css({'display': 'block'});
				});
				dateCaption.delay(3000).animate({'left': '0px'}, 2000, 'linear');
		}
	});



});