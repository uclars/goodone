<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->Facebook->html(); ?>
	<head>
		<?php 
			echo $this->Html->charset();
			echo $this->Html->meta('utf-8');
			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array( 'inline' => false ) );
			echo $this->Html->script('bootstrap.js', array( 'inline' => false ) );
			echo $this->Html->script('show_user.js', array( 'inline' => false ) );
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
				margin-top:10px;
				margin-left:5px;
				text-align:left;
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
		</style>
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
		echo "<li>".$this->Facebook->login(array('scope'=>'email, user_birthday','show-faces'=>'false'))."</li>";
        }
	elseif(empty($auth['id']) AND !empty($auth['facebook_id'])){
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
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="span12">
			<!--<h1>Satisfy MA30+'s Curiosity</h1>-->
			<!--<p class="lead">Exciting & Useful Contetns for Mature Audiences</p>-->
		</div>
	</div>
<?php
	$this->session->flash();
	echo $this->fetch('content');
?>
</div>
<?php echo $this->Facebook->init(); ?>
</body>
</html>

