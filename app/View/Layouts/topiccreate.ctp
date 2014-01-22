<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->Facebook->html(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php 
			echo $this->Html->charset();
			echo $this->Html->meta('utf-8');
			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', array( 'inline' => false ) );
			echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', array( 'inline' => false ) );
			echo $this->Html->script('utility.js', array( 'inline' => false ) );
		//echo $this->Html->script('jquery.ui.widget.js', array( 'inline' => false ) );
		//echo $this->Html->script('load-image.min.js', array( 'inline' => false ) );
		//echo $this->Html->script('canvas-to-blob.min.js', array( 'inline' => false ) );
		//echo $this->Html->script('jquery.iframe-transport.js', array( 'inline' => false ) );
		//echo $this->Html->script('jquery.fileupload.js', array( 'inline' => false ) );
		//echo $this->Html->script('jquery.fileupload-process.js', array( 'inline' => false ) );

		echo $this->Html->script('jquery.upload-1.0.2', array( 'inline' => false ) );
			echo $this->Html->script('bootstrap.js', array( 'inline' => false ) );
			//echo $this->Html->script('wysihtml5-0.3.0.js', array( 'inline' => false ) );
			//echo $this->Html->script('bootstrap-wysihtml5.js', array( 'inline' => false ) );
			//echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/blitzer/jquery-ui.css', array( 'inline' => false ) );
			echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.css', array( 'inline' => false ) );
			echo $this->Html->css('bootstrap');
			//echo $this->Html->css('bootstrap-responsive');
			//echo $this->Html->css('bootstrap-wysihtml5');
			echo $this->Html->css('layout');

			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>

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
				$("#web_url_con").focus(function(){
					if(this.value == "Input the target url"){
						$(this).val("").css("color","#000");
					}
				});
				$("#web_url_con").blur(function(){
					if(this.value == ""){
						$(this).val("Input the target url").css("color","#969696");
					}
				});
				$("#heading").focus(function(){
					if(this.value == "Input heading words"){
						$(this).val("").css("color","#000");
					}
				});
				$("#heading").blur(function(){
					if(this.value == ""){
						$(this).val("Input heading words").css("color","#969696");
					}
				});
				$("#textcomment").focus(function(){
					if(this.value == "Input comment"){
						$(this).val("").css("color","#000");
					}
				});
				$("#textcomment").blur(function(){
					if(this.value == ""){
						$(this).val("Input comment").css("color","#969696");
					}
				});
				$("#imagetext").focus(function(){
					if(this.value == "key word"){
						$(this).val("").css("color","#000");
					}
				});
				$("#imagetext").blur(function(){
					if(this.value == ""){
						$(this).val("key word").css("color","#969696");
					}
				});
				$("#coppy").focus(function(){
					if(this.value == "Do not edit the sentense from the original. Just copy and past it."){
						$(this).val("").css("color","#000");
					}
				});
				$("#coppy").blur(function(){
					if(this.value == ""){
						$(this).val("Do not edit the sentense from the original. Just copy and past it.").css("color","#969696");
					}
				});
				$("#url").focus(function(){
					if(this.value == "Web Clipping Title"){
						$(this).val("").css("color","#000");
					}else{$(this).css("color","#000"); }
				});
				$("#url").blur(function(){
					if(this.value == ""){
						$(this).val("Web Clipping Title").css("color","#969696");
					}else{$(this).css("color","#000"); }
				});






///Topics/uploadImage

var url = 'Topics/uploadImage';
var callback = function(res) {
    // IEのコールバックタイプが動かない場合への対処
    alert('File uploaded');
    res = JSON.parse(res); 
    alert('File uploaded');
    return this;
};
$('input[type=file]').change(function() {
    $(this).upload(url, callback);
});









			});
			var username = <?php echo $userid; ?>;
			var title_id = <?php echo $tid; ?>;

/*
			$(document).ready(function() 
			{
				$('#photoimg').live('change', function(){
console.log("JJJ");
					$("#preview").html('');
					$("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
					$("#imageform").ajaxForm({
						target: '#preview'
					}).submit();
				});
			}); 
*/
		</script>

		<!-- Basic Settings -->
		<style type="text/css">
			#quotationtitle{color: #969696}
			#quotationcontent{color: #969696}
			#quotationcomment{color: #969696}
			#web_url_con{color: #969696}
			#heading{color: #969696}
			#imagetext{color: #969696}
			#coppy{color: #969696}
			#url{color: #969696}
			#textcomment{color: #969696}
			.contentsbody{color: #969696}
			.contentscomment{color: #969696}
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
			.fileUpload {
				position: relative;
				overflow: hidden;
				margin: 10px;
			}
			.fileUpload input.upload {
				position: absolute;
				top: 0;
				right: 0;
				margin: 0;
				padding: 0;
				font-size: 20px;
				cursor: pointer;
				opacity: 0;
				filter: alpha(opacity=0);
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
			.moreButton{
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
			.moreButton:hover{
				background: #ddd
			}

		/* loading icon */
		/* http://www.finefinefine.jp/web/kiji1706/ */
			#loading {
				display: none;
			}
		</style>
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
//echo $this->Facebook->registration();
                                        echo $this->Facebook->login(array('style'=>'margin:15px;','perms'=>'email, user_birthday','show-faces'=>'false'));
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
