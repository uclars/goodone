<div class="row"> 
	<div  class="col-md-12 col-sm-12">
		<h1 class="page-header"><?php echo $categoryname['Mastercategory']['name']; ?> <i class="glyphicon glyphicon-list-alt"></i></h1>
	</div>
</div>
<?php foreach($topics as $topic){ ?>
<div class="row">
	<div class="col-md-2 col-sm-3 text-center">
<?php
		echo "<a class='story-img' href='/Topics/show_topic/topicid:".h($topic['Topic']['id'])."'>";
		if(!empty($topic['Topic']['topic_image'])){ //If there is a image for the topic, show it, otherwise show the category image 
			//echo $this->Html->image($topic['Topic']['topic_image'], array('width'=>'48px'));
			echo $this->Html->image($topic['Topic']['topic_image'], array('width'=>'96px'));
		}else{
			echo $this->Html->image($topic['Mastercategory']['url'], array('width'=>'48px'));
		}
		echo "</a>";
?>
	</div>
	<div class="col-md-10 col-sm-9">
		<?php echo "<a href='/Topics/show_topic/topicid:".h($topic['Topic']['id'])."'><h3>".h($topic['Topic']['name'])."</h3></a>"; ?>
		<div class="row">
			<div class="col-xs-9">
				<?php echo "<p>".h($topic['Topic']['description'])."</p>"; ?>
				<p class="lead">
					<?php echo "<a href='/Topics/show_topic/topicid:".h($topic['Topic']['id'])."' class='btn btn-default btn-sm' role='button'>more <i class='fa fa-play-circle-o'></i></a>"; ?>
				</p>
			</div>
		</div>
	</div>
</div>
<hr>
<?php } ?>
