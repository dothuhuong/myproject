<!DOCTYPE html>
<html>
	<script>
	function savePhoto() {
			var file="R01_Passport_upload";
			var userid=document.getElementById("R01_Reservation_No").value;
				var xmlHttpRequest = new XMLHttpRequest();
				xmlHttpRequest.onreadystatechange = function()
				{
					var READYSTATE_COMPLETED = 4;
					var HTTP_STATUS_OK = 200;
					if( this.readyState == READYSTATE_COMPLETED && this.status == HTTP_STATUS_OK ) {
						var result = xmlHttpRequest.responseText;
						var res = result.substr(0, 5);
						if( res == "(ERR)") {
							alert(result);
						} else {
							var string =result;
							var strx   = string.split('/');
							var array  = [];
							array = array.concat(strx);
							var file_name=array[5];alert(array);
							document.getElementById("uploadclick").style.background="#33BFDB";
							document.getElementById("uploadclick").value="再アップロード";
							document.getElementById("R01_Passport_upload_Name").value=file_name;
							document.getElementById("link").style.display="none";
							document.getElementById("link1").style.display="none";
							document.getElementById("org_img").style.display="none";
							document.getElementById("name2").style.display="block";
							document.getElementById("name").style.display="block";
							alert("アップロード完了しました。");
						}
					}
				}
				xmlHttpRequest.open('POST',"<?php echo base_url(); ?>mypage_con/image_save",true );
				var fd = new FormData();
				fd.append('R01_Passport_upload', $('input[type=file]')[0].files[0]);
				fd.append('userid',userid)
				xmlHttpRequest.send(fd);
	}
	</script>													

	<table class="mypage">
		<tr>
			<td>
				<br>
				<?php
				//データーベースの画像名があります。
				if( $data['R01_Passport_upload'] != NULL && $data['R01_Passport_upload'] != "" ) {
					$color="#33BFDB";
					$value = "再アップロード";
				?>
				<p style="display:block;font-size:15px;font-weight:bold !important"  id = "org_img">アップロード済みです。</p>
				<p style="display:none;"id="link">画像アップロード</p>
				<p style="display:block;font-size :15px"id="link1">
				<a href="#" onclick="getImage('<?php echo $R01_Reservation_No; ?>')" >アップロード済画像の確認</a>
				<p>
				<?php
				} else {
					$color="red";
					$value = "アップロード";
				?>	
				<p style = "display:none;font-size:15px;"  id = "org_img">アップロード済みです。</p>
				<p style="display:none;font-weight:bold"id="link">画像アップロード</p>
				<p style="display:none;font-size :15px"id="link1">
				<a href="#" onclick="getImage('<?php echo $R01_Reservation_No; ?>')" >アップロード済画像の確認</a>
				</div>
				<?php
				}
				?>
				<p style="font-size:15px;font-weight:bold !important; display: none;" id = "name2">アップロード済みです。</p>
				<p style="font-size :15px; display: none;" id="name">
				<a href="#" onclick="getImage('<?php echo $R01_Reservation_No; ?>')" >アップロード済画像の確認</a>
				</p>
				<?php 
				if ($data['R01_Cancel_Flag'] == "0") {
				?>
				<input  style = "background:<?php echo $color;?>" type ="button" id="uploadclick" name="uploadclick"  value="<?php echo $value;?>" onclick="savePhoto();"><br><br>
				<?php 
				} else {
				?>
				<input  style = "background:<?php echo $color;?>" type ="button" id="uploadclick" name="uploadclick"  value="<?php echo $value;?>" ><br><br>
				<?php 
				}
				?>
				
			</td>
		</tr>
	</table>		
</html>