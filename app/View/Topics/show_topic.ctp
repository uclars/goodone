<?php
$me_array = $this->Session->read('Auth.User');
$me = $me_array['id'];

///topic owner info
if(!empty($topic_user_pic)){
	$owner_avator = $topic_user_pic[0]['Masteravators']['url24'];
	$owner_id =  $topic_user_pic[0]['User']['id'];
	$owner_name =  $topic_user_pic[0]['User']['username'];
}
else{
	$owner_avator = "/img/avator/dogs/shepherd/shepherd_24.png";
	$owner_id =  0;
	$owner_name = "unknown";
}
?>

<div class="row">
<br />
	  
<!-- CONTENT SIDE-->
	<div class="col-sm-8 col-lg-8">
	<!-- article-->
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-left">
		<?php
		if(!empty($topics[0]['Topic']['topic_image'])){
			echo "<img class='img-responsive' src='".IMAGE_URL.$topics[0]['Topic']['topic_image']."' alt='post image'>";
		}else{
			echo "<img class='img-responsive' src='".$topics[0]['Mastercategory']['url']."' alt='post image'>";
		}
		?>
		</div>
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<?php echo "<h2 class=''>".h($topics[0]['Topic']['name'])."</h2>"; ?>
			<p class=" clearfix">
				<?php echo "<span class='fb-like'>".$this->Facebook->like(array('layout'=>'button_count'))."</span>"; ?>
				<?php echo "<span class='fb-like'><su:badge layout=\"1\"></su:badge></span>"; ?>
				<?php echo " | ".$topics[0]['Mastercategory']['name']; ?>
				<?php echo " | ".$this->html->image($owner_avator)." ".$owner_name; ?>
			</p>
		</div>
		<?php echo "<p class='lead'>".h($topics[0]['Topic']['description'])."</p>"; ?>
		<hr>


<?php
//////////////////////////////////////////////////
//////////    CONTENTS      //////////////////////
//////////////////////////////////////////////////
foreach($show_contents as $contents_array){
	if($contents_array[0] == "__heading__"){
		echo"<div class='page-header'><h2>".h($contents_array[2])."</h2></div>";
	}
	elseif($contents_array[0] == "__textcomment__"){
		echo "<div style='font-size:medium; margin-top:20px;'>".h($contents_array[2])."</div>";
	}
	elseif($contents_array[0] == "__imageurl__"){
		$pic_ad_array = array();
		$pic_ad_array =split("\(__\)",$contents_array[1]);
		//image  url
		$pic_address = $pic_ad_array[0];
		//image title
		$pic_title = $pic_ad_array[1];
		//image owner
		$pic_user = $pic_ad_array[2];
		//image address
		$simg_url =$contents_array[2];
		//$simg_url = str_replace(".jpg","_m.jpg",$contents_array[2]);
		$simg_url = str_replace(".jpg",".jpg",$contents_array[2]);

		//Display the image
		echo "<div style='margin-bottom:10px;'>";
		if($pic_address != "imageupload"){//if image is from upload, the link disappear
			echo "<div>".$this->Html->link($this->Html->image($simg_url),$pic_address,array('target' => '_blank', 'escape' => false))."</div>";
			echo "<div style='font-size:x-small;'>".$this->Html->link("photo: $pic_title by $pic_user",$pic_address,array('target' => '_blank', 'escape' => false))."</div>";
		}
		else{
			$image_url = IMAGE_URL.$simg_url;
			echo "<div>".$this->Html->image($image_url,array('style'=>'max-width:100%;height:auto;'))."</div>";
			echo "<div> </div>";
		}
		echo "</div>";
	}
	elseif($contents_array[0] == "__youtubeurl__"){
		$youtube_ad_array = array();
		$youtube_ad_array =split("\(__\)",$contents_array[1]);
		//youtube  url
		$youtube_address = $youtube_ad_array[0];
		//youtube title
		$youtube_title = $youtube_ad_array[1];
		//image owner
		$youtube_user = $youtube_ad_array[2];


		//Display the youtube movie
		echo "<div style='margin-top:20px; margin-bottom:10px;'>";
			echo "<div>".$this->Html->link("Check out this video",h($youtube_address),array('rel' => 'nofollow', 'id' => 'youtube', 'class' => 'youtubin'))."</div>";
			//echo "<div style='font-size:x-small;'>".$this->Html->link("photo: $pic_title by $pic_user",$pic_address,array('target' => '_blank', 'escape' => false))."</div>";
			echo "<script type='text/javascript'>";
				echo "$('a.youtubin').youtubin({";
					echo "swfWidth:320,";
					echo "swfHeight:240";
				echo "});";
			echo "</script>";
		echo "</div>";
	}
	else{
		echo "<blockquote style='margin-top:20px; margin-bottom:0px'>";
		echo "<p>".nl2br(h($contents_array[1]))."</p>"; //put <BR />
		echo "<small><cite title='".h($contents_array[0])."'><a href='".h($contents_array[0])."' target='_'>".h($contents_array[0])."</a></cite></small>";
		echo "</blockquote>";
		echo "<div style='padding-left:10px; margin-bottom:10px'>".h($contents_array[2])."</div>";
	}
			
}

	//Share Button
	echo "<div style='margin:50px 0 0 0;'>";
		//echo "<a href='https://www.facebook.com/sharer/sharer.php?u=".urlencode(Router::url($this->here, true))."' rel='nofollow' target='_blank'>".$this->HTML->image('basic/shareonfacebook.jpg')."</a>";
		echo "<a class='btn btn-facebook btn-lg' href='https://www.facebook.com/sharer/sharer.php?u=".urlencode(Router::url($this->here, true))."'><i class='icon-facebook icon-large'></i> Facebook Share</a>";
	echo "</div>";
