<?php
require_once('Database.php');
require_once('Function.php');
class User{
	public $id;
	public $email;
	public $username;
	public $password;
	public $newpassword;
	public $first_name;
	public $nickname;
	public $sur_name;
	public $birth_date;
	public $gender;
	public $facebook;
	public $website;
	public $images;
	public $database;
	function user(){
		$this->database = new Database();
		$this->database->konek;
	}
	function koneksi(){
		$this->database = new Database;
		return $this->database->konek;
	}
	function get(){
		$get = mysqli_query($this->database->konek, "SELECT * FROM user WHERE username = '$this->username'");
		$checkUser = mysqli_fetch_array($get);
		$this->setId($checkUser['id']);
	}
	//set all
	function setId($id){
		$this->id = $id;
	}
	function setEmail($email){
		$this->email = $email;
	}
	function setUsername($username){
		$this->username = $username;
	}
	function setPassword($password){
		$this->password = $password;
	}
	function setNewPassword($newPassword){
		$this->newPassword = $newPassword;
	}
	function setFirstName($first_name){
		$this->first_name = $first_name;
	}
	function setSurName($sur_name){
		$this->sur_name = $sur_name;
	}
	function setNickName($nickname){
		$this->nickname = $nickname;
	}
	function setBirthDate($birth_date){
		$this->birth_date = $birth_date;
	}
	function setGender($gender){
		$this->gender = $gender;
	}
	
	function setFacebook($facebook){
		$this->facebook = $facebook;
	}
	function setWebsite($website){
		$this->website = $website;
	}
	function setImages($images){
		$this->images = $images;
	}
	function getId(){
		return $this->id;
	}
	function getEmail(){
		return $this->email;
	}
	function getUsername(){
		return $this->username;
	}
	function getPassword(){
		return $this->password;
	}
	function getNewPassword(){
		return $this->newPassword;
	}
	function getFirstName(){
		return $this->first_name;
	}
	function getSurName(){
		return $this->sur_name;
	}
	function getBirthDate(){
		return $this->birth_date;
	}
	function getGender(){
		return $this->gender;
	}
	
