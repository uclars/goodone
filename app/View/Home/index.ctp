<?php foreach($topics as $topic){ ?>
<div class="row"> 
	<br>
	<div class="col-md-2 col-sm-3 text-center">
		<?php echo "<a class='story-img' href='/Topics/show_topic/topicid:".h($topic['Topic']['id'])."'>";?>
			<?php echo $this->Html->image($topic['Mastercategory']['url'], array('width'=>'48px')); ?>
		</a>
	</div>
	<div class="col-md-10 col-sm-9">
		<?php echo "<a href='/Topics/show_topic/topicid:".h($topic['Topic']['id'])."'><h3>".h($topic['Topic']['name'])."</h3></a>"; ?>
		<div class="row">
			<div class="col-xs-9">
				<?php echo "<p>".h($topic['Topic']['description'])."</p>"; ?>
				<p class="lead"><button class="btn btn-default">Read More</button></p>
				<p class="pull-right"><span class="label label-default">keyword</span> <span class="label label-default">tag</span> <span class="label label-default">post</span></p>
				<ul class="list-inline"><li><a href="#">2 Days Ago</a></li><li><a href="#"><i class="glyphicon glyphicon-comment"></i> 4 Comments</a></li><li><a href="#"><i class="glyphicon glyphicon-share"></i> 34 Shares</a></li></ul>
			</div>
			<div class="col-xs-3"></div>
		</div>
		<br><br>
	</div>
</div>
<?php } ?>
