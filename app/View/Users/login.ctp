<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4">
			<h1 class="text-center login-title">Sign in with facebook account to continue to GoodOne <i class="fa fa-thumbs-o-up"></i></h1>
			<div class="account-wall">
				<img class="profile-img" src="/img/basic/loginimage.png" alt="">
				<div class="form-signin">
<?php
				if(!empty($registration)){
					echo "<a class='btn btn-facebook btn-lg' href='/Users/register/'><i class='icon-facebook icon-large'></i> Facebook Register</a>";
				}else{
					echo "<span class='fb-login'>".$this->Facebook->login(array('scope'=>'email, user_birthday','show-faces'=>'false','size' => 'xlarge'))."</span>";
				}
?>
				</div>
			</div>
		</div>
	</div>
</div>
