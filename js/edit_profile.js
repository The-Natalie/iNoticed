$(document).ready(function(){

	var first_name = "<?php echo $first_name; ?>";
	var age = "<?php echo $age; ?>";
	var gender = "<?=$gender?>";   
	var feet = "<?php echo $feet; ?>";
	var inches = "<?php echo $inches; ?>";
	var eyes = "<?php echo $eyes; ?>"; 
	var hair = "<?php echo $hair; ?>"; 
	var smoke = "<?php echo $smoke; ?>";
	var drugs = "<?php echo $drugs; ?>";
	var tranportation = "<?php echo $tranportation; ?>";
	var intention = "<?php echo $intention; ?>"; 
	var zip = "<?php echo $zip; ?>"; 
	var city = "<?php echo $city; ?>";
	var state = "<?php echo $state; ?>"; 
	var profession = "<?php echo $profession; ?>"; 
	var education = "<?php echo $education; ?>"; 
	var ethnicity = "<?php echo $ethnicity; ?>";
	var religion = "<?php echo $religion; ?>"; 
	var marital_status = "<?php echo $marital_status; ?>"; 
	var kids = "<?php echo $kids; ?>"; 
	var want_kids = "<?php echo $want_kids; ?>"; 
	var about_me = "<?php echo $about_me; ?>"; 

	if (first_name == null) {
		$('#first_name').attr('value', 'Enter First Name');	
	} else {
		$('#first_name').attr('value', first_name);
	}

	if (age == null) {
		$('#age').attr('value', '');	
	} else {
		$('#age').attr('value', age);
	}

	if (gender == null) {
		$("#gender option[value='']").attr('selected', 'selected'); 
	} else {
		$("#gender option[value='" + gender + "']").attr('selected', 'selected'); 
	}

	if (feet == null) {
		$("#feet option[value='']").attr('selected', 'selected'); 
	} else {
		$("#feet option[value='" + feet + "']").attr('selected', 'selected'); 
	}

	if (inches == null) {
		$("#inches option[value='']").attr('selected', 'selected'); 
	} else {
		$("#inches option[value='" + inches + "']").attr('selected', 'selected'); 
	}

	if (eyes == null) {
		$("#eyes option[value='']").attr('selected', 'selected'); 
	} else {
		$("#eyes option[value='" + eyes + "']").attr('selected', 'selected'); 
	}

	if (hair == null) {
		$("#hair option[value='']").attr('selected', 'selected'); 
	} else {
		$("#hair option[value='" + hair + "']").attr('selected', 'selected'); 
	}

	if (smoke == null) {
		$("#smoke option[value='']").attr('selected', 'selected'); 
	} else {
		$("#smoke option[value='" + smoke + "']").attr('selected', 'selected'); 
	}

	if (drugs == null) {
		$("#drugs option[value='']").attr('selected', 'selected'); 
	} else {
		$("#drugs option[value='" + drugs + "']").attr('selected', 'selected'); 
	}

	if (tranportation == null) {
		$("#tranportation option[value='']").attr('selected', 'selected'); 
	} else {
		$("#tranportation option[value='" + tranportation + "']").attr('selected', 'selected'); 
	}

	if (intention == null) {
		$("#intention option[value='']").attr('selected', 'selected'); 
	} else {
		$("#intention option[value='" + intention + "']").attr('selected', 'selected'); 
	}

	if (zip == null) {
		$('#zip').attr('value', '');	
	} else {
		$('#zip').attr('value', zip);
	}

	if (city == null) {
		$('#city').attr('value', '');	
	} else {
		$('#city').attr('value', city);
	}

	if (state == null) {
		$('#state').attr('value', '');	
	} else {
		$('#state').attr('value', state);
	}

	if (profession == null) {
		$('#profession').attr('value', '');	
	} else {
		$('#profession').attr('value', profession);
	}

	if (education == null) {
		$("#education option[value='']").attr('selected', 'selected'); 
	} else {
		$("#education option[value='" + education + "']").attr('selected', 'selected'); 
	}

	if (ethnicity == null) {
		$("#ethnicity option[value='']").attr('selected', 'selected'); 
	} else {
		$("#ethnicity option[value='" + ethnicity + "']").attr('selected', 'selected'); 
	}

	if (religion == null) {
		$('#religion').attr('value', '');	
	} else {
		$('#religion').attr('value', religion);
	}

	if (marital_status == null) {
		$("#marital_status option[value='']").attr('selected', 'selected'); 
	} else {
		$("#marital_status option[value='" + marital_status + "']").attr('selected', 'selected'); 
	}

	if (kids == null) {
		$("#kids option[value='']").attr('selected', 'selected'); 
	} else {
		$("#kids option[value='" + kids + "']").attr('selected', 'selected'); 
	}

	if (want_kids == null) {
		$("#want_kids option[value='']").attr('selected', 'selected'); 
	} else {
		$("#want_kids option[value='" + want_kids + "']").attr('selected', 'selected'); 
	}

	if (about_me == null) {
		$('#about_me').attr('value', '');	
	} else {
		$('#about_me').attr('value', about_me);
	}



});