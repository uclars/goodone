<?php
        $me_array = $this->Session->read('Auth.User');
        $me = $me_array['id'];

        ///topic owner info
        if(!empty($topic_user_pic)){
		$owner_avator = $topic_user_pic[0]['Masteravators']['url24'];
                //$owner_avator = "/img/avator/dogs/shepherd/shepherd_24.png";
		$owner_id =  $topic_user_pic[0]['User']['id'];
		$owner_name =  $topic_user_pic[0]['User']['username'];
        }
        else{
                $owner_avator = "/img/avator/dogs/shepherd/shepherd_24.png";
                $owner_id =  0;
                $owner_name = "unknown";
        }


///////////////////////////////////////////////////
////////////////    TOPIC   ///////////////////////
///////////////////////////////////////////////////
echo "<div class='row' style='margin-top:30px;margin-bottom:50px;'>";
	echo "<div class='span2'>";
		echo "<div class='topic_pic'>".$this->html->image($topics[0]['Mastercategory']['url'])."</div>";
	echo "</div>";
	echo "<div class='span10'>";
		echo "<div class='row'>";
		echo "<div class='topic'>";
			echo "<div class='span10'>";
				echo "<div class='topic_title'>".h($topics[0]['Topic']['name'])."</div>";
			echo "</div>";
			echo "<div class='span10'>";
				//LIKE Button
				echo "<div class='topic_social'>".$this->Facebook->like(array('layout'=>'button_count'))."</div>";
			echo "</div>";
			echo "<div class='span10'>";
				echo "<div class='topic_body'>".h($topics[0]['Topic']['description'])."</div>";
			echo "</div>";
			echo "<div class='span10'>";
				echo "<div style='text-align: right'>".$this->html->image($owner_avator)." ".$owner_name."</div>";
			echo "</div>";
		echo "</div>";
		echo "</div>";
        echo "</div>";
echo "</div>";



//////////////////////////////////////////////////
//////////    CONTENTS      //////////////////////
//////////////////////////////////////////////////
echo "<div class='row'>";
echo "<div style='text-align:left'>";
	echo "<div class='span10'>";
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
			echo "<div>".$this->Html->image($simg_url)."</div>";
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
		echo "<p>".h($contents_array[1])."</p>";
		echo "<small><cite title='".h($contents_array[0])."'><a href='".h($contents_array[0])."' target='_'>".h($contents_array[0])."</a></cite></small>";
		echo "</blockquote>";
		echo "<div style='padding-left:10px; margin-bottom:10px'>".h($contents_array[2])."</div>";
	}
			
}
	echo "</div>";
	echo "<div class='span2'>";
		 //"put right column contents here!!";
		echo "<div style='text-aligh:center;'>";
			echo "<a href=\"http://www.jdoqocy.com/click-6439315-11136322\" target=\"_blank\">";
			echo "<img src=\"http://www.ftjcfx.com/image-6439315-11136322\" width=\"160\" height=\"600\" alt=\"InterNations.org\" border=\"0\"/></a>";
//echo "<a href=\"http://www.kqzyfj.com/click-6439315-11136360\" target=\"_blank\">";
//echo "<img src=\"http://www.awltovhc.com/image-6439315-11136360\" width=\"125\" height=\"125\" alt=\"InterNations.org\" border=\"0\"/></a>";
		echo "</div>";

		echo "<div style='margin-top:25px;'><h4>Related Topics</h4></div>";
		foreach($ranking as $ranking_array){
			foreach($ranking_array as $key=>$rankingtitle){
				echo "<div class='relatedtopic'>";
					echo "<a href='/Topics/show_topic/topicid:$key'>$rankingtitle</a>";
				echo "</div>";
			}
		}

	echo "</div>";

echo "<BR>";
echo "<div class='span12'>";
//LIKE Button
$tt = $this->Html->url('/controller/action/', true);
echo $tt;
echo "<a href='https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fparse.com' target='_blank'> Share on Facebook </a>";
echo "</div>";



/*
	// Tags
	echo "<div class='span12'>";
		echo "<h3>Tags</h3>";
		foreach($tag_info as $tinfo){
			echo "$tinfo, ";
		}
	echo "</div>";
*/
	//Comment
?>
	<div class='span12'>
	<h3  style="margin:50px 0 0 0;">Comments</h3>
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
<?php
echo "</div>";
echo "</div>";
?>
