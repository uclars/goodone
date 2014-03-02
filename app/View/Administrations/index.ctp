<div class="row">
	<div class="span9">
<?php foreach($topics as $topic){ ?>
		<div class="row-fluid">
			<div class="span1">
				<?php echo $this->Html->image($topic['Mastercategory']['url'], array('width'=>'48px')); ?>
			</div>
			<div class="span11">
				<?php echo "<a href='/Topics/show_topic/topicid:".h($topic['Topic']['id'])."'><h4>".h($topic['Topic']['name'])."</h4></a>"; ?>
				<?php echo "<p>".h($topic['Topic']['description'])."</p>"; ?>
			</div>
			<div class="span12" style="border-bottom: 2px solid #ddd; margin-bottom:10px"></div>
		</div>
<?php } ?>
	</div>
	<div class="span3" style="display:table-cell; text-align:center;">


	</div>
</div>
<?php

?>
