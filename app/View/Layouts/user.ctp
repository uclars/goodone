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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40811920-1', '0-0b.com');
  ga('send', 'pageview');

</script>
		<style type="text/css">
                        input,
                        textarea {
                                margin: 0 0 10px;
                                width: 60%;
                                border-width: 2px;
                                border-style: solid;
                        }
			.submitclass{
                                padding: 5px 10px;
                                margin-bottom: 10px;
                                display: inline;
                                background: #211f5a;
                                /*background: #f7376b;*/
                                border: none;
                                color: #fff;
                                width: 200px;
                                cursor: pointer;
                                font-weight: bold;
                                border-radius: 5px;
                                -moz-border-radius: 5px;
                                -webkit-border-radius: 5px;
                                text-shadow: 1px 1px #666;
                        }
                        .submitclass:hover{
                                background: #ddd
                        }
			.topic_delete{
				cursor: pointer;
				color: #3cf;
				margin-top:5px;
				margin-left:5px;
				text-align:center:
			}

			.delete_confirm{
				cursor: pointer;
				background-color: #3cf;
				color: #fff;
				font-weight: bold;
				margin-top:10px;
				margin-right:10px;
				text-align:center;
				display:inline;
                        }
			.delete_cancel{
				cursor: pointer;
				background-color: #bbb;
				color: #fff;
				font-weight: bold;
				margin-top:10px;
				margin-left:10px;
				text-align:center;
				display:inline;
			}
			.show_topic{
				margin-top:10px;
			}
			.show_topic a{
				cursor: pointer;
				color: #3cf;
				margin-left:5px;
				text-align:left;
			}
		</style>
	</head>
<body>
<?php $auth = $this->Session->read('Auth.User'); ?>
<header class="navbar navbar-default navbar-fixed-top" role="banner">
	<div class="container">
		<div class="navbar-header">
			<a href="/" class="navbar-brand">Good One <i class="fa fa-thumbs-o-up"></i></a>
		</div>
		<nav class="collapse navbar-collapse" role="navigation">
			<ul class="nav navbar-right navbar-nav">
<?php
	if(empty($auth)){
		echo "<li><a href='/Users/login'>Login / Register</a></li>";
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
				echo "<li><a href='/Topics/create'>Create Web Clipping</a></li>";
				echo "<li class='dropdown'>";
					echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-male fa-lg'></i> ".$myname."<b class='caret'></b></a>";
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
<?php //echo $this->element('sql_dump'); ?>
<?php echo $this->Facebook->init(); ?>
</body>
</html>

