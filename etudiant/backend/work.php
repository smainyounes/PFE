<?php 
	include 'Controller.php';

	if(loggedIn()){
		// checking if form is submited
		if(isset($_POST['submit'])){
			// form submited
			$cont = new Controller($_POST['Page']);
			// checking if data inserted
			
			// echo $cont->InsertData();
			if($cont->InsertData()){
				echo "inserted";
			}else{
				echo "not inserted";
			}
		}else{
			// page request
			if(isset($_POST['Page'])){
				$cont = new Controller($_POST['Page']);

				$data = $cont->LoadData();

				echo $cont->LoadView($data);
			}
		}
	}

	if (isset($_POST['test'])) {
		if(loggedIn()){
			echo "connected";
		}else{
			echo "false";
		}
	}

	if(isset($_POST['dc'])){
		unset($_SESSION['id_etud']);
		unset($_SESSION['id_grp']);
		unset($_SESSION['id_spec']);
		unset($_SESSION['id_sec']);

		echo "done";

	}
	
 ?>