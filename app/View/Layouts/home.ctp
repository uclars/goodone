<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->Facebook->html(); ?>
	<head>
		<?php 
			echo $this->Html->charset();
			echo $this->Html->meta('utf-8');
			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array( 'inline' => false ) );
			echo $this->Html->script('bootstrap.js', array( 'inline' => false ) );
			echo $this->Html->css('bootstrap');
			//echo $this->Html->css('additional');
			echo $this->Html->css('layout');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40811920-1', '0-0b.com');
  ga('send', 'pageview');

</script>
	</head>
<body>
<?php $auth = $this->Session->read('Auth.User'); ?>
<div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
                <div class="container">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="/">Good One</a>
                        <div class="nav-collapse">
                                <ul class="nav pull-right">
                                        <li class="divider-vertical"></li>
<?php
	if(empty($auth)){
					echo "<li><a href='/Users/register/'>Register</a></li>";
					echo $this->Facebook->registration();
					//echo $this->Facebook->login(array('style'=>'margin:15px;','perms'=>'email, user_birthday','show-faces'=>'false'));
					//echo $this->Facebook->login(array('custom' => true, 'redirect' => '/', 'id' => 'fbconnect', 'img' => 'connectwithfacebook.gif'));
	}
	else{
		//mypage url
		$mypage_url = "/Users/show_users/id:".$auth['id'];
		$logout_url = $this->Facebook->logout(array('redirect'=>array('controller'=>'Users', 'action'=>'logout'),'label'=>'LOGOUT'));
		// User Name
		if(empty($auth['username'])){
			$myname = $auth['email'];
		}else{
			$myname = $auth['username'];
		}
                                        echo "<li><a href='/topics/create'>Create Roundup</a></li>";
					echo "<li class='dropdown'>";
						echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$myname."<b class='caret'></b></a>";
						echo "<ul class='dropdown-menu'>";
							echo "<li><a href='".$mypage_url."'>My Page</a></li>";
							//echo "<li><a href='#'>Something else here</a></li>";
							echo "<li class='divider'></li>";
							echo "<li>".$logout_url."</li>";
						echo "</ul>";
					echo "</li>";
	}
?>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="span12">
			<!--<h1>Satisfy MA30+'s Curiosity</h1>-->
			<!--<p class="lead">Exciting & Useful Contetns for Mature Audiences</p>-->
			<div style='text-align:center; color:#333; line-height:150%; margin-bottom:35px'>
				<h1>Most important contents only</h1>
				<h1>Share what you reserched</h1>
			</div>
			<div style='font-size:18px; text-align:center; line-height:110%; margin-bottom:55px;'>
				<p>Good one provides only bare essentials someone has already searched and selected.</p>
			</div>
		</div>
	</div>
<?php
	$this->session->flash();
	echo $this->fetch('content');
?>
	<footer class="footer">
		<div class="container">
			<p>&copy; 2013 0-0b.com &middot; <a href="/privacypolicy.html">Privacy</a> &middot; <a href="/termsofuse.html">Terms</a></p>
		</div>
	</footer>
</div>	
<?php //echo $this->element('sql_dump'); ?>
<?php echo $this->Facebook->init(); ?>
</body>
</html>

