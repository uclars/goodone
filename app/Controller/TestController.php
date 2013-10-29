<?php
class TestController extends AppController {

        public $name = 'Test';
        var $helpers = array('Html', 'Form', 'Session', 'Facebook.Facebook');
	var $layout = 'test';
        public $uses = array('Topic','Content','Title','Comment','User','Disqus.DisqusPost');

        function beforeFilter() {
	}


/////////////////////////////////////////////////////////////
/////////  Create Topics ////////////////////////////////////
////////////////////////////////////////////////////////////
	function create(){
debug($this->data);
	}
}
?>
