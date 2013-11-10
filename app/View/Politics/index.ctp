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



/*
echo "<PRE>";
var_dump($topics);
echo "</PRE>";
*/



/*
echo "<div class='comment'>";
if(!empty($topics)){
*/







/*
        echo "<div class='comment_pic'>";
  //              echo $html->image($hottopic['Mastercategories']['url']);
        echo "</div>";
        echo "<div class='topic_body'>";
  //              echo $html->link($hottopic['Topic']['title'], array('controller'=>'topics', 'action'=>'show_topic', 'topicid'=>$hottopic['Topic']['id']))." ";









?>
                <div class='comment_following'>
                        follower
                        <span class='num'>
<?php

                                ///if there is number, show the nnum. if there is no number, show 0
                                if(!empty($hottopic['Followingtopicnumbers']['count'])){
//                                        echo h($hottopic['Followingtopicnumbers']['count']);
                                }
                                else{
                                        echo "0";
                                }
?>
                        </span>
                                 | comments
                        <span class='num'>
<?php
                                ///if there is number, show the nnum. if there is no number, show 0
                                if(!empty($hottopic['Commenttopicnumbers']['Count'])){
//                                        echo h($hottopic['Commenttopicnumbers']['Count']);
                                }
                                else{
                                        echo "0";
                                }

?>
                        </span>
                </div>
        </div>
        <div style='clear:both'></div>
        <br />
<?php
}//end of foreach
echo "</div>";



echo $paginator->prev('<< '.__('previous', true), array(), ' ', array('class'=>'disabled'));
echo $paginator->numbers();
echo $paginator->next(__('next', true).' >>', array(), ' ', array('class'=>'disabled'));

echo "<BR />";
}//end of if


*/


?>
