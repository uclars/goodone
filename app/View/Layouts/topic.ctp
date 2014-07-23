<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php echo $this->Facebook->html(); ?>
	<head>
		<?php 
			echo $this->Html->charset();
			echo $this->Html->meta('utf-8');
			echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=9; IE=8; IE=7; IE=EDGE; chrome=1\" />";
			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array( 'inline' => false ) );
			echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js', array( 'inline' => false ) );
			echo $this->Html->script('http:////cdnjs.cloudflare.com/ajax/libs/Cookies.js/0.3.1/cookies.min.js', array( 'inline' => false ) );
			echo $this->Html->script('jquery.youtubin.js', array( 'inline' => false ) );
			echo $this->Html->script('jquery.tile.min.js', array( 'inline' => false ) );
			echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css');
			echo $this->Html->css('http://fonts.googleapis.com/css?family=Roboto:400,300,700italic,700,500&amp;subset=latin,latin-ext');
			echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
			//echo $this->Html->css('style');
			echo $this->Html->css('topiclayout');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		
		<title><?php echo $title_for_layout; ?> | Good One</title>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40811920-1', '0-0b.com');
  ga('send', 'pageview');

</script>
<script type='text/javascript'>
	$(function() {
		$(".heightalign").tile(2);
	});
/*
	$('#youtube').youtubin({
		swfWidth:320,
		swfHeight:240
	});
*/
</script>
	</head>
<body>
<?php $auth = $this->Session->read('Auth.User'); ?>
<header class="navbar navbar-default navbar-fixed-top" role="banner">
        <div class="container">
                <div class="navbar-header">
                        <a href="/" class="navbar-brand">Good One <i class="fa fa-thumbs-o-up"></i></a><span class='navbar-brand' style='font-size: small'> Curation and Editing Service</span>
                </div>
                <nav class="collapse navbar-collapse" role="navigation">
                        <ul class="nav navbar-right navbar-nav">
<?php
        if(empty($auth)){
				echo "<li><a href='/Users/login'>Login / Register</a></li>";
                                //echo "<span class='fb-connect'>".$this->Facebook->login(array('scope'=>'email, user_birthday','show-faces'=>'false'))."</span>";
        }else{
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
						echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-male fa-lg'></i> ".$myname."<b class='caret'></b></a>";
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
                </nav>
        </div>
</header>


<div class="container">
<?php
	$this->session->flash();
	echo $this->fetch('content');
?>
</div>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<ul class="list-inline">
					<li><i class="icon-facebook"></i></li>
					<li><i class="icon-twitter icon-2x"></i></li>
					<li><i class="icon-google-plus icon-2x"></i></li>
					<li><i class="icon-pinterest icon-2x"></i></li>
				</ul>
			</div>
			<div class="col-sm-8">
				<p>&copy; 2014 0-0b.com &middot; <a href="/privacypolicy.html">Privacy</a> &middot; <a href="/termsofuse.html">Terms</a></p>
			</div>
		</div>
	</div>
</footer>

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
<?php //echo $this->element('sql_dump'); ?>
<?php echo $this->Facebook->init(); ?>
</body>
</html>

