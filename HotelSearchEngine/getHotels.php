<?php
	//echo("khupach");
	if($_POST['filter'] == ""){
		echo($_POST['searchTag']);
	}else{
		echo($_POST['filterBy'] + " " + $_POST['filter'] + " " + $_POST['searchTag']);
	}
?>