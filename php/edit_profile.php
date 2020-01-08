<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: /sign_in.html');
	exit();
}

$DATABASE_HOST = 'mysql.inoticed.org';
$DATABASE_USER = 'ndhall';
$DATABASE_PASS = 'natabata14';
$DATABASE_NAME = 'inoticed_dating';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Let dating@inoticed.org know the details of this error: Failed to connect to MySQL: ' . mysqli_connect_error());
}

//Get data from database
$stmt = $con->prepare('SELECT id, first_name, age, gender, feet, inches, eyes, hair, smoke, drugs, transportation, intention, zip, city, state, profession, education, ethnicity, religion, marital_status, kids, want_kids, about_me, image_main, image1, image2, image3, image4, image5, image6, image7, image8 FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id, $first_name, $age, $gender, $feet, $inches, $eyes, $hair, $smoke, $drugs, $transportation, $intention, $zip, $city, $state, $profession, $education, $ethnicity, $religion, $marital_status, $kids, $want_kids, $about_me, $image_main, $image1, $image2, $image3, $image4, $image5, $image6, $image7, $image8);
$stmt->fetch();
$stmt->close();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">$(document).ready(function(){

	var gender = "<?=$gender?>";   
	var feet = "<?=$feet;?>";
	var inches = "<?=$inches;?>";
	var eyes = "<?=$eyes;?>"; 
	var hair = "<?=$hair;?>"; 
	var smoke = "<?=$smoke;?>";
	var drugs = "<?=$drugs;?>";
	var transportation = "<?=$transportation;?>";
	var intention = "<?=$intention;?>"; 
	var education = "<?=$education;?>"; 
	var ethnicity = "<?=$ethnicity;?>";
	var marital_status = "<?=$marital_status;?>"; 
	var kids = "<?=$kids;?>"; 
	var want_kids = "<?=$want_kids;?>"; 

	if (gender == null || gender === "") {
		$("#gender option[value='']").attr('selected', 'selected'); 
	} else {
		$("#gender option[value='" + gender + "']").attr('selected', 'selected'); 
	}

	if (feet == null || feet === "") {
		$("#feet option[value='']").attr('selected', 'selected'); 
	} else {
		$("#feet option[value='" + feet + "']").attr('selected', 'selected'); 
	}

	if (inches == null || inches === "") {
		$("#inches option[value='']").attr('selected', 'selected'); 
	} else {
		$("#inches option[value='" + inches + "']").attr('selected', 'selected'); 
	}

	if (eyes == null || eyes === "") {
		$("#eyes option[value='']").attr('selected', 'selected'); 
	} else {
		$("#eyes option[value='" + eyes + "']").attr('selected', 'selected'); 
	}

	if (hair == null || hair === "") {
		$("#hair option[value='']").attr('selected', 'selected'); 
	} else {
		$("#hair option[value='" + hair + "']").attr('selected', 'selected'); 
	}

	if (smoke == null || smoke === "") {
		$("#smoke option[value='']").attr('selected', 'selected'); 
	} else {
		$("#smoke option[value='" + smoke + "']").attr('selected', 'selected'); 
	}

	if (drugs == null || drugs === "") {
		$("#drugs option[value='']").attr('selected', 'selected'); 
	} else {
		$("#drugs option[value='" + drugs + "']").attr('selected', 'selected'); 
	}

	if (transportation == null || transportation === "") {
		$("#transportation option[value='']").attr('selected', 'selected'); 
	} else {
		$("#transportation option[value='" + transportation + "']").attr('selected', 'selected'); 
	}

	if (intention == null || intention === "") {
		$("#intention option[value='']").attr('selected', 'selected'); 
	} else {
		$("#intention option[value='" + intention + "']").attr('selected', 'selected'); 
	}

	if (education == null || education === "") {
		$('#education option[value=""]').attr("selected", "selected"); 
	} else {
		$('#education option[value="' + education + '"]').attr("selected", "selected"); 
	}

	if (ethnicity == null || ethnicity === "") {
		$("#ethnicity option[value='']").attr('selected', 'selected'); 
	} else {
		$("#ethnicity option[value='" + ethnicity + "']").attr('selected', 'selected'); 
	}

	if (marital_status == null || marital_status === "") {
		$("#marital_status option[value='']").attr('selected', 'selected'); 
	} else {
		$("#marital_status option[value='" + marital_status + "']").attr('selected', 'selected'); 
	}

	if (kids == null || kids === "") {
		$("#kids option[value='']").attr('selected', 'selected'); 
	} else {
		$("#kids option[value='" + kids + "']").attr('selected', 'selected'); 
	}

	if (want_kids == null || want_kids === "") {
		$("#want_kids option[value='']").attr('selected', 'selected'); 
	} else {
		$("#want_kids option[value='" + want_kids + "']").attr('selected', 'selected'); 
	}

	var image_main = "<?=$image_main?>";   
	var image1 = "<?=$image1?>";
	var image2 = "<?=$image2?>";
	var image3 = "<?=$image3?>";
	var image4 = "<?=$image4?>";
	var image5 = "<?=$image5?>";
	var image6 = "<?=$image6?>";
	var image7 = "<?=$image7?>";
	var image8 = "<?=$image8?>";

	if (image_main == null || image_main === "") {
		$("img#upload-main-img").css({"display": "block", "max-width": "200px"});
		$('button.delete-main-img').css({"display": "none"});
		$('img.image_main').css({"display": "none"});
	}	else {
		$('button.upload-main-img').css({"display": "none"});
	}

	if (image1 == null || image1=== "") {
		$("img#upload-img1").css({"display": "block", "max-width": "200px"});
		$('button.delete-img1').css({"display": "none"});
		$('img.image1').css({"display": "none"});
	}	else {
		$('button.upload-img1').css({"display": "none"});
	}

	if (image2 == null || image2=== "") {
		$("img#upload-img2").css({"display": "block", "max-width": "200px"});
		$('button.delete-img2').css({"display": "none"});
		$('img.image2').css({"display": "none"});
	}	else {
		$('button.upload-img2').css({"display": "none"});
	}

	if (image3 == null || image3=== "") {
		$("img#upload-img3").css({"display": "block", "max-width": "200px"});
		$('button.delete-img3').css({"display": "none"});
		$('img.image3').css({"display": "none"});
	}	else {
		$('button.upload-img3').css({"display": "none"});
	}

	if (image4 == null || image4=== "") {
		$("img#upload-img4").css({"display": "block", "max-width": "200px"});
		$('button.delete-img4').css({"display": "none"});
		$('img.image4').css({"display": "none"});
	}	else {
		$('button.upload-img4').css({"display": "none"});
	}

	if (image5 == null || image5=== "") {
		$("img#upload-img5").css({"display": "block", "max-width": "200px"});
		$('button.delete-img5').css({"display": "none"});
		$('img.image5').css({"display": "none"});
	}	else {
		$('button.upload-img5').css({"display": "none"});
	}

	if (image6 == null || image6=== "") {
		$("img#upload-img6").css({"display": "block", "max-width": "200px"});
		$('button.delete-img6').css({"display": "none"});
		$('img.image6').css({"display": "none"});
	}	else {
		$('button.upload-img6').css({"display": "none"});
	}

	if (image7 == null || image7=== "") {
		$("img#upload-img7").css({"display": "block", "max-width": "200px"});
		$('button.delete-img7').css({"display": "none"});
		$('img.image7').css({"display": "none"});
	}	else {
		$('button.upload-img7').css({"display": "none"});
	}

	if (image8 == null || image8=== "") {
		$("img#upload-img8").css({"display": "block", "max-width": "200px"});
		$('button.delete-img8').css({"display": "none"});
		$('img.image8').css({"display": "none"});
	}	else {
		$('button.upload-img8').css({"display": "none"});
	}

});</script>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>iNoticed | Dating</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="/css/styles.css"> 
		<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"> 
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
	</head>
	<body id="loggedin">

		<div class="nav-light dating-signed-in-nav">
		</div>

		<div class="content">
			<h2>Edit Profile</h2>
			<div>
				<div>
					<a href="/php/profile.php"><button class="edit-button" type="button">View my profile  <i class="fas fa-address-card"></i></button></a>
					<br />
					<br />
					<div class="main-img-div">
						<h4>Main profile image</h4>
						<img class="preview-images image_main" src="/php/<?php echo $image_main; ?>">
						<br/>
						<br/>
						<button class="edit-button upload-main-img" type="button">Upload <i class="far fa-edit"></i></button>
						<button class="edit-button delete-main-img" type="button">Delete <i class="fas fa-exclamation-triangle"></i></button>
						<div id="upload-main-img">
							<p>Upload main profile image:</p>
							<p>(Max image size is 2MB)</p>				    
					    <div class="form-container">
				        <form action="" id="uploadForm-main" name="frmupload" method="post" enctype="multipart/form-data">
				        	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
				        	<input type="hidden" name="img_value" value="image_main"/>
				        	Select image to upload:
			            <input type="file" id="uploadImage" name="uploadImage" accept="image/*" required/> <br>
			            <input id="submitButton-main" class="submit-button" type="submit" name='btnSubmit' value="Submit Image"  />
				        </form>
		  					<div class='progress' id="progressDivId-main">
		        			<div class='progress-bar' id='progressBar-main'></div>
		        			<div class='percent' id='percent-main'>0%</div>
		  					</div>
		  					<div style="height: 10px;"></div>
		  					<div class="error-main error"></div>
		  					<div id='outputImage-main'></div>
	  					</div>
						</div>
					</div>	

	        <br />      
	 				<p style="margin-bottom: 0px;">Add/edit up to 8 additional images:</p>
	 				<p>(Max image size is 2MB each)</p>		
	 				<div id="img-table">
	 					<table style="width:100%;">
					  	<tr>
					    	<td class="even-cols">
					    		<h4>Image 1</h4>
									<img class="preview-images image1" src="/php/<?php echo $image1; ?>">
									<br/>
									<br/>
									<button class="edit-button upload-img1" type="button">Upload <i class="far fa-edit"></i></button>
									<button class="edit-button delete-img1" type="button">Delete <i class="fas fa-exclamation-triangle"></i></button>
									<div id="upload-img1">
								    <div class="form-container">
							        <form action="" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
							        	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
							        	<input type="hidden" name="img_value" value="image1"/>
							        	Select image to upload:
						            <input type="file" id="uploadImage" name="uploadImage" accept="image/*" required/> <br>
						            <input id="submitButton" class="submit-button" type="submit" name='btnSubmit' value="Submit Image"  />
							        </form>
					  					<div class='progress' id="progressDivId">
					        			<div class='progress-bar' id='progressBar'></div>
					        			<div class='percent' id='percent'>0%</div>
					  					</div>
					  					<div style="height: 10px;"></div>
					  					<div class="error"></div>
					  					<div id='outputImage'></div>
				  					</div>
									</div>
					    	</td>

					    	<td class="even-cols">
					    		<h4>Image 2</h4>
					    		<img class="preview-images image2" src="/php/<?php echo $image2; ?>">
									<br/>
									<br/>
									<button class="edit-button upload-img2" type="button">Upload <i class="far fa-edit"></i></button>
									<button class="edit-button delete-img2" type="button">Delete <i class="fas fa-exclamation-triangle"></i></button>
									<div id="upload-img2">
								    <div class="form-container">
							        <form action="" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
							        	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
							        	<input type="hidden" name="img_value" value="image2"/>
							        	Select image to upload:
						            <input type="file" id="uploadImage" name="uploadImage" accept="image/*" required/> <br>
						            <input id="submitButton" class="submit-button" type="submit" name='btnSubmit' value="Submit Image"  />
							        </form>
					  					<div class='progress' id="progressDivId">
					        			<div class='progress-bar' id='progressBar'></div>
					        			<div class='percent' id='percent'>0%</div>
					  					</div>
					  					<div style="height: 10px;"></div>
					  					<div class="error"></div>
					  					<div id='outputImage'></div>
				  					</div>
									</div>
					    	</td>
					  	
					    	<td class="even-cols">
					    		<h4>Image 3</h4>
					    		<img class="preview-images image3" src="/php/<?php echo $image3; ?>">
									<br/>
									<br/>
									<button class="edit-button upload-img3" type="button">Upload <i class="far fa-edit"></i></button>
									<button class="edit-button delete-img3" type="button">Delete <i class="fas fa-exclamation-triangle"></i></button>
									<div id="upload-img3">
								    <div class="form-container">
							        <form action="" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
							        	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
							        	<input type="hidden" name="img_value" value="image3"/>
							        	Select image to upload:
						            <input type="file" id="uploadImage" name="uploadImage" accept="image/*" required/> <br>
						            <input id="submitButton" class="submit-button" type="submit" name='btnSubmit' value="Submit Image"  />
							        </form>
					  					<div class='progress' id="progressDivId">
					        			<div class='progress-bar' id='progressBar'></div>
					        			<div class='percent' id='percent'>0%</div>
					  					</div>
					  					<div style="height: 10px;"></div>
					  					<div class="error"></div>
					  					<div id='outputImage'></div>
				  					</div>
									</div>
					    	</td>
					    </tr>
					    	
					    <tr>
					    	<td class="even-cols">
					    		<h4>Image 4</h4>
					    		<img class="preview-images image4" src="/php/<?php echo $image4; ?>">
									<br/>
									<br/>
									<button class="edit-button upload-img4" type="button">Upload <i class="far fa-edit"></i></button>
									<button class="edit-button delete-img4" type="button">Delete <i class="fas fa-exclamation-triangle"></i></button>
									<div id="upload-img4">
								    <div class="form-container">
							        <form action="" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
							        	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
							        	<input type="hidden" name="img_value" value="image4"/>
							        	Select image to upload:
						            <input type="file" id="uploadImage" name="uploadImage" accept="image/*" required/> <br>
						            <input id="submitButton" class="submit-button" type="submit" name='btnSubmit' value="Submit Image"  />
							        </form>
					  					<div class='progress' id="progressDivId">
					        			<div class='progress-bar' id='progressBar'></div>
					        			<div class='percent' id='percent'>0%</div>
					  					</div>
					  					<div style="height: 10px;"></div>
					  					<div class="error"></div>
					  					<div id='outputImage'></div>
				  					</div>
									</div>
					    	</td>
					  	
					    	<td class="even-cols">
					    		<h4>Image 5</h4>
					    		<img class="preview-images image5" src="/php/<?php echo $image5; ?>">
									<br/>
									<br/>
									<button class="edit-button upload-img5" type="button">Upload <i class="far fa-edit"></i></button>
									<button class="edit-button delete-img5" type="button">Delete <i class="fas fa-exclamation-triangle"></i></button>
									<div id="upload-img5">
								    <div class="form-container">
							        <form action="" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
							        	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
							        	<input type="hidden" name="img_value" value="image5"/>
							        	Select image to upload:
						            <input type="file" id="uploadImage" name="uploadImage" accept="image/*" required/> <br>
						            <input id="submitButton" class="submit-button" type="submit" name='btnSubmit' value="Submit Image"  />
							        </form>
					  					<div class='progress' id="progressDivId">
					        			<div class='progress-bar' id='progressBar'></div>
					        			<div class='percent' id='percent'>0%</div>
					  					</div>
					  					<div style="height: 10px;"></div>
					  					<div class="error"></div>
					  					<div id='outputImage'></div>
				  					</div>
									</div>
					    	</td>

					    	<td class="even-cols">
					    		<h4>Image 6</h4>
					    		<img class="preview-images image6" src="/php/<?php echo $image6; ?>">
									<br/>
									<br/>
									<button class="edit-button upload-img6" type="button">Upload <i class="far fa-edit"></i></button>
									<button class="edit-button delete-img6" type="button">Delete <i class="fas fa-exclamation-triangle"></i></button>
									<div id="upload-img6">
								    <div class="form-container">
							        <form action="" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
							        	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
							        	<input type="hidden" name="img_value" value="image6"/>
							        	Select image to upload:
						            <input type="file" id="uploadImage" name="uploadImage" accept="image/*" required/> <br>
						            <input id="submitButton" class="submit-button" type="submit" name='btnSubmit' value="Submit Image"  />
							        </form>
					  					<div class='progress' id="progressDivId">
					        			<div class='progress-bar' id='progressBar'></div>
					        			<div class='percent' id='percent'>0%</div>
					  					</div>
					  					<div style="height: 10px;"></div>
					  					<div class="error"></div>
					  					<div id='outputImage'></div>
				  					</div>
									</div>
					    	</td>
					  	</tr>

					  	<tr>
					    	<td class="even-cols">
					    		<h4>Image 7</h4>
					    		<img class="preview-images image7" src="/php/<?php echo $image7; ?>">
									<br/>
									<br/>
									<button class="edit-button upload-img7" type="button">Upload <i class="far fa-edit"></i></button>
									<button class="edit-button delete-img7" type="button">Delete <i class="fas fa-exclamation-triangle"></i></button>
									<div id="upload-img7">
								    <div class="form-container">
							        <form action="" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
							        	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
							        	<input type="hidden" name="img_value" value="image7"/>
							        	Select image to upload: &nbsp;
						            <input type="file" id="uploadImage" name="uploadImage" accept="image/*" required/> <br>
						            <input id="submitButton" class="submit-button" type="submit" name='btnSubmit' value="Submit Image"  />
							        </form>
					  					<div class='progress' id="progressDivId">
					        			<div class='progress-bar' id='progressBar'></div>
					        			<div class='percent' id='percent'>0%</div>
					  					</div>
					  					<div style="height: 10px;"></div>
					  					<div class="error"></div>
					  					<div id='outputImage'></div>
				  					</div>
									</div>
					    	</td>

					    	<td class="even-cols">
					    		<h4>Image 8</h4>
					    		<img class="preview-images image8" src="/php/<?php echo $image8; ?>">
					    		<br/>
									<br/>
									<button class="edit-button upload-img8" type="button">Upload <i class="far fa-edit"></i></button>
									<button class="edit-button delete-img8" type="button">Delete <i class="fas fa-exclamation-triangle"></i></button>
									<div id="upload-img8">
								    <div class="form-container">
							        <form action="" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
							        	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
							        	<input type="hidden" name="img_value" value="image8"/>
							        	Select image to upload: &nbsp;
						            <input type="file" id="uploadImage" name="uploadImage" accept="image/*" required/> <br>
						            <input id="submitButton" class="submit-button" type="submit" name='btnSubmit' value="Submit Image"  />
							        </form>
					  					<div class='progress' id="progressDivId">
					        			<div class='progress-bar' id='progressBar'></div>
					        			<div class='percent' id='percent'>0%</div>
					  					</div>
					  					<div style="height: 10px;"></div>
					  					<div class="error"></div>
					  					<div id='outputImage'></div>
				  					</div>
									</div>
					    	</td>
					  	</tr>
						</table>	
	 				</div>		    	
 				</div>

        <br />
        <br />
				<p>Edit Profile:</p>
				<form id="edit_profile" method="post" action="/php/updated_profile.php">
					<p>First Name:&nbsp;&nbsp;<input id ="first_name" type="text" name="first_name" size="20" value="<?=$first_name?>" required/></p>
					<p>Age:&nbsp;&nbsp;<input id="age" type="number" name="age" min="13" max="125" size="3" value="<?=$age?>" required/></p>
					<p>Gender:&nbsp;&nbsp;
 						<select id="gender" name="gender" size="1" required>
 							<option value="">[Choose Option Below]</option>
					    <option value="Female">Female</option>
					    <option value="Male">Male</option>
					    <option value="Queer">Queer</option>
					    <option value="Nonbinary">Nonbinary</option>
					    <option value="Genderfluid">Genderfluid</option>
					    <option value="Agender/Gender-Neutral">Agender/Gender-Neutral</option>
					    <option value="Transgender">Transgender</option>
					    <option value="Gender Transition">Gender Transition</option>
					  </select>
					</p>
					<p>Height:&nbsp;&nbsp;
						<select id="feet" name="feet" size="1" required>
							<option value="">Feet</option>
					    <option value="2">2</option>
					    <option value="3">3</option>
					    <option value="4">4</option>
					    <option value="5">5</option>
					    <option value="6">6</option>
					    <option value="7">7</option>
				  	</select>
				  	<select id="inches" name="inches" size="1" required>
				  		<option value="">Inches</option>
				  		<option value="0">0</option>
				  		<option value="1">1</option>
					    <option value="2">2</option>
					    <option value="3">3</option>
					    <option value="4">4</option>
					    <option value="5">5</option>
					    <option value="6">6</option>
					    <option value="7">7</option>
					    <option value="8">8</option>
					    <option value="9">9</option>
					    <option value="10">10</option>
					    <option value="11">11</option>
					    <option value="12">12</option>
				  	</select>
				  </p>
			  	<p>Eye Color:&nbsp;&nbsp;
						<select id="eyes" name="eyes" size="1" required>
							<option value="">[Choose]</option>
					    <option value="blue">Blue</option>
					    <option value="green">Green</option>
					    <option value="brown">Brown</option>
					    <option value="hazel">Hazel</option>
					    <option value="grey">Grey</option>
					    <option value="blue-green">Blue-green</option>
					    <option value="colored contacts">Colored Contacts</option>
			  		</select>
			  	</p>
			  	<p>Hair Color:&nbsp;&nbsp;
						<select id="hair" name="hair" size="1" required>
							<option value="">[Choose]</option>
					    <option value="blond">Blond</option>
					    <option value="brown">Brown</option>
					    <option value="red">Red</option>
					    <option value="black">Black</option>
					    <option value="white">White</option>
					    <option value="grey">Grey</option>
					    <option value="unnatural color">Unnatural Color</option>
			  		</select>
			  	</p>
			  	<p>Do I smoke:&nbsp;&nbsp;
						<select id="smoke" name="smoke" size="1" required>
							<option value="">[Choose]</option>
					    <option value="yes">Yes</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>Do I do drugs:&nbsp;&nbsp;
						<select id="drugs" name="drugs" size="1" required>
							<option value="">[Choose]</option>
					    <option value="yes">Yes</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>Do I own a car/truck/motorcycle/something with a motor to get me around:&nbsp;&nbsp;
						<select id="transportation" name="transportation" size="1" required>
							<option value="">[Choose]</option>
					    <option value="yes">Yes</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>What kind of relationship I'm looking for:&nbsp;&nbsp;
						<select id="intention" name="intention" size="1" required>
							<option value="">[Choose]</option>
					    <option value="serious/long term">Serious/Long Term</option>
					    <option value="dating/short term">Dating/Short Term</option>
					    <option value="marriage">Marriage</option>
					    <option value="just looking">Just Looking</option>
					    <option value="hookup">Hookup</option>
					    <option value="friends with benefits">Friends With Benefits</option>
			  		</select>
			  	</p>
					<p>Location (enter your zip and the rest will be completed automatically):
						<fieldset>
							<div id="zipbox" class="control-group">
								<label for="zip" style="font-size: 1.25em;">Zip:&nbsp;&nbsp;</label>
								<input id="zip"  style="font-size: 1.25em;" type="text" pattern="[0-9]*" name="zip" value="<?=$zip?>" required/>
							</div>
							<div>
								<div id="citybox" class="control-group">
									<label for="city" style="font-size: 1.25em;">City:&nbsp;&nbsp;</label>
									<input style="font-size: 1.25em;" id="city" type="text" name="city" value="<?=$city?>" required/>
								</div>
								<div id="statebox" class="control-group">
									<label for="state"  style="font-size: 1.25em;">State:&nbsp;&nbsp;</label>
									<input style="font-size: 1.25em;" id="state" type="text" name="state" value="<?=$state?>" required/>
								</div>
							</div>
						</fieldset>
					</p>
					<p>Profession:&nbsp;&nbsp;<input id="profession" type="text" name="profession" size="25" value="<?=$profession?>" required/></p>
					<p>Highest level of education:&nbsp;&nbsp;
						<select id="education" name="education" size="1" required>
							<option value="">[Choose]</option>
					    <option value="some high school or lower">Some High School or Lower</option>
					    <option value="high school degree/GED">High School Degree/GED</option>
					    <option value="some college">Some College</option>
					    <option value="associate's degree">Associate's Degree</option>
					    <option value="bachelor's degree">Bachelor's Degree</option>
					    <option value="master's degree">Master's Degree</option>
					    <option value="doctoral degree">Doctoral Degree</option>
			  		</select>
			  	</p>
			  	<p>Ethnicity:&nbsp;&nbsp;
			  		<select id="ethnicity" name="ethnicity" size="1" required>
			  			<option value="">[Choose]</option>
					    <option value="Asian">Asian</option>
					    <option value="Black/African">Black/African</option>
					    <option value="Caucasian">Caucasian</option>
					    <option value="Hispanic/Latino">Hispanic/Latino</option>
					    <option value="Native American">Native American</option>
					    <option value="Pacific Islander">Pacific Islander</option>
					    <option value="mixed race">Mixed Race</option>
					    <option value="other">Other</option>
			  		</select>
			  	</p>
					<p>Religion:&nbsp;&nbsp;<input id="religion" type="text" name="religion" size="30" value="<?=$religion?>" required/></p>
					<p>Marital status:&nbsp;&nbsp;
			  		<select id="marital_status" name="marital_status" size="1" required>
			  			<option value="">[Choose]</option>
					    <option value="single">Single</option>
					    <option value="in a relationship">In a Relationship</option>
					    <option value="engaged">Engaged</option>
					    <option value="married">Married</option>
					    <option value="divorced">Divorced</option>
					    <option value="seperated">Seperated</option>
					    <option value="widowed">Widowed</option>
			  		</select>
			  	</p>
			  	<p>Have kids (if yes, how many)?:&nbsp;&nbsp;
			  		<select id="kids" name="kids" size="1" required>
			  			<option value="">[Choose]</option>
					    <option value="yes, 1 or 2">Yes, 1 or 2</option>
					    <option value="yes, 3 or 4">Yes, 3 or 4</option>
					    <option value="yes, 5 or 6">Yes, 5 or 6</option>
					    <option value="yes, 7+">Yes, 7+</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>Want kids?:&nbsp;&nbsp;
			  		<select id="want_kids" name="want_kids" size="1" required>
			  			<option value="">[Choose]</option>
					    <option value="yes">Yes</option>
					    <option value="no">No</option>
			  		</select>
			  	</p>
			  	<p>About me and what I'm looking for:</p>
			  	<span  style="font-size: 1.3em;"><textarea id="about_me" name="about_me" style="min-width:75%;" rows="10"><?=$about_me?></textarea></span><br />
					<input type="hidden" name="id" value="<?php echo $id; ?>"/>
						<input class="submit-button" style="margin-top: 20px; font-size: 1.6em; padding-bottom: 30px" type="submit" value="Submit"/>
				</form>	
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script type="text/javascript" src="/js/scripts.js"></script>
	</body>
</html>
