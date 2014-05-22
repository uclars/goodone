<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->Facebook->html(); ?>
	<head>
		<?php 
			echo $this->Html->charset();
			echo $this->Html->meta('utf-8');
			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array( 'inline' => false ) );
			echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js', array( 'inline' => false ) );
			echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css');
			echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
			echo $this->Html->css('homelayout');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<?php $auth = $this->Session->read('Auth.User'); ?>
<header class="navbar navbar-default navbar-fixed-top" role="banner">
	<div class="container">
		<div class="navbar-header">
			<a href="/" class="navbar-brand">Good One</a>
		</div>
		<nav class="collapse navbar-collapse" role="navigation">
			<ul class="nav navbar-right navbar-nav">
<?php
        if(empty($auth)){
				echo "<span class='fb-like'>".$this->Facebook->login(array('scope'=>'email, user_birthday','show-faces'=>'false'))."</span>";
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
					echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$myname." <i class='fa fa-male fa-lg'></i></a>";
						echo "<ul class='dropdown-menu' style='padding:12px;'>";
							echo "<li><a href='".$mypage_url."'>My Page</a></li>";
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

<div id="masthead">	
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>Revolutionise Your Tedious Trawling. <br />Find Crucially Relevant, Tailored Results
					<p class="lead">Eliminate trawling through useless links to find key information<br />Here I cherry pick the best and host it all in one place. </p>
				</h1>
			</div>
			<div class="col-md-4">
				<div class="well well-lg"> 
					<div class="row">
						<div class="col-sm-12">
							Ad Space			
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12"> 
			<div class="panel">
				<div class="panel-body">
<?php
	$this->session->flash();
	echo $this->fetch('content');
?>
				</div>
			</div>									 
		</div><!--/col-12-->
	</div>
</div>
<hr>

<div class="container" id="footer">
	<div class="row">
		<div class="col col-sm-12">
			
			<h1>Follow Us</h1>
			<div class="btn-group">
				<a class="btn btn-twitter btn-lg" href="#"><i class="icon-twitter icon-large"></i> Twitter</a>
				<a class="btn btn-facebook btn-lg" href="#"><i class="icon-facebook icon-large"></i> Facebook</a>
				<a class="btn btn-google-plus btn-lg" href="#"><i class="icon-google-plus icon-large"></i> Google+</a>
			</div>
		</div>
	</div>
</div>

<hr>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<ul class="list-inline">
					<li><i class="icon-facebook icon-2x"></i></li>
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
<?php //echo $this->element('sql_dump'); ?>
<?php echo $this->Facebook->init(); ?>
</body>
</html>

