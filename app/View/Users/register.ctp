<?php
/// Welcome Page ////
echo "<div class='row'>";
	echo "<div class='span12' style='font-size:300%; text-align:center; color:#333; line-height:110%; margin-bottom:25px'>";
		echo "<p>Welcome to Good One</p>";
		echo "<p>Leave your <span style='color:#e47a1a;'>packed knowledge</span> on record!</p>";
	echo "</div>";
	echo "<div class='span12' style='text-align:center; line-height:100%; margin-bottom:25px;'>";
		echo "<p>Do you leave the info somewhere when you search something? If no, leave them on us.</p>";
		echo "<p>You can make the most of the info and time from the searches, and morever, other people can reuse your valuable info.</p>";
		echo "<p>Thanks for registering. Your packed knowledge helps people who are looking for good contetns.</p>";
	echo "</div>";
	echo "<div class='row'>";
		echo "<div class='span2'></div>";
		echo "<div class='span8' style='text-align:center; line-height:100%; margin-bottom:25px;'>";
			echo "<div class='row'>";
				echo "<div class='span2' style='text-align:center; line-height:100%; margin-bottom:25px;'>";
					echo $this->HTML->image($me_image['url128']);
				echo "</div>";
				echo "<div class='span6' style='text-align:left; line-height:120%; display:table-cell; vertical-align:middle; margin-bottom:25px;'>";	
					echo "<div class='hero-unit'>";
						echo "Hi I'm your avator dog. I'm ".h($me_image['name']).".";
						echo "<p>Your name is shown below the box.</p>";
						echo "<p>If you want to change it, click the name.</p>";
					echo "</pre>";
				echo "</div>";
			echo "</div>";
			echo "<div class='span8' style='text-align:center; line-height:100%; margin-bottom:25px;'>";
				echo "<pre>".$this->HTML->link("$me_array['username'] is fine.",'#',array('id'=>'changenamelink'))."</pre>";
				echo "<span id='gohomelink'><pre>".$this->HTML->link('No change. Go Top Page','/',array('id'=>'gohomebutton'))."</pre></span>";
				echo "<div id='changename' style='display:none'>";
					echo "<span style='margin-right:30px;'><input id='newname' type='text'></span>";
					echo $this->form->button('Change Name', array('class'=>'submitclass',"id"=>"changenamebutton","name"=>"changenamebutton"));
				echo "</div>";
				echo "<div id='chngenameresult' style='display:none'>";
					echo "<span id='chanednewname' style='margin-right:30px;'>New Name is saved!</span>";
					echo $this->form->button('OK', array('class'=>'submitclass',"id"=>"newnamesaved"));
				echo "</div>";
			echo "</div>";
		echo "</div>";
		echo "<div class='span2'></div>";
	echo "</div>";
echo "</div>";
?>
<script type="text/javascript">
$('#changenamelink').live('click',function(e)
{
	$("#gohomelink").hide();
	$("#changename").show('slow');
	return false;
});
</script>
<script type="text/javascript">
$('#changenamebutton').live('click',function(e)
{
	$.post('/Users/changeName/', {newname: $('#newname').val()}, function(res){
		$('#chngenameresult').show('slow');
		$('#changename').hide('slow');
		$('#changenamelink').text(res);

		e.preventDefault();
        });

});
$('#newnamesaved').live('click',function(e)
{
      window.location.href = "/";
});
</script>
