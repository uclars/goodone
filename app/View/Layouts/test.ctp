<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->Facebook->html(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php 
			echo $this->Html->charset();
			echo $this->Html->meta('utf-8');
			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', array( 'inline' => false ) );
			echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array( 'inline' => false ) );
			echo $this->Html->script('testutility.js', array( 'inline' => false ) );
			echo $this->Html->script('bootstrap.js', array( 'inline' => false ) );
			echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.css', array( 'inline' => false ) );
			echo $this->Html->css('bootstrap');
			echo $this->Html->css('layout');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>

		<!-- Basic Settings -->
		<style type="text/css">
			#quotationtitle{color: #969696}
			#quotationcontent{color: #969696}
			#quotationcomment{color: #969696}
			#url{color: #969696}
			#con{
				display:none;
			}
			.contentsBox{
			/*	width: 100%;*/
				border: #ccc 1px solid;
				padding: 10px;
				margin-bottom:15px;
			}
			.contentsBox .delete{
				cursor: pointer;
				color: #3cf;
				margin-top:10px;
				text-align:right;
			}
			li{
				list-style: none; 
			}
	        </style>

		<!-- FORM -->
		<style type="text/css">
		/* 共用設定*/
			fieldset {
				margin: 0 0 10px;
				/*padding: 10px 20px;*/
			}
			legend {
				margin: 0 0 0 20px;
				padding: 5px 20px;
				color: #666;
				font-weight: bold;
				font-size: 150%;
				text-align:left;
				/*border: 1px #FFF solid;*/
			}
			input,
			textarea {
				margin: 0 0 10px;
				width: 98%;
				border-width: 2px;
				border-style: solid;
			}
			button {
				padding: 5px 20px;
				color: #FFFFFF;
				font-weight: bold;
				border: none;
			}

		/*input class*/
			input.inputtitle{
				margin: 0 0 20px;
				width: 100%;
				font-size: 120%;
			}
			input.contentstitle{
				/*width: 100%;*/
				margin: 0 0 1px;
			}
			textarea.contentsbody{
				/*width: 100%;*/
				margin: 0 0 1px;
			}
			textarea.contentscomment{
				/*width: 100%;*/
				margin-left: auto;
				margin-right: auto;
			}
		/* submit button class */
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
			.submitinsideclass{
				padding: 5px 10px;
				margin-bottom: 10px;
				display: inline;
				background: #0096ea;
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
			.submitinsideclass:hover{
				background: #ddd
			}
			.submitdisableclass{
				padding: 5px 10px;
				margin-bottom: 10px;
				display: inline;
				background: gray;
				border: none;
				color: #fff;
				width: 250px;
				cursor: pointer;
				font-weight: bold;
				border-radius: 5px;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				text-shadow: 1px 1px #666;
			}
		</style>
                <script type="text/javascript">
                /* set default text in teh iput/textarea. When focused, it disappers */
                        $(function(){
                                $("#quotationtitle").focus(function(){
                                        if(this.value == "Input URL"){
                                                $(this).val("").css("color","#000");
                                        }
                                });
                                $("#quotationtitle").blur(function(){
                                        if(this.value == ""){
                                                $(this).val("Input URL").css("color","#969696");
                                        }
                                });
                                $("#quotationcontent").focus(function(){
                                        if(this.value == "Copy and Paste the Quotation"){
                                                $(this).val("").css("color","#000");
                                        }
                                });
                                $("#quotationcontent").blur(function(){
                                        if(this.value == ""){
                                                $(this).val("Copy and Paste the Quotation").css("color","#969696");
                                        }
                                });
                                $("#quotationcomment").focus(function(){
                                        if(this.value == "Input your comment"){
                                                $(this).val("").css("color","#000");
                                        }
                                });
                                $("#quotationcomment").blur(function(){
                                        if(this.value == ""){
                                                $(this).val("Input your comment").css("color","#969696");
                                        }
                                });
			});
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
                        <a class="brand" href="http://yahoo.com">Sortable Test</a>
                        <div class="nav-collapse">
                                <ul class="nav pull-right">
                                        <li class="divider-vertical"></li>
<?php
                //mypage url
                $mypage_url = "/Users/show_users/id:".$auth['id'];
                $logout_url = $this->Facebook->logout(array('redirect'=>array('controller'=>'Users', 'action'=>'logout'),'label'=>'LOGOUT'));
                // User Name
                if(empty($auth['username'])){
                        $myname = $auth['email'];
                }else{
                        $myname = $auth['username'];
                }
?>
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
<?php echo $this->Facebook->init(); ?>
</body>
</html>
