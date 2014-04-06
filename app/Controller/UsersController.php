<?php
class UsersController extends AppController
{
	var $components = array('Auth', 'Facebook.Connect', 'Session');
	var $name = 'Users';
	//var $helpers = array('Html', 'Form', 'NiceNumber', 'Session');
	var $helpers = array('Html', 'Form', 'Session','Facebook.Facebook');
	var $layout = "user";
	//var $uses = array('User', 'Topic', 'Comment');
	var $uses = array('User', 'Topic', 'Comment');


	function beforeFilter() {
		parent::beforeFilter(); 
		/*$this->Auth->allow('add', 'login');*/
		$this->Auth->allow('*');

		$this->Auth->autoRedirect = false; //自動リダイレクトを無効
	}

	function login() {
		/// get topic title for facebook like display on facebook wall
		$topic_title = $this->Session->read('title');
		$this->set('title',$topic_title);

		$this->set('error', false);
	}

	function facebooklogin() {
		$this->Session->write('fauth', TRUE);

		$this->redirect('/');
	}


	function logout() {

		$this->Auth->logout();

		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}
		$this->Session->destroy();

		$this->redirect('/');
	}

	function register() {
		$myarray = $this->Session->read('Auth.User');
		$this->set('me_array',$myarray);

		$fid = $myarray['facebook_id'];
		$avatorimg_array = $this->User->find('first',array('conditions'=>array('facebook_id'=>$fid)));
		$avatorimg = $avatorimg_array['Masteravators'];
		if(!empty($avatorimg)){
			$this->set('me_image',$avatorimg);
		}else{
			$this->set('me_image',"/img/avator/dogs/dingo/dingo_192.png");
		}



/*
		/// haven't input a nickname
		if(!empty($this->params['pass'][0])) {
			$this->set('userid', $this->params['pass'][0]);
			return;
		}
		$phase_num = $this->Session->read('phase');
		$first_time = $this->Session->read('firsttime');
		if(!empty($first_time)){
			$this->Session->write('phase', 10);
			 $this->redirect(array("controller" => "tutorials", "action" => "phase", 10));
		}
		else{
		}
*/
	}

	function add() {
		if($this->Auth->user()){
			$this->set('msg', 'Already registered');
			$this->render('/errors/custom');
		}
		if(!empty($this->data)) {
			//input check
			$data = array();
			$data['User']['username'] = $this->data['User']['username'];
			$data['User']['email'] = $this->data['User']['email'];
			$data['User']['password_new'] = $this->data['User']['password_new'];
			$data['User']['password_chk'] = $this->data['User']['password_chk'];
			$this->User->create($data);
			if(!($this->User->validates())){
				$this->Session->setFlash('Something wrong!');
			}
			else{
				unset($data['User']['password_new']);
				unset($data['User']['password_chk']);
				$data['User']['password'] = $this->Auth->password($this->data['User']['password_new']);
				$this->User->save($data);
				//$this->redirect('/');
			}
		}
	}



	function show_users(){
		$id = $this->params['named']['id'];
		$me_array = $this->Session->read('Auth.User');
		$me = $me_array['id'];
		$this->set('username', $me_array['username']);

		if(!is_null($me)){
			if($id==$me){
				$this->User->recursive = 2;
				$t_user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
				$this->set('target_user', $t_user);
			}
			else{
				$this->redirect($this->referer());
			}
		}
		else{
			$this->redirect("/");
		}


		/// get creating/created topics ///
		$topic_list = $this->_getCreateTopics($id);
		$this->set('topic_list', $topic_list);


		/*/// get Following info  ///
		$this->User->recursive=0;
		$user_list = $this->User->find('all');

		$follower_list = array();
		$my_follower_list = array();

		// get follower's list for the user you are watching, and your followers
		$follower_list = $this->_getFollowerList($id);
		$my_follower_list = $this->_getFollowerList($me);

		$this->set('user_list', $user_list);
		$this->set('follower_list', $follower_list);
		$this->set('my_follower_list', $my_follower_list);
		///                   ////
*/


		//$topic_array = $this->requestAction("topics/getFollowingTopicList/$id"); //get following topics

		//$topic_array = $this->requestAction(array(
		//	'controller' => 'followings',
		//	'action' => 'following_topic'
		//));
//		$topic_array = $this->_getFollowingTopics($id);
//		$this->set('following_topics', $topic_array);


/*
echo("<PRE>");
var_dump($topic_array);
echo("</PRE>");
exit;
*/



/*
		/// get target user topics   ///
		$target_topics = array();
		if(!empty($id)){
			$target_topics = $this->_getTopics($id);
		}
		$this->set('target_topics', $target_topics);
		///                  ///

		/// get target user comments ///
		$target_comments = array();
		if(!empty($id)){
			$target_comments = $this->_getComments($id);
		}
		$this->set('target_comments', $target_comments);
*/
	}

	function _getCreateTopics($id){
//$id = 100000000000000;
		$topic_array = array();
		App::import('Model', 'Topic');
		$this->Topic = new Topic();
		$conditions = array('Topic.user_id' => $id, 'Topic.deleted' => 0);
		$fields = array();
		$order = array('Topic.id DESC');
		$topic_array = $this->Topic->find('all', array('conditions' => $conditions, 'fields'=>$fields, 'order' => $order));

		return $topic_array;
	}










	function _getFollowingTopics($id){
		$topic_array = array(); 
		App::import('Model', 'Followingtopics');
		$this->Followingtopics = new Followingtopics();
		$conditions = array('Followingtopics.userid' => $id, 'Followingtopics.deleted' => 0, 'NOT'=>array('Followingtopics.followingtopicid'=>NULL));
		//$fields = array('DISTINCT FollowingTopics.following_topic_id');
		$fields = array();
		$order = array('Followingtopics.id DESC');
		$following_topic = $this->Followingtopics->find('all', array('conditions' => $conditions, 'fields'=>$fields, 'order' => $order));
		

		return $following_topic;

/*
echo "<PRE>";
var_dump($following_topic);
echo "</PRE>";
exit;
*/

	}

	function _getFollowerList($id){
		//put the followers who are followed by clicked id in array
		$follower_list = array();
		$follower_data = $this->requestAction(array(
				'controller' => 'followings', 
				'action' => 'following_user'
			), array('userid' => $id));
	        $i=0;



/*
echo("<PRE>");
var_dump($follower_data);
echo("</PRE>");
exit;
*/


		if(!empty($follower_data)){
			foreach($follower_data as $fdata){
				$follower_list[$i]=$fdata['FollowingUsers']['following_user_id'];
				$i++;
       		 	}
		}

		return $follower_list;
	}   

	function _getTopics($id){
		$params = array(
			'conditions' => array('Topic.userid'=>$id, 'Topic.deleted'=>0, 'Topic.hide'=>0),
		);
		$target_topic = $this->Topic->find('all', $params);

		return $target_topic;
	}

	function _getComments($id){
		$params = array(
			'conditions' => array('Comment.userid'=>$id, 'Comment.deleted'=>0),
			'order' => array('created DESC')
		);
		$target_comment = $this->Comment->find('all', $params);

		return $target_comment;
	}

	function changeName(){
		$this->request->data;
		if ($this->request->is('ajax')) {
			// Configure for ajax
			Configure::write('debug', 0);
			$this->autoRender = false;
			// Output
			$newname = $this->data['newname'];
                }

		$myarray = $this->Session->read('Auth.User');
		$fid = $myarray['facebook_id'];
		//update the DB
		$update_sql = "";
		//$update_sql = "Update users set 'username' = '".$newname."' Where 'facebook_id' = '".$fid."';";
		$update_sql = "Update users set username='".$newname."' Where facebook_id='".$fid."';";
		$this->User->query($update_sql);
		echo $newname;
	}
}
?>
