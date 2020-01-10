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
	//check that image is less than 2mb
	$('#uploadImage').on('change', function() {  
    //The maximum size that the uploaded file can be.
    var maxSizeMb = 2; 
    //Get the file that has been selected by
    //using JQuery's selector.
    var file = $('#uploadImage')[0].files[0];

    //Make sure that a file has been selected before
    //attempting to get its size.
    if(file !== undefined){
 
      //Get the size of the input file.
      var totalSize = file.size;

      //Convert bytes into MB.
      var totalSizeMb = totalSize  / Math.pow(1024,2);

      //Check to see if it is too large.
      if(totalSizeMb > maxSizeMb){
 
        //Create an error message to show to the user.
        var errorMsg = '<div class="error">File too large. Maximum file size is ' + maxSizeMb + 'MB. Selected file is ' + totalSizeMb.toFixed(2) + 'MB</div>';

        //Show the error.
		   	$(".error").html(errorMsg);
		   	this.value = "";

        //Return FALSE.
        return false;
    	}

    }
 
  });
	//end of image check

	//main image posting
  $('#submitButton-main').click(function () {
    $('#uploadForm-main').ajaxForm({
      target: '#outputImage-main',
      url: '/php/edit_images.php',
      beforeSubmit: function () {
    	  $("#outputImage-main").hide();
        $("#progressDivId-main").css("display", "inline-block");
        var percentValue = '0%';

        $('#progressBar-main').width(percentValue);
        $('#percent-main').html(percentValue);
      },
      uploadProgress: function (event, position, total, percentComplete) {
	      var percentValue = percentComplete + '%';
	      $("#progressBar-main").animate({
	          width: '' + percentValue + ''
	      }, {
          // duration: 5000,
          easing: "linear",
          step: function (x) {
            percentText = Math.round(x * 100 / percentComplete);
            $("#percent-main").text(percentText + "%");
            if(percentText == "100") {
        	   	$("#outputImage-main").show();
            }
          }
        });
      },
      error: function (response, status, e) {
        alert('Oops something went wrong.');
      },
  	        
      complete: function (xhr) {
        if (xhr.responseText && xhr.responseText != "error") {
      	   $("#outputImage-main").html(xhr.responseText);
        } else{  
         	$(".error-main").html("<div class='error'>Problem in uploading file.</div>");
        	$("#progressBar-main").stop();
        }
      }
    });
  });

	//Hide upload button and show the browse and submit button
	$('button.upload-main-img').click(function(e) {
		$("#upload-main-img").css({"display": "block"});
		$('button.upload-main-img').css({"display": "none"});
	});

	//Delete image
  $('button.delete-main-img').click(function(){
    var dataID = $(this).data('id');
 
    // Selecting image source
    var imgElement_src = $( '.image_'+dataID ).attr("src");

    //Selecting image value and user ID for mysql column
    var imgValue = $('#value-main-image').val();
    var userID = $('#user-id').val();
 
    // AJAX request
    $.ajax({
      url: '/php/delete_images.php',
      type: 'post',
      data: {path: imgElement_src,
      			value: imgValue,
      			id: userID},
      success: function(response){
 
        // When removed: add message, show upload button, and hide delete button, main image and the upload div 
        if(response == 1){
          $("#delete-response-main").html("<p>This image has been deleted successfully</p>");
          $("button.upload-main-img").css({"display": "block"});
					$('button.delete-main-img').css({"display": "none"});
					$('img.image_main').css({"display": "none"});
					$("#upload-main-img").css({"display": "none"});

        }
      }
    });
  });

  //end of main image

	

	//image1 posting
  $('#submitButton-1').click(function () {
    $('#uploadForm-1').ajaxForm({
      target: '#outputImage-1',
      url: '/php/edit_images.php',
      beforeSubmit: function () {
    	  $("#outputImage-1").hide();
        $("#progressDivId-1").css("display", "inline-block");
        var percentValue = '0%';

        $('#progressBar-1').width(percentValue);
        $('#percent-1').html(percentValue);
      },
      uploadProgress: function (event, position, total, percentComplete) {
	      var percentValue = percentComplete + '%';
	      $("#progressBar-1").animate({
	          width: '' + percentValue + ''
	      }, {
          // duration: 5000,
          easing: "linear",
          step: function (x) {
            percentText = Math.round(x * 100 / percentComplete);
            $("#percent-1").text(percentText + "%");
            if(percentText == "100") {
        	   	$("#outputImage-1").show();
            }
          }
        });
      },
      error: function (response, status, e) {
        alert('Oops something went wrong.');
      },
  	        
      complete: function (xhr) {
        if (xhr.responseText && xhr.responseText != "error") {
      	   $("#outputImage-1").html(xhr.responseText);
        } else{  
         	$(".error-1").html("<div class='error'>Problem in uploading file.</div>");
        	$("#progressBar-1").stop();
        }
      }
    });
  });

	//Hide upload button and show the browse and submit button
	$('button.upload-img1').click(function(e) {
		$("#upload-img1").css({"display": "block"});
		$('button.upload-img1').css({"display": "none"});
	});
  //end of image1



	//image2 posting
  $('#submitButton-2').click(function () {
    $('#uploadForm-2').ajaxForm({
      target: '#outputImage-2',
      url: '/php/edit_images.php',
      beforeSubmit: function () {
    	  $("#outputImage-2").hide();
        $("#progressDivId-2").css("display", "inline-block");
        var percentValue = '0%';

        $('#progressBar-2').width(percentValue);
        $('#percent-2').html(percentValue);
      },
      uploadProgress: function (event, position, total, percentComplete) {
	      var percentValue = percentComplete + '%';
	      $("#progressBar-2").animate({
	          width: '' + percentValue + ''
	      }, {
          // duration: 5000,
          easing: "linear",
          step: function (x) {
            percentText = Math.round(x * 100 / percentComplete);
            $("#percent-2").text(percentText + "%");
            if(percentText == "100") {
        	   	$("#outputImage-2").show();
            }
          }
        });
      },
      error: function (response, status, e) {
        alert('Oops something went wrong.');
      },
  	        
      complete: function (xhr) {
        if (xhr.responseText && xhr.responseText != "error") {
      	   $("#outputImage-2").html(xhr.responseText);
        } else{  
         	$(".error-2").html("<div class='error'>Problem in uploading file.</div>");
        	$("#progressBar-2").stop();
        }
      }
    });
  });

	//Hide image2 upload button and show the browse and submit button
	$('button.upload-img2').click(function(e) {
		$("#upload-img2").css({"display": "block"});
		$('button.upload-img2').css({"display": "none"});
	});
	//end of image2



	//image3 posting
  $('#submitButton-3').click(function () {
    $('#uploadForm-3').ajaxForm({
      target: '#outputImage-3',
      url: '/php/edit_images.php',
      beforeSubmit: function () {
    	  $("#outputImage-3").hide();
        $("#progressDivId-3").css("display", "inline-block");
        var percentValue = '0%';

        $('#progressBar-3').width(percentValue);
        $('#percent-3').html(percentValue);
      },
      uploadProgress: function (event, position, total, percentComplete) {
	      var percentValue = percentComplete + '%';
	      $("#progressBar-3").animate({
	          width: '' + percentValue + ''
	      }, {
          // duration: 5000,
          easing: "linear",
          step: function (x) {
            percentText = Math.round(x * 100 / percentComplete);
            $("#percent-3").text(percentText + "%");
            if(percentText == "100") {
        	   	$("#outputImage-3").show();
            }
          }
        });
      },
      error: function (response, status, e) {
        alert('Oops something went wrong.');
      },
  	        
      complete: function (xhr) {
        if (xhr.responseText && xhr.responseText != "error") {
      	   $("#outputImage-3").html(xhr.responseText);
        } else{  
         	$(".error-3").html("<div class='error'>Problem in uploading file.</div>");
        	$("#progressBar-3").stop();
        }
      }
    });
  });

	//Hide image3 upload button and show the browse and submit button
	$('button.upload-img3').click(function(e) {
		$("#upload-img3").css({"display": "block"});
		$('button.upload-img3').css({"display": "none"});
	});
  //end of image3


	//image4 posting
  $('#submitButton-4').click(function () {
    $('#uploadForm-4').ajaxForm({
      target: '#outputImage-4',
      url: '/php/edit_images.php',
      beforeSubmit: function () {
    	  $("#outputImage-4").hide();
        $("#progressDivId-4").css("display", "inline-block");
        var percentValue = '0%';

        $('#progressBar-4').width(percentValue);
        $('#percent-4').html(percentValue);
      },
      uploadProgress: function (event, position, total, percentComplete) {
	      var percentValue = percentComplete + '%';
	      $("#progressBar-4").animate({
	          width: '' + percentValue + ''
	      }, {
          // duration: 5000,
          easing: "linear",
          step: function (x) {
            percentText = Math.round(x * 100 / percentComplete);
            $("#percent-4").text(percentText + "%");
            if(percentText == "100") {
        	   	$("#outputImage-4").show();
            }
          }
        });
      },
      error: function (response, status, e) {
        alert('Oops something went wrong.');
      },
  	        
      complete: function (xhr) {
        if (xhr.responseText && xhr.responseText != "error") {
      	   $("#outputImage-4").html(xhr.responseText);
        } else{  
         	$(".error-4").html("<div class='error'>Problem in uploading file.</div>");
        	$("#progressBar-4").stop();
        }
      }
    });
  });

	//Hide image4 upload button and show the browse and submit button
	$('button.upload-img4').click(function(e) {
		$("#upload-img4").css({"display": "block"});
		$('button.upload-img4').css({"display": "none"});
	});
  //end of image4


	//image5 posting
  $('#submitButton-5').click(function () {
    $('#uploadForm-5').ajaxForm({
      target: '#outputImage-5',
      url: '/php/edit_images.php',
      beforeSubmit: function () {
    	  $("#outputImage-5").hide();
        $("#progressDivId-5").css("display", "inline-block");
        var percentValue = '0%';

        $('#progressBar-5').width(percentValue);
        $('#percent-5').html(percentValue);
      },
      uploadProgress: function (event, position, total, percentComplete) {
	      var percentValue = percentComplete + '%';
	      $("#progressBar-5").animate({
	          width: '' + percentValue + ''
	      }, {
          // duration: 5000,
          easing: "linear",
          step: function (x) {
            percentText = Math.round(x * 100 / percentComplete);
            $("#percent-5").text(percentText + "%");
            if(percentText == "100") {
        	   	$("#outputImage-5").show();
            }
          }
        });
      },
      error: function (response, status, e) {
        alert('Oops something went wrong.');
      },
  	        
      complete: function (xhr) {
        if (xhr.responseText && xhr.responseText != "error") {
      	   $("#outputImage-5").html(xhr.responseText);
        } else{  
         	$(".error-5").html("<div class='error'>Problem in uploading file.</div>");
        	$("#progressBar-5").stop();
        }
      }
    });
  });

	//Hide image5 upload button and show the browse and submit button
	$('button.upload-img5').click(function(e) {
		$("#upload-img5").css({"display": "block"});
		$('button.upload-img5').css({"display": "none"});
	});
  //end of image5


	//image6 posting
  $('#submitButton-6').click(function () {
    $('#uploadForm-6').ajaxForm({
      target: '#outputImage-6',
      url: '/php/edit_images.php',
      beforeSubmit: function () {
    	  $("#outputImage-6").hide();
        $("#progressDivId-6").css("display", "inline-block");
        var percentValue = '0%';

        $('#progressBar-6').width(percentValue);
        $('#percent-6').html(percentValue);
      },
      uploadProgress: function (event, position, total, percentComplete) {
	      var percentValue = percentComplete + '%';
	      $("#progressBar-6").animate({
	          width: '' + percentValue + ''
	      }, {
          // duration: 5000,
          easing: "linear",
          step: function (x) {
            percentText = Math.round(x * 100 / percentComplete);
            $("#percent-6").text(percentText + "%");
            if(percentText == "100") {
        	   	$("#outputImage-6").show();
            }
          }
        });
      },
      error: function (response, status, e) {
        alert('Oops something went wrong.');
      },
  	        
      complete: function (xhr) {
        if (xhr.responseText && xhr.responseText != "error") {
      	   $("#outputImage-6").html(xhr.responseText);
        } else{  
         	$(".error-6").html("<div class='error'>Problem in uploading file.</div>");
        	$("#progressBar-6").stop();
        }
      }
    });
  });

	//Hide image6 upload button and show the browse and submit button
	$('button.upload-img6').click(function(e) {
		$("#upload-img6").css({"display": "block"});
		$('button.upload-img6').css({"display": "none"});
	});
  //end of image6


	//image7 posting
  $('#submitButton-7').click(function () {
    $('#uploadForm-7').ajaxForm({
      target: '#outputImage-7',
      url: '/php/edit_images.php',
      beforeSubmit: function () {
    	  $("#outputImage-7").hide();
        $("#progressDivId-7").css("display", "inline-block");
        var percentValue = '0%';

        $('#progressBar-7').width(percentValue);
        $('#percent-7').html(percentValue);
      },
      uploadProgress: function (event, position, total, percentComplete) {
	      var percentValue = percentComplete + '%';
	      $("#progressBar-7").animate({
	          width: '' + percentValue + ''
	      }, {
          // duration: 5000,
          easing: "linear",
          step: function (x) {
            percentText = Math.round(x * 100 / percentComplete);
            $("#percent-7").text(percentText + "%");
            if(percentText == "100") {
        	   	$("#outputImage-7").show();
            }
          }
        });
      },
      error: function (response, status, e) {
        alert('Oops something went wrong.');
      },
  	        
      complete: function (xhr) {
        if (xhr.responseText && xhr.responseText != "error") {
      	   $("#outputImage-7").html(xhr.responseText);
        } else{  
         	$(".error-7").html("<div class='error'>Problem in uploading file.</div>");
        	$("#progressBar-7").stop();
        }
      }
    });
  });

	//Hide image7 upload button and show the browse and submit button
	$('button.upload-img7').click(function(e) {
		$("#upload-img7").css({"display": "block"});
		$('button.upload-img7').css({"display": "none"});
	});
  //end of image7


	//image8 posting

  $('#submitButton-8').click(function () {
    $('#uploadForm-8').ajaxForm({
      target: '#outputImage-8',
      url: '/php/edit_images.php',
      beforeSubmit: function () {
    	  $("#outputImage-8").hide();
        $("#progressDivId-8").css("display", "inline-block");
        var percentValue = '0%';

        $('#progressBar-8').width(percentValue);
        $('#percent-8').html(percentValue);
      },
      uploadProgress: function (event, position, total, percentComplete) {
	      var percentValue = percentComplete + '%';
	      $("#progressBar-8").animate({
	          width: '' + percentValue + ''
	      }, {
          // duration: 5000,
          easing: "linear",
          step: function (x) {
            percentText = Math.round(x * 100 / percentComplete);
            $("#percent-8").text(percentText + "%");
            if(percentText == "100") {
        	   	$("#outputImage-8").show();
            }
          }
        });
      },
      error: function (response, status, e) {
        alert('Oops something went wrong.');
      },
  	        
      complete: function (xhr) {
        if (xhr.responseText && xhr.responseText != "error") {
      	   $("#outputImage-8").html(xhr.responseText);
        } else{  
         	$(".error-8").html("<div class='error'>Problem in uploading file.</div>");
        	$("#progressBar-8").stop();
        }
      }
    });
  });

	//Hide image8 upload button and show the browse and submit button
	$('button.upload-img8').click(function(e) {
		$("#upload-img8").css({"display": "block"});
		$('button.upload-img8').css({"display": "none"});
	});
  //end of image8

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