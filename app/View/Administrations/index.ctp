<div class="row">
	<div class="span9">
		<div class="row-fluid">
			<div class="span1">
			</div>
			<div class="span11">


<FORM method='POST' action='/Administrations/content_check'>
<input type='submit' value='SUBMIT'>
<br /><br />
<table class="table table-striped table-condensed table-hover">
  <thead>
    <tr>
      <th width="10%">Topic #</th>
      <th>Topic Name</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td width="10%">1</td>
      <td>Test Name</td>
      <td>2014/3/2</td>
    </tr>
    <tr>
      <td width="10%">2</td>
      <td>Test Name2</td>
      <td>2014/3/2</td>
    </tr>
    <tr>
      <td width="10%">3</td>
      <td>Test Name3</td>
      <td>2014/3/2</td>
    </tr>
  </tbody>
</table>




<TABLE frame='below' rules='rows'>
<TR>
<TD>a</TD><TD>b</TD>
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
                                echo "<TD style='border-width: 0px;'>".$this->Html->link($topicdata['topics']['name'],array('controller'=>'Administrations','action'=>'topic_detail','topicid'=>$topicdata['topics']['id']))."</TD>";
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
                                echo "<TD style='border-width: 0px;'>".$this->Html->link($comdata['comments']['body'],array('controller'=>'administrations', 'action'=>'comment_detail', 'commentid'=>$comdata['comments']['id']))."</TD>";
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
