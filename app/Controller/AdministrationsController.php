<?php
class AdministrationsController extends AppController {
        var $name = 'Administrations';
        var $helpers = array('Html', 'Session', 'Form', 'Facebook.Facebook');
        var $layout = "home";
        var $uses = array('User', 'Topic', 'Tag');

        function beforeFilter() {
                //Bypass auth check
                $this->Auth->allow('*');
        }

        function index() {
                $me_array = $this->Session->read('Auth.User');
		$me = $me_array['id'];

                if(!empty($me))){
			// get topic 100 list
			$topic_query = "select id, title, modified from topics where checked=0 and deleted=0 and hide=0 limit 0,100";
			$topic_array = $this->Topic->query($topic_query);
			$this->set('topics', $topic_array);

			
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
