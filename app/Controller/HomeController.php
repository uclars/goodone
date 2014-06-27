<?php
class HomeController extends AppController {
        var $name = 'Home';
        var $helpers = array('Html', 'Session', 'Form', 'Facebook.Facebook');
        var $layout = "home";
//        var $components = array('Auth','Facebook.Connect', 'Session', 'Blacklists');
//        var $components = array('Auth','Session','Facebook.Connect');
	public $components = array(
		'Session',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email')
				)
			),
		'authorize' => 'Controller'),
		'Facebook.Connect' => array('model' => 'User')
	);
        var $uses = array('User', 'Topic', 'Comment', 'Loginlog', 'Blacklist','Tag');

        function beforeFilter() {
                //Call Parent Class
                parent::beforeFilter();

                //Bypass auth check
                $this->Auth->allow('*');


		//Facebook
//		CakePlugin::load('Facebook');

                //Tutorial
		//$this->_checkTutorial();

		//Check Blacklist users
	//	$this->Blacklists->checkBlacklist();

        }


        function _checkTutorial(){
                $user_array = $this->Session->read('Auth.User');
                $t_phase = $this->Session->read('phase');
                $t_finish = $this->Session->read('t_finish');

                /// if you don't have tutorial phase in the session, call SQL
                if(empty($t_phase)){
                        // if anonymous user, donot redirect
                        if(!empty($user_array)){
                                $current_tutorial = $user_array['tutorial'];
                                // if user has already finished tutorial, donot redirect
                                if($current_tutorial!=0 and $t_finish != 1){
                                        $this->Session->write('phase', $current_tutorial);
                                        $this->redirect(array("controller" => "tutorials", "action" => "phase", $current_tutorial));
                                }
                        }
                        return;
                }
                else{
                        $this->redirect(array("controller" => "tutorials", "action" => "phase", $t_phase));
                }
        }


        //### ホーム ###
        function index() {
                $isAuthenticated = $this->Session->read('Auth.User');
                //$isInvited = $this->Session->read('invite');
                $isInvited = TRUE;

                if(!empty($isAuthenticated) || !empty($isInvited)){

/*
			//For new registered User, get id(facebook info in DB, but no id in DB)
			if(empty($isAuthenticated['id']) AND !empty($isAuthenticated)){
				//new user redirect to the welcome page
				return $this->redirect(array("controller" => "Users", "action" => "register"));
				//new user don't have id in the first view, so refresh the page to get id.
				//return $this->redirect($this->request->here);
			}
*/

			//set user info to the view
			$this->set('auth', $isAuthenticated);

			//Use dynamic unbind in controller to redule SQL Query in the HOME Controller which doesn't need title queries
			//http://hijiriworld.com/web/cakephp-bindmodel/
			$this->Topic->UnbindModel(array('hasMany' => array('Title','Content','Comment')));
			$this->Topic->UnbindModel(array('hasAndBelongsToMany' => array('Tag')));

			//get all the contents
			// get date (today and a week from today)
			$start_date = gmdate("Y/m/d",strtotime("-100 week"));
			$end_date = gmdate("Y/m/d H:i:s");
			//$tcondition = array('Topic.deleted'=>0, 'Topic.hide'=>0, 'Topic.created >=' => $start_date, 'Topic.created <=' => $end_date);
			$tcondition = array('Topic.deleted'=>0, 'Topic.hide'=>0, 'Topic.created >=' => $start_date, 'Topic.created <=' => $end_date);
			$topics = $this->Topic->find('all',array('conditions' => $tcondition, 'order' => array('created DESC')));
			$this->set('topics', $topics);



/*
echo "<PRE>";
var_dump($topics);
echo "</PRE>";
*/

/*
                        //set user info to the view
                        $this->set('auth', $this->Session->read('Auth.User'));

                        //paginate
                        $this->Comment->recursive = 0;

                        // get date (today and a week from today)
                        $start_date = gmdate("Y/m/d",strtotime("-20 week"));
                        $end_date = gmdate("Y/m/d H:i:s");
                        $tcondition = array('Topic.deleted'=>0, 'Topic.hide'=>0, 'Topic.created >=' => $start_date, 'Topic.created <=' => $end_date);
			$this->paginate['conditions']=$tcondition;
                        $this->paginate['order']='Followingtopicnumbers.count desc';
                        $this->paginate['limit']=300;
                        $this->set('topics',$this->paginate('Topic'));
*/
                }
                else{
			$this->set('topics', NULL);
                }
       }


        function newtopics(){

                $this->Topic->recursive = 0;
                $tcondition = array(array('Topic.deleted'=>0, 'Topic.hide'=>0));
                $this->paginate['conditions']=$tcondition;
                $this->paginate['order']='created desc';
                $this->paginate['limit']=300;
                $this->set('topics',$this->paginate('Topic'));

//              $this->getRanking();
        }


        function mytopics(){

                //put the posts the user following in array
                $following_topic_data = $this->requestAction('followings/following_topic');
                $i=0; //numbers of 'or'
                $j=0; //numbers of 'or' and 'and'


                if($following_topic_data){
                        foreach($following_topic_data as $fpdata){
                                $condition[$j]['or'][$i] = array('Topic.id'=>$fpdata['Followingtopics']['followingtopicid'], 'Topic.hide'=>0, 'Topic.deleted'=>0);
                                $i++;
                        }
                }
                else{ //follow no topics
                        $condition = array(array('Topic.id'=>0));
                }

                $this->paginate['conditions']=$condition;
                $this->paginate['order']='created desc';
                $this->paginate['limit']=300;
                $this->set('mytopics',$this->paginate('Topic'));

//               $this->getRanking();
        }



}
?>
