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



//Kindness form
	$('#kindness-form input.button').click(function(e) {
		e.preventDefault();
		var form = document.getElementById('kindness-form');
		var formData = new FormData(form);
		var name = document.getElementById("form-name").value;
		var email = document.getElementById("form-email").value;

		if (name == '' || email == '') {
			$('p.form-submitted').html("Please complete all fields");		
		} else {
			$.ajax({
	      url: "/php/kindness_form.php",
				type: 'POST',
				data: formData,
				cache: false,
				dataType: "json",
				processData: false,
				contentType: false
			});
			$('p.form-submitted').html("Your form has been submitted");		
		}
	});
//end Kindness form



//Valued form
	$('#valued-form input.button').click(function(e) {
		e.preventDefault();
		var form = document.getElementById('valued-form');
		var formData = new FormData(form);
		var name = document.getElementById("form-name").value;
		var email = document.getElementById("form-email").value;

		if (name == '' || email == '') {
			$('p.form-submitted').html("Please complete all fields");		
		} else {
			$.ajax({
	      url: "/php/valued.php",
				type: 'POST',
				data: formData,
				cache: false,
				dataType: "json",
				processData: false,
				contentType: false
			});
			$('p.form-submitted').html("Your form has been submitted");		
		}
	});
//end Valued form



	$("p.firstWord").html(function(e){
  	var text= $(this).text().trim().split(" ");
  	var first = text.shift();
  	return (text.length > 0 ? "<span class='style-first'>"+ first + "</span> " : first) + text.join(" ");
	});

	$(".valued-page-img").hover(function() {
		$(".inline-space").animate({"padding-left": "3vw"}, 1000);
	}, function() {
		$(".inline-space").animate({"padding-left": "8vw"}, 1000);
	});

	$(".valued-page-img").click(function() {
		$(".inline-space").animate({"padding-left": "3vw"}, 1000);
	});






//************Particles.js************//
var body = document.body;
var html = document.documentElement;

function getHeightInPixels()
{
	return Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight ) + 'px';
}

$(window).on('resize', function(){
  $('#particle-container').css({
    height: getHeightInPixels
  });
});

	$('#particle-container').css({
  height: getHeightInPixels()
	});


	particlesJS("particle-container", {
	  "particles": {
	    "number": {
	      "value": 100,
	      "density": {
	        "enable": true,
	        "value_area": 800
	      }
	    },
	    "color": {
	      "value": "random"
	    },
	    "shape": {
	      "type": "circle",
	      "stroke": {
	        "width": 0,
	        "color": "#000000"
	      },
	      "polygon": {
	        "nb_sides": 5
	      },
	      "image": {
	        "src": "img/github.svg",
	        "width": 100,
	        "height": 100
	      }
	    },
	    "opacity": {
	      "value": 0.5,
	      "random": false,
	      "anim": {
	        "enable": false,
	        "speed": 1,
	        "opacity_min": 0.1,
	        "sync": false
	      }
	    },
	    "size": {
	      "value": 3,
	      "random": true,
	      "anim": {
	        "enable": false,
	        "speed": 40,
	        "size_min": 0.1,
	        "sync": false
	      }
	    },
	    "line_linked": {
	      "enable": false,
	      "distance": 150,
	      "color": "#ffffff",
	      "opacity": 0.4,
	      "width": 1
	    },
	    "move": {
	      "enable": true,
	      "speed": 5,
	      "direction": "none",
	      "random": false,
	      "straight": false,
	      "out_mode": "out",
	      "bounce": false,
	      "attract": {
	        "enable": false,
	        "rotateX": 600,
	        "rotateY": 1200
	      }
	    }
	  },
	  "interactivity": {
	    "detect_on": "canvas",
	    "events": {
	      "onhover": {
	        "enable": false,
	        "mode": "repulse"
	      },
	      "onclick": {
	        "enable": false,
	        "mode": "push"
	      },
	      "resize": true
	    },
	    "modes": {
	      "grab": {
	        "distance": 400,
	        "line_linked": {
	          "opacity": 1
	        }
	      },
	      "bubble": {
	        "distance": 400,
	        "size": 40,
	        "duration": 2,
	        "opacity": 8,
	        "speed": 3
	      },
	      "repulse": {
	        "distance": 200,
	        "duration": 0.4
	      },
	      "push": {
	        "particles_nb": 4
	      },
	      "remove": {
	        "particles_nb": 2
	      }
	    }
	  },
	  "retina_detect": true
	});





});