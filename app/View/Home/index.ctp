<?php foreach($topics as $topic){ ?>
<div class="row"> 
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
			</div>
		</div>
	</div>
</div>
<hr>
<?php } ?>
