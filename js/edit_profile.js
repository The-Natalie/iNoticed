$(document).ready(function(){

	var gender = "<?=$gender?>";   
	var feet = "<?php echo $feet; ?>";
	var inches = "<?php echo $inches; ?>";
	var eyes = "<?php echo $eyes; ?>"; 
	var hair = "<?php echo $hair; ?>"; 
	var smoke = "<?php echo $smoke; ?>";
	var drugs = "<?php echo $drugs; ?>";
	var tranportation = "<?php echo $tranportation; ?>";
	var intention = "<?php echo $intention; ?>"; 
	var education = "<?php echo $education; ?>"; 
	var ethnicity = "<?php echo $ethnicity; ?>";
	var marital_status = "<?php echo $marital_status; ?>"; 
	var kids = "<?php echo $kids; ?>"; 
	var want_kids = "<?php echo $want_kids; ?>"; 

	if (gender == null || gender === "") {
		$("#gender option[value='']").attr('selected', 'selected'); 
		console.log("null = " + gender);
		console.log("null, variable = <?=$gender?>");
		console.log("null, variable = " + <?=$gender?>);
		console.log("null, variable = <?php echo $gender; ?>");
	} else {
		$("#gender option[value='" + gender + "']").attr('selected', 'selected'); 
		console.log("not null = " + gender);
		console.log("not null, variable = <?=$gender?>");
		console.log("not null, variable = " + <?=$gender?>);
		console.log("not null, variable = <?php echo $gender; ?>");
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

	if (tranportation == null || tranportation === "") {
		$("#tranportation option[value='']").attr('selected', 'selected'); 
	} else {
		$("#tranportation option[value='" + tranportation + "']").attr('selected', 'selected'); 
	}

	if (intention == null || intention === "") {
		$("#intention option[value='']").attr('selected', 'selected'); 
	} else {
		$("#intention option[value='" + intention + "']").attr('selected', 'selected'); 
	}

	if (education == null || education === "") {
		$("#education option[value='']").attr('selected', 'selected'); 
	} else {
		$("#education option[value='" + education + "']").attr('selected', 'selected'); 
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



});