?>
	<!-- Related Articles -->
	<div class="row">
		<div class="panel panel-default" style="margin-top:30px;">
			<div class="panel-heading">
				<h3><i class="icon-comments-alt"></i> Related Articles </h3>
			</div>
<?php
$i=0;
foreach($ranking as $ranking_array){
	foreach($ranking_array as $rankings){
			if($i<5){
				echo "<div class='row'>";
				echo "<div class='heightalign col-xs-1 col-sm-1 col-md-1 col-lg-1' style='vertical-align:middle;'>";
					if(!empty($rankings['Topic']['topic_image'])){
						echo "&nbsp;<img src='".$rankings['Topic']['topic_image']."' class='img-responsive' style='vertical-align:middle;' alt=''>&nbsp;";
					}else{
						echo "&nbsp;<img src='".$rankings['Mastercategory']['url']."' class='img-responsive' style='vertical-align:middle;' alt=''>&nbsp;";
					}
				echo "</div>";
				echo "<div class='heightalign col-xs-11 col-sm-11 col-md-11 col-lg-11'>";
					echo "<h4><a href='/Topics/show_topic/topicid:".$rankings['Topic']['id']."' target= '_blank'>".$rankings['Topic']['name']."</a></h4>";
				echo "</div>";
				echo "</div>";
				$i++;
			}
	}
}
?>
		</div>
	</div><!-- end of row -->
	<!-- End of Related Articles -->
	<div class="panel panel-default" style="margin-top:30px;">
		<div class="panel-heading">
			<h3><i class="icon-comments-alt"></i>  USERS COMMENTS </h3>
		 </div>
	<!-- For DISQUS -->
	<div id='disqus_thread'></div>
	<script type="text/javascript">
		/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		var disqus_shortname = 'goodone'; // required: replace example with your forum shortname

		/* * * DON'T EDIT BELOW THIS LINE * * */
		(function() {
			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
	<!-- For DISQUS -->
	</div>
</div>
<!-- /CONTENT SIDE-->
   
<!-- RIGHT SIDE-->   
	<div style="z-index:1020" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right"><!-- z-index:1020; - fix for .pull-right on xs widths-->
		<div class="panel panel-default">
			<div class="panel-body">
				<div style='text-align:center;'>
					<a href="http://www.jdoqocy.com/click-6439315-11648852" target="_blank">
					<img src="http://www.awltovhc.com/image-6439315-11648852" width="250" height="250" alt="" border="0"/></a>
				</div>
			</div>
		</div>


		<div class="list-group">
			<ul class="nav nav-pills nav-stacked">
			<?php
			if($topics[0]['Mastercategory']['name'] === "life"){
				echo "<li><a href='/Topics/show_category/categoryid:1' class='list-group-item hidden-xs active'><i class='fa fa-home'></i><span style='margin-left:15px;'>Life</span></a></li>";
			}else{
				echo "<li><a href='/Topics/show_category/categoryid:1' class='list-group-item hidden-xs'><i class='fa fa-home'></i><span style='margin-left:15px;'>Life</span></a></li>";
			}
			if($topics[0]['Mastercategory']['name'] === "business"){
				echo "<li><a href='/Topics/show_category/categoryid:2' class='list-group-item hidden-xs active'><i class='fa fa-list-alt fa-money'></i><span style='margin-left:15px;'>Business</span></a></li>";
			}else{
				echo "<li><a href='/Topics/show_category/categoryid:2' class='list-group-item hidden-xs'><i class='fa fa-list-alt fa-money'></i><span style='margin-left:15px;'>Business</span></a></li>";
			}
			if($topics[0]['Mastercategory']['name'] === "politics"){
				echo "<li><a href='/Topics/show_category/categoryid:3' class='list-group-item hidden-xs active'><i class='fa fa-list-alt fa-bank'></i><span style='margin-left:15px;'>Politics</span></a></li>";
			}else{
				echo "<li><a href='/Topics/show_category/categoryid:3' class='list-group-item hidden-xs'><i class='fa fa-list-alt fa-bank'></i><span style='margin-left:15px;'>Politics</span></a></li>";
			}
			if($topics[0]['Mastercategory']['name'] === "IT"){
				echo "<li><a href='/Topics/show_category/categoryid:4' class='list-group-item hidden-xs active'><i class='fa fa-list-alt fa-cloud'></i><span style='margin-left:15px;'>IT</span></a></li>";
			}else{
				echo "<li><a href='/Topics/show_category/categoryid:4' class='list-group-item hidden-xs'><i class='fa fa-list-alt fa-cloud'></i><span style='margin-left:15px;'>IT</span></a></li>";
			}
			if($topics[0]['Mastercategory']['name'] === "trivia"){
				echo "<li><a href='/Topics/show_category/categoryid:5' class='list-group-item hidden-xs active'><i class='fa fa-list-alt fa-cogs'></i><span style='margin-left:15px;'>Trivia</span></a></li>";
			}else{
				echo "<li><a href='/Topics/show_category/categoryid:5' class='list-group-item hidden-xs'><i class='fa fa-list-alt fa-cogs'></i><span style='margin-left:15px;'>Trivia</span></a></li>";
			}
			if($topics[0]['Mastercategory']['name'] === "entertainment"){
				echo "<li><a href='/Topics/show_category/categoryid:6' class='list-group-item hidden-xs active'><i class='fa fa-music'></i><span style='margin-left:15px;'>Entertainment</span></a></li>";
			}else{
				echo "<li><a href='/Topics/show_category/categoryid:6' class='list-group-item hidden-xs'><i class='fa fa-music'></i><span style='margin-left:15px;'>Entertainment</span></a></li>";
			}
			if($topics[0]['Mastercategory']['name'] === "sports"){
				echo "<li><a href='/Topics/show_category/categoryid:7' class='list-group-item hidden-xs active'><i class='fa fa-list-alt fa-life-ring'></i><span style='margin-left:15px;'>Sports</span></a></li>";
			}else{
				echo "<li><a href='/Topics/show_category/categoryid:7' class='list-group-item hidden-xs'><i class='fa fa-list-alt fa-life-ring'></i><span style='margin-left:15px;'>Sports</span></a></li>";
			}
			?>
			</ul>
		</div>
	</div>
	<div class="col-sm-4 col-lg-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<!-- TABS CONTROLS -->
				<ul id="myTab" class="nav nav-tabs nav-justified">
					<li class="active"><a href="#home" data-toggle="tab">POPULAR</a></li>
					<li ><a href="#related" data-toggle="tab">NEW</a></li>
				</ul>
				<!-- /TABS CONTROLS -->
				<!-- PANES -->
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade in active" id="home">
						<div class="row">
<?php
foreach($popular as $popular_array){
	foreach($popular_array as $populars){
		$popularid = $populars['Topic']['id'];
		$populartitle = $populars['Topic']['name'];
		$popularimage = $populars['Topic']['topic_image'];
		$popularcategory = $populars['Mastercategory']['url'];

							echo "<div class='col-xs-6 col-sm-12 col-lg-12'>";
								echo "<div class='row'>";
									echo "<div class='heightalign col-xs-4 col-sm-6 col-md-4 col-lg-4 text-center hidden-sm'>";
										echo "<div class='thumbnail'>";
										if(empty($popularimage)){
											echo "<img src='".$popularcategory."' width='50px' class='img-responsive' alt=''>";
										}else{
											echo "<img src='".$popularimage."' class='img-responsive' alt=''>";
										}
										echo "</div>";
									echo "</div>";
									echo "<div class='heightalign col-xs-8 col-sm-12 col-md-8 col-lg-8'>";
										echo "<a class=''href='/Topics/show_topic/topicid:$popularid'><h5>$populartitle</h5></a>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
	}
}

?>
						</div>
						<!-- /.row-->
					</div>
					<div class="tab-pane fade widget-tags " id="related">
						<div class="row">
<?php
foreach($ranking as $ranking_array){
        foreach($ranking_array as $rankings){
                $rankingid = $rankings['Topic']['id'];
                $rankingtitle = $rankings['Topic']['name'];
                $rankingimage = $rankings['Topic']['topic_image'];
                $rankingcategory = $rankings['Mastercategory']['url'];

                                                        echo "<div class='col-xs-6 col-sm-12 col-lg-12'>";
                                                                echo "<div class='row'>";
                                                                        echo "<div class='col-xs-4 col-sm-6 col-md-4 col-lg-4 text-center hidden-sm'>";
                                                                                echo "<div class='thumbnail' style=''>";
                                                                                if(empty($rankingimage)){
                                                                                        echo "<img src='".$rankingcategory."' width='50px' class='img-responsive' alt=''>";
                                                                                }else{
                                                                                        echo "<img src='".$rankingimage."' class='img-responsive' alt=''>";
                                                                                }
                                                                                echo "</div>";
                                                                        echo "</div>";
                                                                        echo "<div class='col-xs-8 col-sm-12 col-md-8 col-lg-8'>";
                                                                                echo "<a class=''href='/Topics/show_topic/topicid:$rankingid'><h5>$rankingtitle</h5></a>";
                                                                        echo "</div>";
                                                                echo "</div>";
                                                        echo "</div>";
        }
}
?>
						</div>
						<!--<style>.widget-tags a {display:inline-block; margin-bottom:3px;}</style>-->
						<!--<a href="#"><span class="label label-info">info</span></a>-->
						<!--<a href="#"><span class="label label-success">success</span></a>-->
						<!--<a href="#"><span class="label label-warning">warning</span></a>-->
						<!--<a href="#"><span class="label label-danger">danger</span></a> -->
					</div>
				</div><!-- /.myTabContent-->
			</div>
		</div>
	</div>
<!-- /RIGHT SIDE--> 
<?php
echo "</div>";
?>
