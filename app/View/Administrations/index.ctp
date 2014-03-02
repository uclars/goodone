<div class="row">
	<div class="span9">
		<div class="row-fluid">
			<div class="span1">
			</div>
			<div class="span11">


<FORM method='POST' action='/Administrations/content_check'>
<input type='submit' value='SUBMIT'>
<br /><br />
<TABLE frame='below' rules='rows'>
<TR>
<TD><?php echo $html->link('TOPIC','/administrations/topic'); ?></TD><TD><?php echo $html->link('COMMENT','/administrations/comment'); ?></TD>
</TR>
<?php
echo "<TR>";
        //// TOPIC  ////
        echo "<TD width=50%>";
                echo "<TABLE>";
foreach($topics as $topicdata){
                        echo "<TR valign='TOP'>";
                                echo "<TD style='border-width: 0px;'><input type='radio' name='content_check' value='topic/".$topicdata['topics']['id']."'>".$topicdata['topics']['id']."</TD>";
                                echo "<TD style='border-width: 0px;'> </TD>";
                                echo "<TD style='border-width: 0px;'>".$html->link($topicdata['topics']['title'],array('controller'=>'administrations','action'=>'topic_detail','topicid'=>$topicdata['topics']['id']))."</TD>";
                                echo "<TD style='border-width: 0px;'>".$topicdata['topics']['modified']."</TD>";
                        echo "</TR>";
}
                echo "</TABLE>";
        echo "</TD>";
        ////  COMMENTS  ////
        echo "<TD width=50%>";
                echo "<TABLE>";
foreach($comments as $comdata){
                        echo "<TR valign='TOP'>";
                                echo "<TD style='border-width: 0px;'><input type='radio' name='content_check' value='comment/".$comdata['comments']['id']."'>".$comdata['comments']['id']."</TD>";
                                echo "<TD style='border-width: 0px;'> </TD>";
                                echo "<TD style='border-width: 0px;'>".$html->link($comdata['comments']['body'],array('controller'=>'administrations', 'action'=>'comment_detail', 'commentid'=>$comdata['comments']['id']))."</TD>";
                                echo "<TD style='border-width: 0px;'>".$comdata['comments']['modified']."</TD>";
                        echo "</TR>";
}
                echo "</TABLE>";
        echo "</TD>";
?>
</TR>
</TABLE>
<input type='submit' value='SUBMIT'>
</FORM>



			</div>
			<div class="span12" style="border-bottom: 2px solid #ddd; margin-bottom:10px"></div>
		</div>
	</div>
	<div class="span3" style="display:table-cell; text-align:center;">


	</div>
</div>
<?php

?>
