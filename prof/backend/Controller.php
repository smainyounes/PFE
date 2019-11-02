<?php 
	session_start();
	include 'Database.php';
	include 'helpers/helpers.php';
	
	/**
	 * 
	 */
	class Controller
	{
		
		private $selectedPage;
		
		private $id_prof;
		private $db;

		function __construct($selectedPage)
		{
			$this->selectedPage = $selectedPage;
			
			$this->id_prof = $_SESSION['id_prof'];;

			$this->db = new Database();
			
		}

		public function InsertData()
		{
			switch ($this->selectedPage) {
				
				case 'publier' :
					if (isset($_FILES['file'])) {
					$tmpFilePath = $_FILES['file']['tmp_name'];
					if ($tmpFilePath != ""){
						
						$ext = explode('.', $_FILES['file']['name']);
						$finalext = strtolower(end($ext));
						// checking if its a pdf file
						if (($finalext !== "pdf")and($finalext !== "docx")and($finalext !== "xlsx")) {
							return false;
						}
						// checking file double extension attack
						if(count($ext)>2){
							if(strtolower($ext[count($ext)-2]) === 'php'){
								return false;
							}
						}

						$filename = uniqid('',true).".".$finalext;
						$newFilePath = "files/postes/".$filename;
						if(move_uploaded_file($tmpFilePath, $newFilePath)){
							
				//globale req for right id groupe
				$this->db->query("SELECT * FROM specialite S INNER JOIN section C ON C.spec = S.id 
								INNER JOIN groupe G ON G.section = C.id 
								WHERE G.nom_grp = :grp and C.nom_sec = :sec and  S.nom_spec = :spec and S.annee = :annee");
				$this->db->bind(":annee", strip_tags($_POST['annee']));
				$this->db->bind(":spec", strip_tags($_POST['spec']));
				$this->db->bind(":sec", strip_tags($_POST['sec']));
				$this->db->bind(":grp",  strip_tags($_POST['grp']));
				$data = $this->db->single(); 
				$grp = $data->idG;

				
				//insert
				$this->db->query("INSERT INTO `affichage_prof`(`lien`,`date_exp`,`description`,`type`,`module`,`prof`,`groupe`) VALUES (:lien,:dat,:dess,:typ,:mod,:prf,:grp)");
									$this->db->bind(":mod",  strip_tags($_POST['mod']));
									$this->db->bind(":lien", $filename);
									$this->db->bind(":dess",strip_tags($_POST['des']));
									$this->db->bind(":typ", "publication");
									$this->db->bind(":dat", "2030-01-01");
									$this->db->bind(":prf", $this->id_prof);
									$this->db->bind(":grp",$grp);
									try {
										$this->db->execute();
										return true;
									} catch (Exception $e) {
										return false;
									}
								}		    
							}
						}
						return false;
						break;
				case 'devoir' :
					if (isset($_FILES['file'])) {
					$tmpFilePath = $_FILES['file']['tmp_name'];
					if ($tmpFilePath != ""){
						
						$ext = explode('.', $_FILES['file']['name']);
						$finalext = strtolower(end($ext));
						// checking if its a pdf file
						if (($finalext !== "pdf")and($finalext !== "docx")and($finalext !== "xlsx")) {
							return false;
						}
						// checking file double extension attack
						if(count($ext)>2){
							if(strtolower($ext[count($ext)-2]) === 'php'){
								return false;
							}
						}

						$filename = uniqid('',true).".".$finalext;
						$newFilePath = "files/postes/".$filename;
						if(move_uploaded_file($tmpFilePath, $newFilePath)){
							
				//globale req for right id groupe
				$this->db->query("SELECT * FROM specialite S INNER JOIN section C ON C.spec = S.id 
								INNER JOIN groupe G ON G.section = C.id 
								WHERE G.nom_grp = :grp and C.nom_sec = :sec and  S.nom_spec = :spec and S.annee = :annee");
				$this->db->bind(":annee", strip_tags($_POST['annee']));
				$this->db->bind(":spec", strip_tags($_POST['spec']));
				$this->db->bind(":sec", strip_tags($_POST['sec']));
				$this->db->bind(":grp",  strip_tags($_POST['grp']));
				$data = $this->db->single(); 
				$grp = $data->idG;

				
				//insert
				$this->db->query("INSERT INTO `affichage_prof`(`lien`,`date_exp`,`type`,`module`,`prof`,`groupe`) VALUES (:lien,:dat,:typ,:mod,:prf,:grp)");
									$this->db->bind(":mod",  strip_tags($_POST['mod']));
									$this->db->bind(":lien", $filename);
									$this->db->bind(":dat",strip_tags($_POST['date']));
									$this->db->bind(":typ", "devoir");
									
									$this->db->bind(":prf", $this->id_prof);
									$this->db->bind(":grp",$grp);
									try {
										$this->db->execute();
										return true;
									} catch (Exception $e) {
										return false;
									}
								}		    
							}
						}
						return false;
						break;
				case 'affichage':
				if (isset($_FILES['file'])) {
					$tmpFilePath = $_FILES['file']['tmp_name'];
					if ($tmpFilePath != ""){
						
						$ext = explode('.', $_FILES['file']['name']);
						$finalext = strtolower(end($ext));
						// checking if its a pdf file
						if (($finalext !== "pdf")and($finalext !== "docx")and($finalext !== "xlsx")) {
							return false;
						}
						// checking file double extension attack
						if(count($ext)>2){
							if(strtolower($ext[count($ext)-2]) === 'php'){
								return false;
							}
						}

						$filename = uniqid('',true).".".$finalext;
						$newFilePath = "files/postes/".$filename;
						if(move_uploaded_file($tmpFilePath, $newFilePath)){
							
				//globale req for right id groupe
				$this->db->query("SELECT * FROM specialite S INNER JOIN section C ON C.spec = S.id 
								INNER JOIN groupe G ON G.section = C.id 
								WHERE G.nom_grp = :grp and C.nom_sec = :sec and  S.nom_spec = :spec and S.annee = :annee");
				$this->db->bind(":annee", strip_tags($_POST['annee']));
				$this->db->bind(":spec", strip_tags($_POST['spec']));
				$this->db->bind(":sec", strip_tags($_POST['sec']));
				$this->db->bind(":grp",  strip_tags($_POST['grp']));
				$data = $this->db->single(); 
				$grp = $data->idG;

				
				//insert
				$this->db->query("INSERT INTO `affichage_prof`(`lien`,`date_exp`,`type`,`module`,`prof`,`groupe`) VALUES (:lien,:dat,:typ,:mod,:prf,:grp)");
									$this->db->bind(":mod",  strip_tags($_POST['mod']));
									$this->db->bind(":lien", $filename);
									$this->db->bind(":typ", "note");
									$this->db->bind(":dat", "2030-01-01");
									$this->db->bind(":prf", $this->id_prof);
									$this->db->bind(":grp",$grp);
									try {
										$this->db->execute();
										return true;
									} catch (Exception $e) {
										return false;
									}
								}		    
							}
						}
						return false;
						break;
				
				case 'sup' :
				$this->db->query("DELETE FROM `affichage_prof` WHERE `affichage_prof`.`id` =:id");
				$this->db->bind(":id",  strip_tags($_POST['id']));
				try {
					$this->db->execute();
					return true;
				} catch (Exception $e) {
					return false;
				}
				break;
				case 'settings':
					if(isset($_POST["img"])){
						// changing pic
						if (isset($_FILES['file'])) {
							$tmpFilePath = $_FILES['file']['tmp_name'];
						    if ($tmpFilePath != ""){
							    
							    $ext = explode('.', $_FILES['file']['name']);
							    $finalext = strtolower(end($ext));
							    $filename = uniqid('',true).".".$finalext;
							    $newFilePath = "../../files/profile/".$filename;
							    //checking if file is uploaded
							    if(move_uploaded_file($tmpFilePath, $newFilePath)){
							    	//delete old picture
							    	$this->db->query("SELECT image_p FROM prof WHERE id = :id");
							    	$this->db->bind(":id", $this->id_prof);
							    	$data = $this->db->single();
							    	if($data->image_p != "a.jpg"){
								    	unlink("../../files/profile/".$data->image_p);
							    	}
							    	//update table
							    	$this->db->query("UPDATE prof SET image_p = :image WHERE id = :id");
							    	$this->db->bind(":image", $filename);
							    	$this->db->bind(":id", $this->id_prof);
							    	try {
							    		$this->db->execute();
							    		return true;
							    	} catch (Exception $e) {
							    		return $e;
							    	}
							    }else{
									return false;							    	
							    }
							}
						}	
					}
					// changing pass
					if(isset($_POST["pass"])){
						// get old password
						$this->db->query("SELECT password FROM prof WHERE id = :id");
						$this->db->bind(":id", $this->id_prof);
						$data = $this->db->single();

						//checking if old password is correct
						if($data->password === $_POST['old']){
							//checking if passwords matchs
							if ($_POST['new1'] === $_POST['new2']) {
								$this->db->query("UPDATE prof SET password = :pass WHERE id = :id");
								$this->db->bind(":id", $this->id_prof);
								$this->db->bind(":pass", $_POST['new1']);
								try {
									$this->db->execute();
									return "done";
								} catch (Exception $e) {
									return $e;
								}
							}
						}
						return "erreur";
					}
					break;
				case 'newmsg':
					// checking if we r sending to a student
					$this->db->query("SELECT id FROM etudiant WHERE matricule = :matri");
					$this->db->bind(":matri", $_POST['to']);
					$data = $this->db->single();
					if($data){
						// sending to the student
						$to_id = $data->id;
						$this->db->query("INSERT INTO `messegrie`(`sender`, `recever`, `who_s`, `who_r`, `sujet`, `contenu`, `vu`) VALUES (:etudiant, :sentto, 'p', 'e', :subject, :msg, 0)");
						$this->db->bind(":etudiant", $this->id_prof);
						$this->db->bind(":sentto", $to_id);
						$this->db->bind(":subject", strip_tags($_POST['subject']));
						$this->db->bind(":msg", strip_tags($_POST['msg']));

						try {
							$this->db->execute();
							return true;
						} catch (Exception $e) {
							return false;
						}

					}
					// checking if sending to prof
					$this->db->query("SELECT id FROM prof WHERE user_name = :matri");
					$this->db->bind(":matri", $_POST['to']);
					$data = $this->db->single();
					if($data){
						$to_id = $data->id;
						$this->db->query("INSERT INTO `messegrie`(`sender`, `recever`, `who_s`, `who_r`, `sujet`, `contenu`, `vu`) VALUES (:etudiant, :sentto, 'p', 'p', :subject, :msg, 0)");
						$this->db->bind(":etudiant", $this->id_prof);
						$this->db->bind(":sentto", $to_id);
						$this->db->bind(":subject", strip_tags($_POST['subject']));
						$this->db->bind(":msg", strip_tags($_POST['msg']));

						try {
							$this->db->execute();
							return true;
						} catch (Exception $e) {
							return false;
						}
					}

					return false;

					break;
				default:
					# code...
					break;
			}
		}

		public function LoadData(){
			switch ($this->selectedPage){
				case 'polycopes':
					$this->db->query("SELECT * FROM prof_module A
									  INNER JOIN module G ON G.id = A.module
									  where A.prof=:prof");
					$this->db->bind(":prof", $this->id_prof);
					return $this->db->resultSet();
					break;
				case 'devoir':
					$this->db->query("SELECT * FROM prof_module A
									  INNER JOIN module G ON G.id = A.module
									  where A.prof=:prof");
					$this->db->bind(":prof", $this->id_prof);
					return $this->db->resultSet();
					break;
				case 'acceuil':
					$this->db->query("SELECT * from emploi_prof e left join affichage_prof a on e.prof = a.prof where e.prof = :prof ");
					$this->db->bind(":prof", $this->id_prof);
					return $this->db->resultSet();
					break;
				case 'affichage':
					$this->db->query("SELECT * FROM prof_module A
									  INNER JOIN module G ON G.id = A.module
									  where A.prof=:prof");
					$this->db->bind(":prof", $this->id_prof);
					return $this->db->resultSet();
					break;	
				case 'settings':
					$this->db->query("SELECT * FROM prof WHERE id=:etudiant");
					$this->db->bind(":etudiant", $this->id_prof);
					return $this->db->single();
					break;
				case 'listmsg':
					$this->db->query("SELECT * FROM messegrie LEFT JOIN prof ON prof.id = messegrie.sender INNER JOIN etudiant ON messegrie.sender = etudiant.id WHERE messegrie.recever = :etu AND who_r = 'p' ORDER BY messegrie.id_message DESC");
					$this->db->bind(":etu", $this->id_prof);
					return $this->db->resultSet();
					break;
				case 'message':
					if ($_POST['stat'] === "r") {
						// revieved
						$this->db->query("SELECT * FROM messegrie LEFT JOIN prof ON prof.id = messegrie.sender INNER JOIN etudiant ON messegrie.sender = etudiant.id WHERE messegrie.recever = :etu AND messegrie.id_message = :idmsg");	
						$this->db->bind(":etu", $this->id_prof);
						$this->db->bind(":idmsg", $_POST['msgid']);	
						$data = $this->db->single();
						if($data){
							if ($data->id_message == $_POST['msgid']) {
								$this->db->query("UPDATE messegrie SET vu = 1 WHERE id_message = :idmsg");
								$this->db->bind(":idmsg", strip_tags($_POST['msgid']));
								$this->db->execute();
							}
						}
						return $data;
					}
					if ($_POST['stat'] === "s") {
						// sent
						$this->db->query("SELECT * FROM messegrie LEFT JOIN etudiant ON etudiant.id = messegrie.recever INNER JOIN prof ON messegrie.recever = prof.id WHERE messegrie.sender = :etu AND messegrie.id_message = :idmsg");
						$this->db->bind(":etu", $this->id_prof);
						$this->db->bind(":idmsg", $_POST['msgid']);	
						$data = $this->db->single();
						return $data;

					}

					break;
				case 'msgsent':
					$this->db->query("SELECT * FROM messegrie LEFT JOIN prof ON prof.id = messegrie.recever INNER JOIN etudiant ON messegrie.recever = etudiant.id WHERE messegrie.sender = :etu AND who_s = 'p' ORDER BY messegrie.id_message DESC
					");
					$this->db->bind(":etu", $this->id_prof);
					return $this->db->resultSet();
					break;
				case 'userinfo':
					$this->db->query("SELECT * FROM prof WHERE id = :id");
					$this->db->bind(":id", $this->id_prof);

					return $this->db->single();
					break;
				case 'msgcount':
					$this->db->query("SELECT * FROM messegrie WHERE recever = :etud AND who_r = 'p' AND vu = 0");
					$this->db->bind(":etud", $this->id_prof);
					
					return $this->db->rowCount();
					break;
				default:
					return NULL;
					break;

			}
			
			
		}

		public function LoadView($data){

			switch ($this->selectedPage) {
				case "acceuil":
					include 'views/acceuil.php';
					break;
				case "affichage":
					include 'views/affichage.php';
					break;
				case "devoir":
					include 'views/devoir.php';
					break;
				case "listmsg":
					include 'views/listmsg.php';
					break;
				case "newmsg":
					include 'views/newmsg.php';
					break;
				case "plainte":
					include 'views/plainte.php';
					break;
				case "polycopes":
					include 'views/polycopes.php';
					break;
				case "settings":
					include 'views/settings.php';
					break;
				case 'userinfo':
					echo "<span class='nav-link'><img src='../files/profile/".$data->image_p."' class='rounded-circle' width='50px' height='50px'> ".$data->nom_p."</span>";
					break;
				case 'message':
					include 'views/msg.php';
					break;
				case 'msgsent':
					include 'views/sent.php';
					break;
				case 'msgcount':
					echo $data;
					break;
				default:
					include 'views/error.php';
					break;

			}
		}

	}



 ?>