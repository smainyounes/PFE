<?php 
	include 'Database.php';
	session_start();

	if(isset($_POST['usertype']) && isset($_POST['username']) && isset($_POST['password'])){
		//init DB
		$db = new Database();

		if($_POST['usertype'] === "etud"){
			// prof
			$db->query("SELECT * FROM etudiant INNER JOIN groupe ON etudiant.id_grp = groupe.idG WHERE matricule= :username");
			$db->bind(":username", $_POST['username']);

			$res = $db->single();
			if($res){
				if($res->password === $_POST['password']){
					// start sessions 
					$_SESSION['id_etud'] = $res->id;
					$_SESSION['id_grp'] = $res->id_grp;
					$_SESSION['id_spec'] = $res->spec;
					$_SESSION['id_sec'] = $res->section;
					// echo $_SESSION['id_etud'];
					echo "done";
				}else{
					echo "error";
				}
			}else{
				// no user
				echo "error";
			}


		}elseif ($_POST['usertype'] === "prof") {
			// etudiant
			$db->query("SELECT * FROM etudiant WHERE matricule= :matr");
			$db->bind(":matr", $_POST['username']);

			$res = $db->single();
			if($res){
				if($res->password === $_POST['password']){
					// start sessions 
					echo "done";
				}else{
					echo "error";
				}
			}else{
				// no user
				echo "error";
			}
		}else{
			echo "error";
		}

	}

 ?>