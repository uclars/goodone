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
      <th width="10%">Check</th>
      <th>Topic Name</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach($topics as $topicdata){
	echo "<tr>";
	echo "<td width='10%'><input type='radio' name='content_check' value='topic/".$topicdata['topics']['id']."'></td>";
	echo "<td>".$this->Html->link($topicdata['topics']['name'],array('controller'=>'Administrations','action'=>'topic_detail','topicid'=>$topicdata['topics']['id']))."</td>";
	echo "<td>".$topicdata['topics']['modified']."</td>";
	echo "</tr>";
}
?>
  </tbody>
</table>




<input type='submit' value='SUBMIT'>
</FORM>
			</div>
			<div class="span12" style="border-bottom: 2px solid #ddd; margin-bottom:10px"></div>
		</div>
	</div>
	<div class="span3" style="display:table-cell; text-align:center;">


	</div>
</div>
