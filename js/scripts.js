$(document).ready(function(){

	//Navigations:
	var datingLink = "/dating.html";
	var kindnessLink = "/kindness.html";
	var valuedLink = "/valued.html";
	var createAccountLink = "/account_creation.html";
	var signInLink = "/sign_in.html";
	// var datingSignedInHomeLink = "/php/dating_home.php";
	var messagesLink = "/php/messages.php";
	var editProfileLink = "/php/edit_profile.php";
	var accountSettingsLink = "/php/account_settings.php";
	var logoutLink = "/php/logout.php";


	//Home, Kindness and Valued pages navs:
	$('.home-nav').html('<div class="nav-left"><div class="title"><a href="/">iNoticed</a></div><a href="' + datingLink + '">Dating</a><a href="' + kindnessLink + '">Kindness</a><a href="' + valuedLink + '">Valued</a></div>');

	//Dating Signed Out pages nav:
		$('.dating-signed-out-nav').html('<div class="nav-left"><div class="title"><a href="/">iNoticed</a></div><a href="' + datingLink + '">Dating</a><a href="' + kindnessLink + '">Kindness</a><a href="' + valuedLink + '">Valued</a></div><div class="nav-right"><a href="' + createAccountLink + '"><i class="fas fa-user-plus"></i>Create Account</a><a href="' + signInLink + '"><i class="fas fa-sign-in-alt"></i>Sign In</a></div>');

	//Dating Signed in pages nav:
		$('.dating-signed-in-nav').html('<div class="nav-left"><div class="title"><a href="/">iNoticed</a></div></div><div class="nav-right"><a href="' + messagesLink + '"><i class="fas fa-envelope"></i>Messages</a><a href="' + editProfileLink + '"><i class="fas fa-address-card"></i>Edit Profile</a><a href="' + accountSettingsLink + '"><i class="fas fa-cog"></i>Account Settings</a><a href="' + logoutLink + '"><i class="fas fa-sign-out-alt"></i>Log Out</a></div>');

 

	// Home page card slider
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
	var cardHeight = ($('div.arrows-and-cards').height() - 6) / 1.2;
	var cardWidth = (cardHeight * 1.75);
	var cardSlot = $('div.card-slot');
	var emptySpace = $('#space');
	var negMarginTop = -cardHeight;

	if (cardWidth > $('div.col-sm-10').width()) {
		cardWidth = $('div.col-sm-10').width() - 40;
		cardHeight = cardWidth / 1.75;
		$('div.card-slot').css({'border-top': '12px solid black', 'border-bottom': '12px solid black', 'border-radius': '12px'});
		$('h3').css({'font-size': '3.2em', 'margin-top': '-170', 'height': '70px'});
		$('h2').css({'font-size': '4.2em'});
		$('h1').css({'font-size': '5.2em'});	
		cardSlot.css({'width': cardWidth + 30});
	}

	dateCard.css({'height': cardHeight, 'width': cardWidth});
	kindCard.css({'width': cardWidth, 'margin-left': -((cardHeight * 1.75) + 6)});
	valCard.css({'width': cardWidth, 'margin-left': -((cardHeight * 1.75) + 6)});
	cardSlot.css({'width': cardWidth + 30});

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
			kindCard.css({'visibility': 'visible', 'box-shadow': '7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': 0}, 1000, 'linear');
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
				valCard.css({'visibility': 'visible', 'box-shadow': '7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
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
				dateCard.css({'visibility': 'visible', 'box-shadow': '7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
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
			valCard.css({'visibility': 'visible', 'box-shadow': '7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
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
				kindCard.css({'visibility': 'visible', 'box-shadow': '7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
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
				dateCard.css({'visibility': 'visible', 'box-shadow': '7px -11px 12px 17px rgba(0,0,0,0.9)', 'transition': 'box-shadow .1s', 'transition-delay': '5s', 'height': '0'}).delay(5000).animate({'height': cardHeight, 'marginTop': negMarginTop}, 1000, 'linear');
		}
	});
	//End of Home page card slider



	//Dading card request form
	$('#dating-card-form input.button').click(function(e) {
		e.preventDefault();
		var form = document.getElementById('dating-card-form');
		var formData = new FormData(form);
		var name = document.getElementById("form-name").value;
		var email = document.getElementById("form-email").value;
		var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

		if (name == '' || email == '') {
			$('p.form-submitted').html("Please complete all fields");		
		} else if(!email.match(emailFormat)) {
			$('p.form-submitted').html("Please enter a valid email address");		
		} else {
			$.ajax({
	      url: "/php/dating-card_form.php",
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
	//End of Dating card request form




	//Kindness card request form
	$('#kindness-form input.button').click(function(e) {
		e.preventDefault();
		var form = document.getElementById('kindness-form');
		var formData = new FormData(form);
		var name = document.getElementById("form-name").value;
		var email = document.getElementById("form-email").value;
		var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

		if (name == '' || email == '') {
			$('p.form-submitted').html("Please complete all fields");		
		} else if(!email.match(emailFormat)) {
			$('p.form-submitted').html("Please enter a valid email address");		
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
	//End of Kindness card request form



	//Valued card request form
	$('#valued-form input.button').click(function(e) {
		e.preventDefault();
		var form = document.getElementById('valued-form');
		var formData = new FormData(form);
		var name = document.getElementById("form-name").value;
		var email = document.getElementById("form-email").value;
		var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

		if (name == '' || email == '') {
			$('p.form-submitted').html("Please complete all fields");		
		} else if(!email.match(emailFormat)) {
			$('p.form-submitted').html("Please enter a valid email address");		
		} else {
			$.ajax({
	      url: "/php/valued_form.php",
				type: 'POST',
				data: formData,
				cache: false,
				dataType: "json",
				processData: false,
				contentType: false
			});
			$('p.form-submitted').html("Your form has been submitted successfully");		
		}
	});
	//End of Valued card request form




	//first word style for <p>
	$("p.firstWord").html(function(e){
  	var text= $(this).text().trim().split(" ");
  	var first = text.shift();
  	return (text.length > 0 ? "<span class='style-first'>"+ first + "</span> " : first) + text.join(" ");
	});
	// End of first word style for <p>



	//card image enlargement animation
	$(".valued-page-img").hover(function() {
		$(".inline-space").animate({"padding-left": "3vw"}, 1000);
	}, function() {
		$(".inline-space").animate({"padding-left": "8vw"}, 1000);
	});

	$(".valued-page-img").click(function() {
		$(".inline-space").animate({"padding-left": "3vw"}, 1000);
	});
	//End of card image enlargement animation


	//Update email form
	$('button.update-email-button').click(function(e) {
		$("#update-email-form").css({"display": "block"});
	});

	//Update password form
	$('button.update-password-button').click(function(e) {
		$("#update-password-form").css({"display": "block"});
	});

	//Delete account form
	$('button.delete-account-button').click(function(e) {
		$("#delete-account-form").css({"display": "block"});
	});


	//Generate url with username on the end
	$('.generate-url-button').click(function(e) {
		var usernameVal = document.getElementById('get-username').value;
		var uniqueURL = 'inoticed.org/profile/' + usernameVal;
		$('p#unique-url').html(uniqueURL);
		$('div#generate-url').css({'display': 'block', 'margin-bottom': '24px'});
	});


	//Profile navigation change based on if user is signed in or out
	var navVal;
		if (document.getElementById('user-state')) {
			navVal = document.getElementById('user-state').value;
			if (navVal == 'signed-out-nav') {
				$('div.nav-light').html('<div class="nav-left"><div class="title"><a href="/">iNoticed</a></div><a href="/dating.html">Dating</a><a href="/kindness.html">Kindness</a><a href="/valued.html">Valued</a></div><div class="nav-right"><a href="/account_creation.html"><i class="fas fa-user-plus"></i>Create Account</a><a href="/dating_sign_in.html"><i class="fas fa-sign-in-alt"></i>Sign In</a></div>');
			} 

			if (navVal == 'signed-in-nav') {
				$('div.nav-light').html('<div class="nav-left"><div class="title"><a href="/">iNoticed</a></div></div><div class="nav-right"><a href="/php/dating_home.php"><i class="fas fa-envelope"></i>Home</a><a href="/php/messages.php"><i class="fas fa-envelope"></i>Messages</a><a href="/php/profile.php"><i class="fas fa-address-card"></i>My Profile</a><a href="/php/account_settings.php"><i class="fas fa-cog"></i>Account Settings</a><a href="/php/dating_logout.php"><i class="fas fa-sign-out-alt"></i>Log Out</a></div>');
			}
		}
	//end of profile nav change	


	//Profile page images*************************************************************************************

	$('#submitButton').click(function (e) {
		e.preventDefault();
	  $('#uploadForm').ajaxForm({
      target: '#outputImage',
      url: '/php/edit_images.php',
      beforeSubmit: function () {
    	  $("#outputImage").hide();
    	  if($("#uploadImage").val() == "") {
    		  $("#outputImage").show();
    		  $("#outputImage").html("<div class='error'>Error: Choose an image file to upload.</div>");
          return false; 
        } 
        var file_size = $('#uploadImage')[0].files[0].size;
				if(file_size>2097152) {
					$("#outputImage").html("<div class='error'>Error: Exceeded size 2MB</div>");
					$("#outputImage").show();
					return false;
				} 
        $("#progressDivId").css("display", "block");
        var percentValue = '0%';

        $('#progressBar').width(percentValue);
        $('#percent').html(percentValue);
      },
    	uploadProgress: function (event, position, total, percentComplete) {
        var percentValue = percentComplete + '%';
        $("#progressBar").animate({
          width: '' + percentValue + ''
        }, 
        {
          duration: 5000,
          easing: "linear",
          step: function (x) {
	          percentText = Math.round(x * 100 / percentComplete);
	          $("#percent").text(percentText + "%");
	          if(percentText == "100") {
	          	$("#outputImage").show();
	          }
          }
        });
      },
      error: function (response, status, e) {
        $("#outputImage").show();
	      $("#outputImage").html("<div class='error'>Oops something went wrong.</div>");
      },
      complete: function (xhr) {
        if (xhr.responseText && xhr.responseText != "error") {
          $("#outputImage").html(xhr.responseText);
        } else{  
          $("#outputImage").show();
	        $("#outputImage").html("<div class='error'>Problem in uploading file.</div>");
	        $("#progressBar").stop();
        }
      }
	  });
	});



	//End of main image post








	//.profile-thumbnails


	//End of profile page images*************************************************************************************



//************Particles.js************//

if (document.getElementById('particle-container')) {

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

	//Stop particles.js after 2 mins
	setTimeout( function(){ $("div#particle-container").remove("#particle-container"); }, 120000 );
	}
//End of particles.js



//zip code, city, and state insert from zippopotam.us
	$(function() {

		// OnKeyDown Function
		$("#zip").keyup(function() {
			var zip_in = $(this);
			var zip_box = $('#zipbox');

			if (zip_in.val().length<5) {
				zip_box.removeClass('error success');
			} else if ( zip_in.val().length>5) {
				zip_box.addClass('error').removeClass('success');
			} else if ((zip_in.val().length == 5) ) {
				// Make HTTP Request
				$.ajax({
					url: "https://api.zippopotam.us/us/" + zip_in.val(),
					cache: false,
					dataType: "json",
					type: "GET",
					success: function(result, success) {
						// US Zip Code Records Officially Map to only 1 Primary Location
						places = result['places'][0];
						$("#city").val(places['place name']);
						$("#state").val(places['state']);
						zip_box.addClass('success').removeClass('error');
					},
					error: function(result, success) {
						zip_box.removeClass('success').addClass('error');
					}
				});
			}
		});

	});
	//End of zippopotam.us

});