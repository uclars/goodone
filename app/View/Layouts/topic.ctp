<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php echo $this->Facebook->html(); ?>
	<head>
		<?php 
			echo $this->Html->charset();
			echo $this->Html->meta('utf-8');
			echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=9; IE=8; IE=7; IE=EDGE; chrome=1\" />";
			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array( 'inline' => false ) );
			echo $this->Html->script('bootstrap.js', array( 'inline' => false ) );
			//echo $this->Html->script('http://cdnjs.cloudflare.com/ajax/libs/json3/3.2.4/json3.min.js', array( 'inline' => false ) );
			echo $this->Html->script('http:////cdnjs.cloudflare.com/ajax/libs/Cookies.js/0.3.1/cookies.min.js', array( 'inline' => false ) );
			echo $this->Html->script('jquery.youtubin.js', array( 'inline' => false ) );
			echo $this->Html->css('style');
			echo $this->Html->css('bootstrap');
			//echo $this->Html->css('additional');
			echo $this->Html->css('layout');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>

		
		<title><?php echo $title_for_layout; ?></title>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40811920-1', '0-0b.com');
  ga('send', 'pageview');

</script>
<script type='text/javascript'>
/*
	$('#youtube').youtubin({
		swfWidth:320,
		swfHeight:240
	});
*/
</script>
	</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
                <div class="container">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
G                                <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="/">Good One</a>
                        <div class="nav-collapse">
                                <ul class="nav pull-right">
                                        <li class="divider-vertical"></li>
<?php
        if(empty($auth)){
					echo $this->Facebook->login(array('scope'=>'email, user_birthday','show-faces'=>'false'));
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
					echo "<li><a href='/topics/create'>Create Web Clipping</a></li>";
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
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="container">
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
<script type="text/javascript">
	/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	var disqus_shortname = 'goodone'; // required: replace example with your forum shortname

	/* * * DON'T EDIT BELOW THIS LINE * * */
	(function () {
		var s = document.createElement('script'); s.async = true;
		s.type = 'text/javascript';
		s.src = '//' + disqus_shortname + '.disqus.com/count.js';
		(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
	}());
</script>    
<?php echo $this->Facebook->init(); ?>
</body>
</html>

