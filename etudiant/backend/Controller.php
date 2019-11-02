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
		private $id_etudiant;
		private $id_spec;
		private $id_group;
		private $id_sec;

		private $db;

		function __construct($selectedPage)
		{
			$this->selectedPage = $selectedPage;
			$this->id_etudiant = $_SESSION['id_etud'];
			$this->id_spec = $_SESSION['id_spec'];
			$this->id_group = $_SESSION['id_grp'];
			$this->id_sec = $_SESSION['id_sec'];

			$this->db = new Database();
			
		}

		public function InsertData(){
		
			switch ($this->selectedPage) {
				case 'plainte':
					$this->db->query("INSERT INTO `plainte`(`id_sender`, `contenu`) VALUES (:etudiant, :msg)");
					$this->db->bind(":etudiant", $this->id_etudiant);
					$this->db->bind(":msg", strip_tags($_POST['msg']));
					try {
						$this->db->execute();
						return true;
					} catch (Exception $e) {
						return false;
					}
					break;
				
				case 'settings':
					// changing pic
					if(isset($_POST["img"])){
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
							    	$this->db->query("SELECT image_e FROM etudiant WHERE id = :id");
							    	$this->db->bind(":id", $this->id_etudiant);
							    	$data = $this->db->single();
							    	if($data->image_e != "a.jpg"){
							    		unlink("../../files/profile/".$data->image_e);
							    	}
							    	
							    	//update table
							    	$this->db->query("UPDATE etudiant SET image_e = :image WHERE id = :id");
							    	$this->db->bind(":image", $filename);
							    	$this->db->bind(":id", $this->id_etudiant);
							    	try {
							    		$this->db->execute();
							    		return true;
							    	} catch (Exception $e) {
							    		return false;
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
						$this->db->query("SELECT password FROM etudiant WHERE id = :id");
						$this->db->bind(":id", $this->id_etudiant);
						$data = $this->db->single();

						//checking if old password is correct
						if($data->password === $_POST['old']){
							//checking if passwords matchs
							if ($_POST['new1'] === $_POST['new2']) {
								$this->db->query("UPDATE etudiant SET password = :pass WHERE id = :id");
								$this->db->bind(":id", $this->id_etudiant);
								$this->db->bind(":pass", $_POST['new1']);
								try {
									$this->db->execute();
									return true;
								} catch (Exception $e) {
									return false;
								}
							}
						}
						return "erreur";
					}
					break;
				
				case 'polycopes':
					if (isset($_FILES['file'])) {
						$tmpFilePath = $_FILES['file']['tmp_name'];
					    if ($tmpFilePath != ""){
						    
						    $ext = explode('.', $_FILES['file']['name']);
						    $finalext = strtolower(end($ext));
						    // checking if its a pdf file
						    if ($finalext !== "pdf") {
						    	return false;
						    }
						    // checking file double extension attack
						    if(count($ext)>2){
						    	if(strtolower($ext[count($ext)-2]) === 'php'){
						    		return false;
						    	}
						    }

						    $filename = uniqid('',true).".".$finalext;
						    $newFilePath = "../../files/postes/".$filename;
						    if(move_uploaded_file($tmpFilePath, $newFilePath)){
						    	// insert into database
						    	$this->db->query("INSERT INTO policope (`lien`, `description`, `etudiant`) VALUES(:filename, :descr, :etudiant )");
						    	$this->db->bind(":filename", $filename);
						    	$this->db->bind(":descr", strip_tags($_POST['descr']));
						    	$this->db->bind(":etudiant", $this->id_etudiant);
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

				case 'newmsg':
					// checking if we r sending to a student
					$this->db->query("SELECT id FROM etudiant WHERE matricule = :matri");
					$this->db->bind(":matri", $_POST['to']);
					$data = $this->db->single();
					if($data){
						// sending to the student
						$to_id = $data->id;
						$this->db->query("INSERT INTO `messegrie`(`sender`, `recever`, `who_s`, `who_r`, `sujet`, `contenu`, `vu`) VALUES (:etudiant, :sentto, 'e', 'e', :subject, :msg, 0)");
						$this->db->bind(":etudiant", $this->id_etudiant);
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
						$this->db->query("INSERT INTO `messegrie`(`sender`, `recever`, `who_s`, `who_r`, `sujet`, `contenu`, `vu`) VALUES (:etudiant, :sentto, 'e', 'p', :subject, :msg, 0)");
						$this->db->bind(":etudiant", $this->id_etudiant);
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
					return false;
					break;
			}
		}

		public function LoadData(){
			switch ($this->selectedPage){
				case 'polycopes':
					$this->db->query("SELECT * FROM policope INNER JOIN etudiant ON policope.etudiant = etudiant.id  WHERE etudiant.spec = :spec ORDER BY policope.id DESC");
					$this->db->bind(":spec", $this->id_spec);
					return $this->db->resultSet();
					break;
				case 'settings':
					$this->db->query("SELECT * FROM etudiant WHERE id=:etudiant");
					$this->db->bind(":etudiant", $this->id_etudiant);
					return $this->db->single();
					break;
				case 'devoir':
					$this->db->query("SELECT * FROM affichage_prof INNER JOIN module ON affichage_prof.module = module.id WHERE affichage_prof.groupe = :groupe AND type = 'devoir' ORDER BY affichage_prof.id DESC");
					$this->db->bind(":groupe", $this->id_group);
					return $this->db->resultSet();
					break;
				case 'affichage':
					$this->db->query("SELECT * FROM affichage_prof AS AP INNER JOIN prof ON AP.prof = prof.id  WHERE AP.groupe = :grp AND AP.date_exp >=CURDATE() AND AP.type != 'devoir' ORDER BY AP.id DESC");
					$this->db->bind(":grp", $this->id_group);
					return $this->db->resultSet();
					break;
				case 'acceuil':
					$this->db->query("SELECT * FROM affichage_dept AS ad, emploi_etudiant AS ee WHERE ad.groupe = :group AND ad.date_exp >=CURDATE() AND ee.section = :sec ORDER BY ad.id DESC");
					$this->db->bind(":group", $this->id_group);
					$this->db->bind(":sec", $this->id_sec);
					return $this->db->resultSet();
					break;
				case 'listmsg':
					$this->db->query("SELECT * FROM messegrie LEFT JOIN etudiant ON etudiant.id = messegrie.sender INNER JOIN prof ON messegrie.sender = prof.id WHERE messegrie.recever = :etu AND who_r = 'e' ORDER BY messegrie.id_message DESC");
					$this->db->bind(":etu", $this->id_etudiant);
					return $this->db->resultSet();
					break;
				case 'message':
					if ($_POST['stat'] === "r") {
						// revieved
						$this->db->query("SELECT * FROM messegrie LEFT JOIN etudiant ON etudiant.id = messegrie.sender INNER JOIN prof ON messegrie.sender = prof.id WHERE messegrie.recever = :etu AND messegrie.id_message = :idmsg");	
						$this->db->bind(":etu", $this->id_etudiant);
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
						$this->db->bind(":etu", $this->id_etudiant);
						$this->db->bind(":idmsg", $_POST['msgid']);	
						$data = $this->db->single();
						return $data;

					}

					break;
				case 'msgsent':
					$this->db->query("SELECT * FROM messegrie LEFT JOIN etudiant ON etudiant.id = messegrie.recever INNER JOIN prof ON messegrie.recever = prof.id WHERE messegrie.sender = :etu AND who_s = 'e' ORDER BY messegrie.id_message DESC");
					$this->db->bind(":etu", $this->id_etudiant);
					return $this->db->resultSet();
					break;
				case 'userinfo':
					$this->db->query("SELECT * FROM etudiant WHERE id = :id");
					$this->db->bind(":id", $this->id_etudiant);

					return $this->db->single();
					break;
				case 'msgcount':
					$this->db->query("SELECT * FROM messegrie WHERE recever = :etud AND who_r = 'e' AND vu = 0");
					$this->db->bind(":etud", $this->id_etudiant);
					
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
					case 'message':
						include 'views/msg.php';
						break;
					case 'msgsent':
						include 'views/sent.php';
						break;
				case 'userinfo':
					echo "<span class='nav-link'><img src='../files/profile/".$data->image_e."' class='rounded-circle' width='50px' height='50px'> ".$data->prenom_e."</span>";
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