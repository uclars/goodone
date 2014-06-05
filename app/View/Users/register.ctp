<div class="jumbotron hero-spacer">
	<h1>Leave your <span style='color:#e47a1a;'>packed knowledge</span> on record!</h1>
	<p>Do you leave the info somewhere when you search something? If no, leave them on us.</p>
	<p>You can make the most of the info and time from the searches, and morever, other people can reuse your valuable info.</p>
	<p>Thanks for registering. Your packed knowledge helps people who are looking for good contetns.</p>
</div>

	<!-- START THE FEATURETTES -->
	<hr class="featurette-divider">

	<div class="featurette" id="intro">
		<img class="featurette-image img-circle img-responsive pull-right" src="<?php echo $me_image['url128']; ?>">
		<h2 class="featurette-heading">Hi, 
			<span class="text-muted"><?php echo h($me_array['username']); ?></span>
		</h2>
		<p class="lead">I'm your avator dog. I'm <?php echo h($me_image['name'])?>.</p>
		<p class="lead">If you don't want to use this name, you can change it.</p>
	</div>
	<hr class="featurette-divider">
	<!-- END THE FEATURETTES -->

<?php
	$register_bottom_words = null;
	$register_bottom_words = "\"".$me_array['username']."\""." is fine. Register me with this name.";
	echo "<pre>".$this->HTML->link('Change My Name.','#',array('id'=>'changenamelink'))."</pre>";
	echo "<span id='gohomelink'><pre>".$this->HTML->link($register_bottom_words,'/',array('id'=>'gohomebutton'))."</pre></span>";
	echo "<div id='changename' style='display:none'>";
		echo "<span style='margin-right:30px;'><input id='newname' type='text'></span>";
		echo $this->form->button('Change Name', array('class'=>'submitclass',"id"=>"changenamebutton","name"=>"changenamebutton"));
	echo "</div>";
	echo "<div id='chngenameresult' style='display:none'>";
		echo "<span id='chanednewname' style='margin-right:30px;'>New Name is saved!</span>";
		echo $this->form->button('OK', array('class'=>'submitclass',"id"=>"newnamesaved"));
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
