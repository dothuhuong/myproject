<?php 
public function image_save()
	{
		$userid=$_POST['userid'];
		if (isset($_FILES["R01_Passport_upload"]))
		{
			 if($_FILES["R01_Passport_upload"]["name"] != ""){
				$maxFileSize = 10 * 1000 * 1000; //MB
				if($_FILES["R01_Passport_upload"]["size"] > ($maxFileSize * 1000 * 1000)){
					$errors=1;
					exit;
				}else{
					$filename = stripslashes($_FILES["R01_Passport_upload"]["name"]);
					$extension = $this->getExtension($filename);
					$extension = strtolower($extension);
					if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") && ($extension != "pdf") && ($extension != "BMP")){
						echo "(ERR)アップロードファイルはJPG/JPEG/GIF/PNG/BMP/PDFでご用意ください。" ;
						$errors=1;
						exit;
					} else {
						// save image with blob type in db R01_Resever
						// バイナリデータ
						$fp = fopen($_FILES["R01_Passport_upload"]["tmp_name"], "rb");
						$imgdat = fread($fp, filesize($_FILES["R01_Passport_upload"]["tmp_name"]));
						fclose($fp);
						$imgdat = addslashes($imgdat);
						$this->mypage_mo->saveImageToDB($imgdat , $userid);
						// save image with blob type in folder pass_img
						$type = $_FILES["R01_Passport_upload"]["type"]; 
						$result = $this->mypage_mo->get_imgfilename();
						$image_update=$result['M01_Fileno']+1;
						$this->mypage_mo->update_imgfilename($image_update);
						$file_name=$result['M01_Prechar'].'_'.$result['M01_Fileno'];
						$image_name=$file_name.".".$extension;
						$newname="pass_img/".$image_name;
						$this->mypage_mo->update_img($image_name,$userid);
						$tmp_name = $_FILES["R01_Passport_upload"]["tmp_name"];
						move_uploaded_file($tmp_name, $newname);
						
						echo base_url().$newname;
						$userData = array();
						$userData = $this->mypage_mo->getUserDataById($userid);
						$this->send_update_mail($userData);
					}
				}
	
			} else {
				echo "(ERR)アップロードファイルを選んでください！";
				$errors =1;
				exit;
			}
		} else {
			echo "(ERR)アップロードファイルを選んでください！1111";	
		}	
	}
	function getExtension($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}	
	
?>	