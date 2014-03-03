<?php
class AdministrationsController extends AppController {
        var $name = 'Administrations';
        var $helpers = array('Html', 'Session', 'Form', 'Facebook.Facebook');
        var $layout = "home";
        var $uses = array('User', 'Topic', 'Tag');

        function beforeFilter() {
                //Bypass auth check
                //$this->Auth->allow('*');
        }

        function index() {
                $me_array = $this->Session->read('Auth.User');
		$me = $me_array['id'];
$me=true;

                if(!empty($me)){
			// get topic 100 list
			$topic_query = "select id, name, modified from topics where checked=0 and deleted=0 and hide=0 limit 0,100";
			$topic_array = $this->Topic->query($topic_query);
			$this->set('topics', $topic_array);

			
                }
                else{
			$this->set('topics', NULL);
                }
       }


	function content_check(){
		//get value from checked item
		$contentid = $_REQUEST['content_check'];
		//value is like this type/id ex. comment/3, topic/2
		//split value [0]=>type  [1]=>id number
		$content_array = split("/",$contentid);


/*
		if($content_array[0]=="comment"){
			$check_query = "update comments set checked=1 where id='".$content_array[1]."'";
			$this->Comment->query($check_query);
		}
		elseif($content_array[0]=="topic"){
			$check_query = "update topics set checked=1 where id='".$content_array[1]."'";
			$this->Topic->query($check_query);
		}
*/


		$this->redirect('/Administrations/');
	}


	function topic_detail(){
		// default query condition
		$conditions = array();


//$this->requestAction('/Topics/create/topicid:150',array('return'));



		// get topic detail id
		if(!empty($this->params['named']['topicid'])){
			$detail_id =  $this->params['named']['topicid'];
			$conditions['Topic.id'] = $detail_id;
		}

		/// get list of topic
		$params = array(
			'conditions' => $conditions,
			'order' => array('created ASC')
		);
		$topic_array = $this->Topic->find('all', $params);


/*
		$item_array=array();
		if(!empty($topic_array)){
			$item_array['id']=$topic_array[0]['Topic']['id'];
			$item_array['userid']=$topic_array[0]['Topic']['userid'];
			$item_array['title']=$topic_array[0]['Topic']['title'];
			$item_array['body']=$topic_array[0]['Topic']['body'];
			$item_array['category']=$topic_array[0]['Topic']['category'];
			$item_array['hide']=$topic_array[0]['Topic']['hide'];
			$item_array['deleted']=$topic_array[0]['Topic']['deleted'];
		}else{
			$item_array['id']="";
			$item_array['userid']="";
			$item_array['title']="";
			$item_array['body']="";
			$item_array['category']="";
			$item_array['hide']="";
			$item_array['deleted']="";
		}
		$this->set('item_array', $item_array);
*/

	}










/*

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
*/


}
?>