	function getFacebook(){
		return $this->facebook;
	}
	function getWebsite(){
		return $this->website;
	}
	function getImages(){
		return $this->images;
	}
	function showData(){
		echo $this->id . '<br>' ;
		echo $this->email . '<br>' ;
		echo $this->username . '<br>' ;
		echo $this->password . '<br>' ;
	}
	function sessionUser(){
		$select = mysqli_query($this->koneksi(), "SELECT * FROM user WHERE id = '".$this->id."'");
		$dataUser = mysqli_fetch_array($select);
		$this->email = $dataUser['email'];
		$this->username = $dataUser['username'];
		$this->first_name = $dataUser['first_name'];
		$this->sur_name = $dataUser['sur_name'];
		$this->birth_date = $dataUser['birth_date'];
		$this->gender = $dataUser['gender'];
		$this->facebook = $dataUser['facebook_profile'];
		$this->website = $dataUser['website'];
	}
	function changePassword($confirm_password){
		$show = mysqli_query($this->koneksi(), "SELECT * FROM user WHERE email = '".$this->email."'");
		$dataUser = mysqli_fetch_array($show);
		$current_password_db = $dataUser['password'];
		if($this->password == $current_password_db){
			if($this->newPassword == $confirm_password){
				$select = mysqli_query($this->koneksi(),"SELECT password FROM USER WHERE password = '$this->newPassword'");
				if(mysqli_num_rows($select)){
					echo 'password sudah dipakai<br>';
					echo '<a href="settings"><button type="button" class="btn btn-primary">back</button></a>';
				}else{
					$save = mysqli_query($this->koneksi(), "UPDATE user SET password = '".$this->getNewPassword()."' WHERE username = '".$this->getUsername()."' AND password = '".$current_password_db."'");
					if($save){
						$to      = 'admin@ferdynosopian.local';
						$subject = 'Password has been change';
						$message = 'Your password has ben change at';
						$headers = 'From: webmaster@example.com' . "\r\n" .
						'Reply-To: webmaster@example.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
						mail($to, $subject, $message, $headers);
						header("location:settings");
					}else{
						echo 'gagal<br>';
						echo '<a href="settings"><button type="button" class="btn btn-primary">back</button></a>';
					}
				}
			}else{
				echo 'password konfirmasi salah<br>';
				echo '<a href="settings"><button type="button" class="btn btn-primary">back</button></a>';
			}
		}else{
			echo 'password salah<br>';
			echo '<a href="settings"><button type="button" class="btn btn-primary">back</button></a>';
		}
	}
	function changeEmail($current_email){
		$select = mysqli_query($this->koneksi(),"SELECT email FROM USER WHERE email = '$this->email'");
		if(mysqli_num_rows($select)){
			echo 'email sudah dipakai<br>';
			echo '<a href="settings"><button type="button" class="btn btn-primary">back</button></a>';
		}else{
			$save = mysqli_query($this->koneksi(), "UPDATE user SET email = '$this->email' WHERE email = '".$current_email."' ");
			if($save){
				header('location:settings');
			}else{
				echo 'gagal<br>';
				echo '<a href="settings"><button type="button" class="btn btn-primary">back</button></a>';
			}
		}
	}
	function changeProfile(){
		$save = mysqli_query($this->koneksi(), "UPDATE user SET username = '$this->username', first_name = '$this->first_name', sur_name = '$this->sur_name', birth_date = '$this->birth_date', gender = '$this->gender', facebook_profile = '$this->facebook', website = '$this->website' WHERE email = '$this->email'");
		if ($save) {
			header('location:settings');
		}else{
			echo 'gagal<br>';
			echo '<a href="settings"><button type="button" class="btn btn-primary">back</button></a>';
		}
	}
	function changeImages($id){
		$select = mysqli_query($this->koneksi(), "SELECT images FROM user WHERE id = '$id'");
		$dataUser = mysqli_fetch_array($select);
		
		if($dataUser['images'] != '' || $dataUser['images'] != null) {
			unlink(folderImageUser($dataUser['images']));
			$save = mysqli_query($this->koneksi(), "UPDATE user SET images = '$this->images' WHERE id = '$id'");
			if($save){
				header('location:settings');
			}else{
				echo 'gagal<br>';
				echo '<a href="settings/change-profile"><button type="button" class="btn btn-primary">back</button></a>';
			}
		}else{
			$save = mysqli_query($this->koneksi(), "UPDATE user SET images = '$this->images' WHERE id = '$id'");
			if($save){
				header('location:settings');
			}else{
				echo 'gagal<br>';
				echo '<a href="settings/change-profile"><button type="button" class="btn btn-primary">back</button></a>';
			}
		}
		
	}
	function deleteImagesUser(){
		$select = mysqli_query($this->koneksi(), "SELECT images FROM user WHERE id = '$this->id' AND images = '$this->images'");
		$dataUser = mysqli_fetch_array($select);
		if($dataUser['images'] != '' || $dataUser['images'] != null){
			unlink(folderImageUser($dataUser['images']));
			$save = mysqli_query($this->koneksi(), "UPDATE user SET images = '' WHERE id = '$this->id' AND images = '$this->images'");
			if($save){
				header('location:settings');
			}else{
				echo 'gagal<br>';
				echo '<a href="settings/change-profile"><button type="button" class="btn btn-primary">back</button></a>';
			}
		}
	}
	function showDataPublic(){
		$i = 0;
		$select = mysqli_query($this->koneksi(), "SELECT * FROM user");
		while($dataUser = mysqli_fetch_array($select)){
			$time = strtotime($dataUser['birth_date']);
			$years = date('Y', $time);
			$month = date('M', $time);
			$day = date('d', $time);
			$i++;
			echo
			'<div class="col-md-2">
				<div class="thumbnail">
					<div class="no-padding thumbnails">
					';
					if($dataUser['images'] != '' || $dataUser['images'] != null ){
						echo '<a><img class="img-rounded img-thumb" src="'; $userImg = $dataUser['images']; echo showImageUser($userImg); echo '"/></a>';
					}else{
						$userImg = 'img_profile_default.jpg';
						echo '<a><img class="img-rounded img-thumb" src="'; echo showImageUser($userImg); echo'"></a>';
					}	
					echo'
					</div>
					<div class="no-padding">
						<div class="caption">
							<h5>'.$dataUser['first_name'].' '.$dataUser['sur_name'].'</h5>
							<p>
								'.$day.' '.$month.' '.$years.'
							</p>
						</div>
					</div>
				</div>
			</div>';
		}
	}
		// fungsi register
	function insert($confirm_password){
		$select = mysqli_query($this->koneksi(),"SELECT email FROM user WHERE email = '$this->email'");
		if(mysqli_num_rows($select)){
			echo 'email sudah dipakai';
		}else{
			if($this->password == $confirm_password){
			$save = mysqli_query( $this->koneksi(), "INSERT INTO user(email, first_name, password) VALUES('$this->email', '$this->first_name', '$this->password')");
			if($save){
				echo "sukses<br>";
				echo "<a href=\"register\"><button type class=\"btn btn-danger\">back</button></a>";
			}
			else{
				echo "gagal<br>";
				echo "<a href=\"register\"><button type class=\"btn btn-danger\">back</button></a>";
			}	
		}else{
			echo 'salah';
		}	
		}
		
		
	}
		// fungsi login
	function logIn(){
		$select = mysqli_query( $this->koneksi(), "SELECT * FROM user WHERE email = '$this->email'");
		$checkUser = mysqli_fetch_array($select);
		if($this->email != $checkUser['email']){
			echo 'Email did not match our record.please check again';
			echo "<a href=\"register\"><button type class=\"btn btn-danger\">back</button></a>";
		}
		else{
			if($this->email == $checkUser['email'] && $this->password == $checkUser['password']){
				$_SESSION['id'] = $checkUser['id'];
				header('location:admin');
			}
			elseif($this->password != $checkUser['password']){
				echo 'wrong password <br>';
				echo "<a href=\"register\"><button type class=\"btn btn-danger\">back</button></a>";
			}
			else{
				echo 'gagal<br>';
				echo '<a href="register"><button type="button" class="btn btn-primary">back</button></a>';
			}
		}
	}
		// fungsi logout
	function logOut(){
		unset($_SESSION['id']);
		header('location:home');
	}
	//fungsi profile
	function showProfile(){
		$select = mysqli_query($this->koneksi(), "SELECT * FROM user WHERE email ='".$this->email."'");
		$dataUser = mysqli_fetch_array($select);
		$time = strtotime($dataUser['birth_date']);
		$years = date('Y', $time);
		$month = date('M', $time);
		$day = date('d', $time);
		echo'
			<div class="col-md-3">
				<div class="thumbnail">
					';
					if($dataUser['images'] != '' || $dataUser['images'] != null ){
						echo '<a><img class="img-rounded" src="'; $userImg = $dataUser['images']; echo showImageUser($userImg); echo '"/></a>';
					}else{
						$userImg = 'img_profile_default.jpg';
						echo '<a><img class="img-rounded" src="'; echo showImageUser($userImg); echo'"></a>';
					}	
					echo'
				</div>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<h3><label>'.$dataUser['first_name'].'</label></h3>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs besar" role="tablist">
						<li role="presentation" class="active">
							<a href="#profile_menu" aria-controls="profile_menu" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-volume-up" aria-hidden="true"> </span>Profile</a>
						</li>
						<li role="presentation">
							<a href="#privasi_menu" aria-controls="privasi_menu" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-edit" aria-hidden="true"> </span> Email & Password</a>
						</li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="profile_menu">
							<div class="container-fluid warna1">
								<div class="row">
									<small>Facebook connect</small><hr>
									<div class="col-md-12">
										<center>
											<p>Hubungkan akunmu dengan Facebook agar kamu juga bisa login dengan akun Facebookmu.</p>
										</center>
									</div>
								</div>
								<div class="row">
									<small>Profile</small><hr>
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
												<label class="pull-right">Nama Lengkap :</label>
											</div>
											<div class="col-md-8">
												<p>'.$dataUser['first_name'].' '.$dataUser['sur_name'].' </p>
											</div>
										</div>'; 
										if($dataUser['username'] != '' || $dataUser['username'] != null){
											echo'
											<div class="row">
												<div class="col-md-4">
													<label class="pull-right">Nama panggilan :</label>
												</div>
												<div class="col-md-8">
													<p>'.$dataUser['username'].'</p>
												</div>
											</div>
											';
										}if($dataUser['birth_date'] == '0000-00-00' || $dataUser['birth_date'] == null){
											echo '';
										}else{
											echo'
											<div class="row">
												<div class="col-md-4">
													<label class="pull-right">Tanggal lahir :</label>
												</div>
												<div class="col-md-8">
													<p>'.$day.'-'.$month.'-'.$years.'</p>
												</div>
											</div>';
										}if($dataUser['gender'] != '' || $dataUser['gender'] != null){
											echo'
											<div class="row">
												<div class="col-md-4">
													<label class="pull-right">Jenis kelamin :</label>
												</div>
												<div class="col-md-8">
													<p>';($dataUser['gender'] == 'male'? $gender = 'Laki-Laki' : $gender = 'Perempuan'); echo $gender; echo'</p>
												</div>
											</div>';
										}if($dataUser['website'] != '' || $dataUser['website'] != null && $dataUser['facebook_profile'] != '' || $dataUser['facebook_profile'] != null ){
											echo'
											<div class="row">
												<div class="col-md-4">
													<label class="pull-right">Profile online :</label>
												</div>
												<div class="col-md-8">
													<ul class="profile-online">';
														if($dataUser['website'] != '' || $dataUser['website'] != null){
															echo '<li><a href="'.$dataUser['website'].'"><span class="fa fa-external-link" aria-hidden="true"> </span> Website</a></li>';
														}if($dataUser['facebook_profile'] != '' || $dataUser['facebook_profile'] != null){
															echo '<li><a href="'.$dataUser['facebook_profile'].'"><span class="fa fa-facebook-official" aria-hidden="true"> </span> Facebook</a></li>';
														}
														echo'
													</ul>
												</div>
											</div>';
										}
										echo'
									</div>
									<center>
										<hr>
										<a href="settings/change-profile"><button class="btn btn-default">Ubah</button></a>
									</center>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="privasi_menu">
							<div class="container-fluid warna1">
								<form action="proses_edit_email.php" method="post">
									<div class="row">
										<small>Email</small>
										<hr>
										<div class="col-md-4">
											<div class="form-group">
												<label>Email :</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input class="form-control" name="current_email" type="text" value="'.$dataUser['email'].'" readOnly="true">
													<small>Gunakan email valid untuk menerima kabar terbaru dari Indonesia Mengajar.</small>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Ubah Email :</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input class="form-control" name="email" type="email" required>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<hr>
										<div class="col-md-12">
											<div class="form-group">
												<center>
													<input class="btn btn-default" name="submit" type="submit" value="Simpan Perubahan">
												</center>
											</div>
										</div>
									</div>
								</form>
								<form action="proses_edit_password.php" method="post">
									<div class="row">
										<small>Password</small>
										<hr>
										<div class="col-md-4">
											<div class="form-group">
												<label>Password :</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input name="current_password" class="form-control" type="password" required>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Ubah Password :</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input name="new_password" class="form-control" type="password" required>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Konfirmasi Password :</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input name="new_password_2" class="form-control" type="password" required>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<hr>
										<div class="form-group">
											<center>
												<input name="email" type="hidden" value="'.$dataUser['email'].'">
												<input class="btn btn-default" name="submit" type="submit" value="Simpan Perubahan">
											</center>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>';
	}
	//fungsi profile detile
	function showProfileDetail(){
		$select = mysqli_query($this->koneksi(), "SELECT * FROM user WHERE email ='".$this->email."'");
		$dataUser = mysqli_fetch_array($select);
		echo'
			<div class="col-md-3">
				<div class="thumbnail">	
					';
					if($dataUser['images'] != '' || $dataUser['images'] != null ){
						echo '
						
						<form action="proses_delete_user_img.php" method="post">	
							<a><img class="img-rounded" src="'; $userImg = $dataUser['images']; echo showImageUser($userImg); echo '"/></a>
							<div class="form-group no-margin">
								<input type="hidden" name="id" value="'.$dataUser['id'].'">
								<input type="hidden" name="images" value="'.$dataUser['images'].'">
								<input type="submit" name="submit" class="btn btn-block btn-danger" value="Hapus foto">
							</div>
							
						</form>
						<form action="proses_update_foto.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Ubah foto:</label>
								<input type="file" name="images">
								<small>JPG atau PNG</small>
								<hr>
								<input type="hidden" name="id" value="'.$dataUser['id'].'">
								<input class="btn btn-success pull-right" type="submit" name="submit" value="Simpan foto">
							</div>
						</form>
						';
					}else{
						$userImg = 'img_profile_default.jpg';
						echo '
						<a><img class="img-rounded" src="'; echo showImageUser($userImg); echo'"></a>
						<form action="proses_update_foto.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Ubah foto:</label>
								<input type="file" name="images">
								<small>JPG atau PNG</small>
								<hr>
								<input type="hidden" name="id" value="'.$dataUser['id'].'">
								<input class="btn btn-success pull-right" type="submit" name="submit" value="Simpan foto">
							</div>
						</form>
						';
					}	
					echo'
					
					<div class="form-group">
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<h3><label>'.$dataUser['first_name'].'</label></h3>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs besar" role="tablist">
						<li role="presentation" class="active">
							<a href="#profile_menu" aria-controls="profile_menu" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-volume-up" aria-hidden="true"> </span>Profile</a>
						</li>
						<li role="presentation">
							<a href="#privasi_menu" aria-controls="privasi_menu" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-edit" aria-hidden="true"> </span> Email & Password</a>
						</li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="profile_menu">
							<div class="container-fluid warna1">
								<form action="proses_update_profile.php" method="post">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Nama Lengkap </label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-6">
												<div class="form-group">
													<input name="first_name" class="form-control" type="text" value="'.$dataUser['first_name'].'">
													<small>Nama Depan</small>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">	
													<input name="sur_name" class="form-control" type="text" value="'.$dataUser['sur_name'].'">
													<small>Nama Belakang</small><br>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Nama Panggilan</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input name="username" class="form-control" type="text" value="'.$dataUser['username'].'">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Tanggal Lahir</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input name="birth_date" type="date" value="'.$dataUser['birth_date'].'">	
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Jenis Kelamin</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">';
													if($dataUser['gender'] == '' || $dataUser['gender'] == null){
														echo '
														<input name="gender" class="form-radio" type="radio" value="male">Laki-Laki
														<input name="gender" class="form-radio" type="radio" value="female">Perempuan
														';
													}else{
														if($dataUser['gender'] == 'male'){
															echo'
															<input name="gender" class="form-radio" type="radio" value="male" checked>Laki-Laki
															<input name="gender" class="form-radio" type="radio" value="female">Perempuan
															';
														}else{
															echo'
															<input name="gender" class="form-radio" type="radio" value="male">Laki-Laki
															<input name="gender" class="form-radio" type="radio" value="female" checked>Perempuan
															';
														}
													}
													echo'	
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Facebook</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input name="facebook_profile" class="form-control" type="text" value="'.$dataUser['facebook_profile'].'">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Website</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input name="website" class="form-control" type="text" value="'.$dataUser['website'].'">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<hr>
										<div class="form-group">
											<center>
												<input name="email" type="hidden" value="'.$dataUser['email'].'">
												<input class="btn btn-default" name="submit" type="submit" value="Simpan Perubahan">
											</center>
										</div>	
									</div>
								</form>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="privasi_menu">
							<div class="container-fluid warna1">
								<form action="proses_edit_email.php" method="post">
									<div class="row">
										<small>Email</small>
										<hr>
										<div class="col-md-4">
											<div class="form-group">
												<label>Email :</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input class="form-control" name="current_email" type="text" value="'.$dataUser['email'].'" readOnly="true">
													<small>Gunakan email valid untuk menerima kabar terbaru dari Indonesia Mengajar.</small>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Ubah Email :</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input class="form-control" name="email" type="email" required>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<hr>
										<div class="col-md-12">
											<div class="form-group">
												<center>
													<input class="btn btn-default" name="submit" type="submit" value="Simpan Perubahan">
												</center>
											</div>
										</div>
									</div>
								</form>
								<form action="proses_edit_password.php" method="post">
									<div class="row">
										<small>Password</small>
										<hr>
										<div class="col-md-4">
											<div class="form-group">
												<label>Password :</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input name="current_password" class="form-control" type="password" required>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Ubah Password :</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input name="new_password" class="form-control" type="password" required>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Konfirmasi Password :</label>
											</div>
										</div>
										<div class="col-md-8">
											<div class="col-md-12">
												<div class="form-group">
													<input name="new_password_2" class="form-control" type="password" required>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<hr>
										<div class="form-group">
											<center>
												<input name="email" type="hidden" value="'.$dataUser['email'].'">
												<input class="btn btn-default" name="submit" type="submit" value="Simpan Perubahan">
											</center>
										</div>	
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		';
	}
}
?>
