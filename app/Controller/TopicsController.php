<?php
class TopicsController extends AppController {

        //var $components = array('Auth', 'Facebook.Connect', 'Session', 'Commentusernumber');
	//var $components = array('Auth', 'Facebook.Connect', 'Session','RequestHandler');
        public $name = 'Topics';
//        var $helpers = array('Html', 'Form', 'NiceNumber', 'Session');
        var $helpers = array('Html', 'Form', 'Session', 'Facebook.Facebook');
	var $layout = 'topic';
	public $uses = array('Topic','Content','Title','Comment','Tag','TagsTopic','User','Disqus.DisqusPost');
//        var $uses = array('Topic', 'User', 'Comment','Commentgood', 'Mastercategory','Relatedtopic','Task','Content');
        //var $components = array('Logincheck');
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


        function beforeFilter() {
		CakePlugin::load('Facebook');
		//CakePlugin::load('Disqus');

                //show the page without login
                $this->Auth->allow('*');
	}


	//Check hide/delete topic
	function _checkInvisibleTopic(){
		
	}


/////////////////////////////////////////////////////////////
/////////    Show Topics ////////////////////////////////////
////////////////////////////////////////////////////////////
	function show_topic(){
		$isAuthenticated = $this->Session->read('Auth.User');
		if(!empty($isAuthenticated)){
			if(empty($isAuthenticated['id'])){
				//if $auth[id] doesn't have id value, redirect to get id
				//this happens just after the creation of a user
				$this->Redirect(Router::url());
			}
		}
		$isInvited = TRUE;
		//set user info to the view
		$this->set('auth', $isAuthenticated);

		$topic_id = $this->params['named']['topicid'];
		//Use Containable to reduce the SQL Query
		//http://book.cakephp.org/2.0/en/core-libraries/behaviors/containable.html
		$topic_array = $this->Topic->find('all', array(
			//'conditions' => array('Topic.id' => $topic_id, 'Topic.hide' => 0, 'Topic.deleted' => 0),
			'conditions' => array('Topic.id' => $topic_id, 'Topic.deleted' => 0),
			'contain' => array(
				'Mastercategory',
				'Title.title',
				'Content.content',
				'Comment.comment',
				'Tag.name'
			)
		));

		$show_contents=FALSE;
		//Check if the topic is deleted
		if(empty($topic_array)){
			//if it's deleted topic, redirect
			$this->redirect('/');
		}
		else{
			//Check if the topic is hide
			if($topic_array[0]['Topic']['hide']>0){
				//if the topic is hide and current user is not topic creator, redirect
				if($isAuthenticated['id']!=$topic_array[0]['Topic']['user_id']){
					$this->redirect('/');
				}else{
				//if the current user is the topic crator, show the contents
					$show_contents=TRUE;
				}
			}else{
				//if the topic is not deleted and hide, show the contents
				$show_contents=TRUE;
			}
		}

		if($show_contents){
			//Topic Array for all
			$this->set('topics', $topic_array);

			//Topic Title
			$this->set('topictitle', $topic_array[0]['Topic']['name']);

			//Get User Info
			$topic_array_pic = $this->User->find('all', array('conditions' => array('User.id' => $topic_array[0]['Topic']['user_id']),'recursive' => -2));
			$this->set('topic_user_pic', $topic_array_pic);





/*
echo "<PRE>";
var_dump($topic_array_pic);
//var_dump($topic_array);
echo "</PRE>";
*/




			//get Tags
			$tag_info = $this->_get_tags($topic_array[0]['Tag']);
			$this->set('tag_info', $tag_info);

			//size of items
			$item_num = count($topic_array[0]['Comment']);

			//first contents
			foreach($topic_array as $each_topics){
				//Each Title
				$i=0;
				$title_array=array();
				foreach($each_topics['Title'] as $each_title){
					$title_array[$i]=$each_title;
					$i++;
				}
				//Each Content
				$j=0;
				$content_array=array();
				foreach($each_topics['Content'] as $each_content){
					$content_array[$j]=$each_content;
					$j++;
				}
				//Each Commen
				$t=0;
				$comment_array=array();
				foreach($each_topics['Comment'] as $each_comment){
					$comment_array[$t]=$each_comment;
					$t++;
				}
			}


			//combine the three arrays into one array
			$show_array=array();
			for($l = 0; $l < $item_num; $l++){
				$show_array[$l]=array($title_array[$l]['title'],$content_array[$l]['content'],$comment_array[$l]['comment']);
			}
	
			$this->set('title_for_layout',$topic_array[0]['Topic']['name']); //Topic Title
			$this->set('show_contents',$show_array);
		}else{
			$this->redirect('/');
		}
	}

	function _get_tags($tags_array){
		$tag_name_array = array();

		foreach($tags_array as $tagname){
			array_push($tag_name_array, $tagname['name']);
		}
		return $tag_name_array;
	}


/////////////////////////////////////////////////////////////
/////////  Create Topics ////////////////////////////////////
////////////////////////////////////////////////////////////
	function create(){
		$this->layout = 'topiccreate';

		$me_array = $this->Session->read('Auth.User');
		$me = $me_array['id'];
		$this->set('userid',$me);

		//get the topicid
		$targettopic = $this->here;
		//get the referer to chekc if traffice comes form admin page, otherwise it's direct traffice which is not correct
		$targetreferer = $this->referer();

		//check the user who is the creator of the Topic Or Admin
		$is_admin = $this->_checkAdmin($me);
		$this->set('admin_num',$is_admin);
		$is_correctuser = $this->_checkUser($me, $is_admin, $targettopic, $targetreferer);

		if(empty($is_correctuser) && $is_admin == 0){
			$this->redirect(array('controller'=>'Users','action'=>'show_users','id'=>$me));
		}
		else{
			$result;
			$titleresult;
			$topicid;
			$titleid;
			$newtopicid="";


			$newtopicid=$this->Session->read('new_topicid');


/*
debug($this->params);
debug($this->data);
exit;
*/
			//if edit page, get the contents
			if(!empty($this->params['named']['topicid'])){
				$topicid = $this->params['named']['topicid'];

                                $topic_array = array();
                                $topic_array = $this->Topic->find('all', array(
					'conditions' => array('Topic.id' => $topicid),
/*
					'contain' => array(
						'Mastercategory',
						'Title.title',
						'Content.content',
						'Comment.comment',
						'Tag.name'
					)
*/
				));


                                $edit_result = $this->_get_editcontents($topic_array);
                                $this->set('editing_contents',$edit_result);
                                $this->set('tid',$topicid);

                                $data['id']=$topicid;

				if(isset($this->data) && !empty($this->data))
				{


/*
echo "<PRE>";
var_dump($this->data);
echo "</PRE>";
exit;
*/

					$data['Topic_Title'] = $this->data['Topic_Title'];
					$data['Topic_Category'] = $this->data['Topic_Category'];
					$data['Topic_Description'] = $this->data['Topic_Description'];
					$data['Topic_Check'] = $this->data['Topic_Check'];
					$data['Topic_Userid'] = $this->data['Topic_Userid'];
					$data['Topic_Tag'] = $this->data['Topic_Tag'];
					$data['Topic_Publish'] = $this->data['Topic_Publish'];
					////Get titles, contents, comments from DB
					if(isset($this->data['Content']) && !empty($this->data['Content'])){
						$data['Content']['title'] = $this->data['Content']['title'];
						$data['Content']['content'] = $this->data['Content']['content'];
	
						$commentarr = $this->data['Content']['comment'];
						foreach($data['Content']['title'] as $key => $title)
						{
							$data['Content']['comment'][$key] = $commentarr[$key];
						}
					}

					//update tags
					$tagarr = $this->_make_tagarray($this->data['Topic_Tag']);
					

					$this->_save_data($data,$me,$topicid,$topic_array);
				}

                                //delete topic id session
                                $this->Session->delete('new_topicid');

			////// Create page
			}else{
/*
				if(!empty($newtopicid)){
					$topicid = $newtopicid;
					$topic_array = array();
					$topic_array = $this->Topic->find('all', array('conditions' => array('Topic.id' => $topicid)));
					$edit_result = $this->_get_editcontents($topic_array);

					$this->set('editing_contents',$edit_result);
					$this->set('tid',$topicid);

					$data['id']=$topicid;

					if(isset($this->data) && !empty($this->data))
					{
						$data['Topic_Title'] = $this->data['Topic_Title'];
						$data['Topic_Category'] = $this->data['Topic_Category'];
						$data['Topic_Description'] = $this->data['Topic_Description'];
						$data['Topic_Check'] = $this->data['Topic_Check'];
						$data['Topic_Userid'] = $this->data['Topic_Userid'];
						$data['Topic_Publish'] = $this->data['Topic_Publish'];
						////Get titles, contents, comments from DB
						if(isset($this->data['Content']) && !empty($this->data['Content'])){
							$data['Content']['title'] = $this->data['Content']['title'];
							$data['Content']['content'] = $this->data['Content']['content'];

							$commentarr = $this->data['Content']['comment'];
							foreach($data['Content']['title'] as $key => $title)
							{
								$data['Content']['comment'][$key] = $commentarr[$key];
							}
						}

						//tag 
						$tagarr = $this->_make_tagarray($this->data['Topic_Tag']);

					$this->_save_data($data,$me,$topicid,$topic_array);
					}

					//delete topic id session
					$this->Session->delete('new_topicid');
				}
				else{
*/
					$this->set('tid',"0");

					if(isset($this->data) && !empty($this->data))
					{
						$data['Topic_Title'] = $this->data['Topic_Title'];
						$data['Topic_Category'] = $this->data['Topic_Category'];
						$data['Topic_Description'] = $this->data['Topic_Description'];
						$data['Topic_Check'] = $this->data['Topic_Check'];
						$data['Topic_Userid'] = $this->data['Topic_Userid'];
						$data['Topic_Publish'] = $this->data['Topic_Publish'];
						////Get titles, contents, comments from DB
						if(isset($this->data['Content']) && !empty($this->data['Content'])){
							$data['Content']['title'] = $this->data['Content']['title'];
							$data['Content']['content'] = $this->data['Content']['content'];

							$commentarr = $this->data['Content']['comment'];
							foreach($data['Content']['title'] as $key => $title)
							{
								$data['Content']['comment'][$key] = $commentarr[$key];
							}
						}

						//tag
						$tagarr = $this->_make_tagarray($this->data['Topic_Tag']);

						$this->_save_data($data,$me,"","");

						//delete topic id session
						$this->Session->delete('new_topicid');
					}
//				}
			}//edit page or crate page
		}//is_correctuser
	}


	function _save_data($datacontents,$me,$topic_id,$orgcontents){
		if(!empty($orgcontents)){
			$orgtitlearray=array();
			$orgcontentarray=array();
			$orgcommentarray=array();
			$orgdatacontents=$orgcontents;


			////////////// Topic Title, Category, Description /////////
			if(!is_array(@$datacontents['request'])){
				$this->_set_topic_title($orgcontents,$topic_id,$me,$datacontents);
			}

			////////////// Tag /////////
			$this->_update_tag($orgcontents,$orgdatacontents,$datacontents,$topic_id,$me);


			///////////// Each title, contents, comments ///////////
			/// make the org content array from DB, in order to compare the new content array
			$orgtitlearray = $this->_make_orgdata_title_array($orgcontents);
			$orgcontentarray = $this->_make_orgdata_content_array($orgcontents);
			$orgcommentarray = $this->_make_orgdata_comment_array($orgcontents);


			/// make the new conetnt array from user input and replace array key numbers in order to compare 
			//$newtitlearray = $this->_make_newdata_title_array($datacontents['Content']['title']);
			$newtitlearray = $this->_make_newdata_title_array($datacontents);
			//$newcontentarray = $this->_make_newdata_content_array($datacontents['Content']['content']);
			$newcontentarray = $this->_make_newdata_content_array($datacontents);
			//$newcommentarray = $this->_make_newdata_comment_array($datacontents['Content']['comment']);
			$newcommentarray = $this->_make_newdata_comment_array($datacontents);

			//$topicid = $orgdata['id'];


/*
echo "<PRE>";
var_dump($orgtitlearray);
echo "</PRE>";
echo "<PRE>";
var_dump($orgcontentarray);
echo "</PRE>";
echo "<PRE>";
var_dump($orgcommentarray);
echo "</PRE>";

echo "ue orginal sita new contents<br><br>";

echo "<PRE>";
var_dump($newtitlearray);
echo "</PRE>";
echo "<PRE>";
var_dump($newcontentarray);
echo "</PRE>";
echo "<PRE>";
var_dump($newcommentarray);
echo "</PRE>";

exit;
*/


			//Compare the old title array and new title array, and if titles are modified, update the DB
			$isnewtitle=array_diff_assoc($newtitlearray,$orgtitlearray);
			if(!empty($isnewtitle)){
				$this->_update_title($newtitlearray, $orgdatacontents, $topic_id, $me);
			}

			//Compare the old contents array and new contents array, and if contents are modified, update the DB
			//$isnewcontent=$this->_getcontentdiff($newcontentarray,$orgcontentarray);
			$isnewcontent=array_diff_assoc($newcontentarray,$orgcontentarray);
			if(!empty($isnewcontent)){
				$this->_update_contents($newcontentarray, $orgdatacontents, $topic_id, $me);
			}

			//Compare the old comment array and new comment array, and if comments are modified, update the DB
			$isnewcomment=array_diff_assoc($newcommentarray,$orgcommentarray);
			if(!empty($isnewcomment)){
				$this->_update_comments($newcommentarray, $orgdatacontents, $topic_id, $me);
			}



/*
echo "<PRE>";
var_dump($newtitlearray);
echo "</PRE>";

echo "<PRE>";
var_dump($newcontentarray);
echo "</PRE>";

echo "<PRE>";
var_dump($newcommentarray);
echo "</PRE>";

exit;
*/


		}
		else{
			///  NEW Creat Topic ////
			//get contents form FORM
			if(!empty($datacontents))
			{
				//$data['user_id']=$this->data["Topic"]["user_id"];
				$data['id']=$topic_id;
				$data['user_id']=$me;
				/// topic title
				if(is_null($this->data["Topic_Title"])){
					$data['name']=$datacontents['request'][5];
				}else{
					$data['name']=$this->data["Topic_Title"];
				}
				/// topic category
				if(is_null($this->data["Topic_Category"])){
					$data['category']=$datacontents['request'][6];
				}else{
					$data['category']=$this->data["Topic_Category"];
				}
				/// topic description
				if(is_null($this->data["Topic_Description"])){
					$data['description']=$datacontents['request'][7];
				}else{
					$data['description']=$this->data["Topic_Description"];
				}
				/// topic userid 
				if(is_null($this->data["Topic_Userid"])){
					$data['userid']=$datacontents['request'][8];
				}else{
					$data['userid']=$this->data["Topic_Userid"];
				}
				//publish or hide
				$publish_num=$this->data["Topic_Publish"];
				if($publish_num < 2){
					$data['hide']=$this->data["Topic_Publish"];
				}


				//save Topic name and category to DB
				$result = $this->Topic->save($data);
				// get the last id
				$topicid = $this->Topic->getLastInsertID();

				//set new topic id into session
				$this->Session->write('new_topicid', $topicid );

			
				//save the first tag(category) into DB
				$orgdatacontents=$orgcontents;
				$this->_update_tag($orgcontents,$orgdatacontents,$this->data,$topicid,$me);


				// save titles to DB
				$newtitlearray['Content']['title'] = $this->_make_newdata_title_array($datacontents);
				if(!empty($newtitlearray['Content']['title'])){
					$this->_save_new_topic_title($newtitlearray, $data, $topicid);
				}
				//save contents to DB
				$newcontentarray['Content']['content'] = $this->_make_newdata_content_array($datacontents);
				if(!empty($newcontentarray['Content']['content'])){
					$this->_save_new_topic_content($newcontentarray, $data, $topicid);
				}
				//save comments to DB
				$newcommentarray['Content']['comment'] = $this->_make_newdata_comment_array($datacontents);
				if(!empty($newcommentarray['Content']['comment'])){
					$this->_save_new_topic_comment($newcommentarray, $data, $topicid);
				}
			}// end of if(there are values in the from)
		}// end of else(New create or Edit)

		$this->redirect(array('controller'=>'Users','action'=>'show_users','id'=>$me));
	}


	function _set_topic_title($orgcontents_base,$topic_id_base,$me_base,$datacontents_base){
		$orgdata=$data=array();
		$adminnumber = $this->_checkAdmin($me_base);

		/// original Topic title,category,description ///
		$orgdata['id']=$orgcontents_base[0]['Topic']['id'];
		$orgdata['user_id']=$orgcontents_base[0]['Topic']['user_id'];
		$orgdata['name']=$orgcontents_base[0]['Topic']['name'];
		$orgdata['category']=$orgcontents_base[0]['Topic']['category'];
		$orgdata['description']=$orgcontents_base[0]['Topic']['description'];
		$orgdata['checked']=$orgcontents_base[0]['Topic']['checked'];
		$orgdata['hide']=$orgcontents_base[0]['Topic']['hide'];

		/// new Topic title,category,description, if there are ///
		$data['id']=$topic_id_base;
		if($adminnumber == 0){
			$data['user_id']=$me_base;
		}else{
			$data['user_id']=$datacontents_base["Topic_Userid"];
		}
		$data['name']=$datacontents_base["Topic_Title"];
		$data['category']=$datacontents_base["Topic_Category"];
		$data['description']=$datacontents_base["Topic_Description"];
		$checkstatus = $datacontents_base["Topic_Check"];
		if($checkstatus == "true"){
			$data['checked']="1";
		}else{
			$data['checked']="0";
		}
		$hidestatus = $datacontents_base["Topic_Publish"];
		if($hidestatus != 2){ //if update(2), the hide status doen't change
			$data['hide']=$datacontents_base["Topic_Publish"];
		}

		/// Compare old data and new data to see if there are differences ///
		$isnewtopicinfo=array_diff_assoc($data,$orgdata);
		if(!empty($isnewtopicinfo)){
			//save Topic name and category to DB
			$this->Topic->save($data);
		}
	}

	function _make_orgdata_tag_array($orgcontents_base){
		$orgtagarray_base = array();
		$s=0;

		// make original title array from DB 
		foreach($orgcontents_base as $orgcontent){
			foreach($orgcontent['Tag'] as $orgtags){
				if($orgtags['TagsTopic']['deleted']!=1){
					$orgtagarray_base[$s]=$orgtags['name'];
					$s++;
				}
			}
		}

		return $orgtagarray_base;
	}

	function _make_orgdata_title_array($orgcontents_base){
		$orgtitlearray_base = array();
		$s=1;

		// make original title array from DB 
		//foreach($orgcontents_base as $orgcontent){
		foreach($orgcontents_base as $orgtitle){
			if(empty($orgtitle['Title'])){
				$orgtitlearray_base[0]="";
			}else{
				foreach($orgtitle['Title'] as $orgtitles){
					$orgtitlearray_base[$s]=$orgtitles['title'];
					$s++;
				}
			}
		}

		return $orgtitlearray_base;
	}

	function _make_orgdata_content_array($orgcontents_base){
		$orgcontentarray_base = array();
		$r=1;

		// make original contents array from DB
		foreach($orgcontents_base as $orgcontent){
			if(empty($orgcontent['Content'])){
				$orgcontentarray_base[0]="";
			}else{
				foreach($orgcontent['Content'] as $orgcontents){
					$orgcontentarray_base[$r]=$orgcontents['content'];
					$r++;
				}
			}
		}

		return $orgcontentarray_base;
	}

	function _make_orgdata_comment_array($orgcontents_base){
		$orgcommentarray_base = array();
		$o=1;

		// make original comments array from DB
		foreach($orgcontents_base as $orgcomment){
			if(empty($orgcomment['Comment'])){
				$orgcommentarray_base[0]="";
			}else{
				foreach($orgcomment['Comment'] as $orgcomments){
					$orgcommentarray_base[$o]=$orgcomments['comment'];
					$o++;
				}
			}
		}

		return $orgcommentarray_base;
 	}

	function _make_newdata_title_array($newtitles){
		$newtitlearray = array("");
		$i=1;

		////  Get item from save buttom
		if(@$newtitles["request"]){
			foreach($newtitles["request"] as $newtitlearray_t){
				if(is_array($newtitlearray_t)){
					foreach($newtitlearray_t as $newtitlearray_items){
						if(array_key_exists('Content', $newtitlearray_items)){
							foreach($newtitlearray_items as $newtitlearray_items_title){
								if(array_key_exists('title', $newtitlearray_items_title)){ //get only title items
									$newtitlearray[$i]=$newtitlearray_items_title["title"];
									$i++;
									//array_push($newtitlearray, $newtitlearray_items_title["title"]);
								}
							}
						}
					}
				}
			}

			unset($newtitlearray[0]);  //array starts from 1
			return $newtitlearray;

		}
		//// Get new title array from javascript when item box moved
		else{
			foreach($newtitles as $newtitlearray_items){
				if(is_array($newtitlearray_items)){
					//make new title array in which key starts from 1
					//array_values gets all the array value without key
					$newtitlearray = array_combine(range(1, count(array_values($newtitlearray_items["title"]))), array_values($newtitlearray_items["title"]));
				}
			}
			return $newtitlearray;
		}
	}

	function _make_newdata_content_array($newcontents){
                $newcontentarray = array("");
		$i = 1;

		//// Get new contents array from javascript when item box moved
		if(@$newcontents["request"]){
			foreach($newcontents["request"] as $newcontentarray_t){
				if(is_array($newcontentarray_t)){
					foreach($newcontentarray_t as $newcontentarray_items){
						if(array_key_exists('Content', $newcontentarray_items)){
							foreach($newcontentarray_items as $newcontentarray_items_content){
								if(array_key_exists('content', $newcontentarray_items_content)){
									$newcontentarray[$i]=$newcontentarray_items_content["content"];
									$i++;
//									array_push($newcontentarray, $newcontentarray_items_content["content"]);
								}
							}
						}
					}
				}
			}
			unset($newcontentarray[0]);  //array starts from 1
			return $newcontentarray;
		}
		////  Get item from save buttom
		else{
			foreach($newcontents as $newcontentarray_items){
				if(is_array($newcontentarray_items)){
					//make new contents array in which key starts from 1
					//array_values gets all the array value without key
					$newcontentarray = array_combine(range(1, count(array_values($newcontentarray_items["content"]))), array_values($newcontentarray_items["content"]));
				}
			}
			return $newcontentarray;
		}
	}

	function _make_newdata_comment_array($newcomments){
                $newcommentarray = array("");
		$i = 1;

		//// Get new comments array from javascript when item box is moved
		if(@$newcomments["request"]){
			foreach($newcomments["request"] as $newcommentarray_t){
				if(is_array($newcommentarray_t)){
					foreach($newcommentarray_t as $newcommentarray_items){
						if(array_key_exists('Content', $newcommentarray_items)){
							foreach($newcommentarray_items as $newcommentarray_items_comment){
								if(array_key_exists('comment', $newcommentarray_items_comment)){
									$newcommentarray[$i]=$newcommentarray_items_comment["comment"];
									$i++;
									//array_push($newcommentarray, $newcommentarray_items_comment["comment"]);
								}
							}
						}
					}
				}
			}
			unset($newcommentarray[0]);  //array starts from 1
			return $newcommentarray;
		}
		////  Get item from save buttom
		else{
			foreach($newcomments as $newcommentarray_items){
				if(is_array($newcommentarray_items)){
					//make new comment array in which key starts from 1
					//array_values gets all the array value without key
					$newcommentarray = array_combine(range(1, count(array_values($newcommentarray_items["comment"]))), array_values($newcommentarray_items["comment"]));
				}
			}
			return $newcommentarray;
		}
        }


	function _update_tag($orgcontents,$orgdatacontents,$datacontents,$topic_id,$me){
		//Compare the old tag array and new tag array, and if tags are modified, update the DB
		if(!empty($orgcontents)){
			$orgtagarray = $this->_make_orgdata_tag_array($orgcontents);
		}else{
			$orgtagarray = array("");
		}
		$newtagarray = explode(",",$datacontents['Topic_Tag']);
		//delete empty values
		$newtagarray = array_filter($newtagarray, "strlen");
		//re-numbering
		$newtagarray = array_values($newtagarray);

		//get added tags to origin
		$isnewtag=array_diff($newtagarray,$orgtagarray);
		//get deleted tags from origin
		$isdeletetag=array_diff($orgtagarray,$newtagarray);

		if(!empty($isnewtag) || !empty($isdeletetag)){
			$this->_save_tag_info($isnewtag, $isdeletetag, $orgdatacontents, $topic_id, $me);
		}
	}

	function _save_tag_info($newtagarray, $deletetagarray, $orgdatacontents, $topic_id, $me){
		//new tag. check if the tag isn in DB.
		foreach($newtagarray as $key=>$na_tag)
		{
			///////////////// Tag Table ///////////////////
			//find if there is the new tag in the TAG table already
			$isTaginDB = $this->Tag->findTag($na_tag);
			//if the tag is not in the DB, insert it into the DB
			if(empty($isTaginDB)){
				$this->_insertNewTag($na_tag);
			}
		}

		foreach($newtagarray as $key=>$no_tag)
		{
			//////////////// Tags_Topics Table ////////////
			//get new tag id
			$isTaginDB = $this->Tag->findTag($no_tag);
			$newtagid = $isTaginDB[0]['Tag']['id'];
			//insert the new tag into the tag_topics db
			$this->TagsTopic->updateNewTagTopic($topic_id,$newtagid);
		}

		foreach($deletetagarray as $key=>$d_tag)
		{
			//get delte tag id
                        $isTaginDB = $this->Tag->findTag($d_tag);
			if(!empty($isTaginDB)){
                	        $deletetagid = $isTaginDB[0]['Tag']['id'];
				//set deleted column to 1
				$this->TagsTopic->markDelete($topic_id,$deletetagid);
			}
		}
	}

	function _update_title($newtitlearray, $orgdatacontents, $topic_id, $me){
		$i=1;
		foreach($newtitlearray as $key=>$title)
		{
			if($title === "disabled"){
				$orgdatatitlesize = count($orgdatacontents[0]['Title']);
				//delete from DB when delete item from org contents
				if($key<=$orgdatatitlesize){
					$deletetitleid = $orgdatacontents[0]['Title'][$key-1]['id'];
					$this->Title->delete($deletetitleid);
				}
			}else{
				if(!empty($orgdatacontents[0]['Title'][$key-1]['id'])){
					$titleid =$orgdatacontents[0]['Title'][$key-1]['id'];
				}else{
					$titleid = NULL;
				}

				$this->Title->create();
				$data["id"]=$titleid;
				$data["topic_id"]=$topic_id;
				$data["content_id"]=$i;
				$data["title"]=$title;
				$data["user_id"]=$me;
				$this->Title->save($data);

				$i++;
			}
		}
	}

	function _update_contents($newcontentarray, $orgdatacontents, $topic_id, $me){
		$l=1;
		foreach($newcontentarray as $key=>$content)
		{
			if($content === "disabled"){
				$orgdatacontentsize = count($orgdatacontents[0]["Content"]);
				//delete from DB when delete item from org contents
				if($key<=$orgdatacontentsize){
					$deletecontentid = $orgdatacontents[0]['Content'][$key-1]['id'];
					$this->Content->delete($deletecontentid);
				}
			}else{
				if(!empty($orgdatacontents[0]['Content'][$key-1]['id'])){
					$contentid =$orgdatacontents[0]['Content'][$key-1]['id'];
				}else{
					$contentid = NULL;
				}

				$this->Content->create();
				$data["id"]=$contentid;
				$data["topic_id"]=$topic_id;
				$data["content_id"]=$l;
				$data["content"]=$content;
				$data["user_id"]=$me;
				$this->Content->save($data);
				$l++;
			}
		}
	}

	function _update_comments($newcommentarray, $orgdatacontents, $topic_id, $me){
		$j=1;
		foreach($newcommentarray as $key=>$comment)
		{
		        if($comment === "disabled"){
				$orgdatacommentsize = count($orgdatacontents[0]['Comment']);
				//delete from DB when delete item from org contents
				if($key<=$orgdatacommentsize){
				        $deletecommentid = $orgdatacontents[0]['Comment'][$key-1]['id'];
				        $this->Comment->delete($deletecommentid);
				}
		        }else{
				if(!empty($orgdatacontents[0]['Comment'][$key-1]['id'])){
				        $commentid =$orgdatacontents[0]['Comment'][$key-1]['id'];
				}else{
				        $commentid = NULL;
				}
				$this->Comment->create();
				$data["id"]=$commentid;
				$data["topic_id"]=$topic_id;
				$data["content_id"]=$j;
				if($comment === "Comment"){
			        	$data["comment"]="";
				}
				else{
				        $data["comment"]=$comment;
				}	
				$data["user_id"]=$me;
				$this->Comment->save($data);
	
				$j++;
			}
		}
	}

	function _getcontentdiff($oldarray,$newarray){
		/// compare the old array of content and the new array of content
		$ocontarray = $ncontarray = array("");

		foreach($oldarray as $oconts){
			foreach($oconts as $ocont){
				//array_unshift($ocontarray,$ocont);
				array_push($ocontarray,$ocont);
			}
		}

		foreach($newarray as $nconts){
			foreach($nconts as $ncont){
				//array_unshift($ncontarray,$ncont);
				array_push($ncontarray,$ncont);
			}
		}

		return array_diff_assoc($ocontarray,$ncontarray);
	}

	function _save_new_topic_title($datacontents, $data, $topicid){
		if(!empty($datacontents["Content"]["title"]))
		{
			$i=1;
			foreach($datacontents["Content"]["title"] as $key=>$title)
			{
				if($title === "disabled"){
				}else{
					$this->Title->create();
					$data["topic_id"]=$topicid;
					//$data["content_id"]=$key;
					$data["content_id"]=$i;
					$data["title"]=$title;
					$data["user_id"]=$data["user_id"];
					$this->Title->save($data);

					$i++;
				}
			}
		}

	}

	function _save_new_topic_content($datacontents, $data, $topicid){
		if(!empty($datacontents["Content"]["content"]))
		{
			$l=1;
			foreach($datacontents["Content"]["content"] as $key=>$content)
			{
					if($content === "disabled"){
					}else{
						$this->Content->create();
						$data["topic_id"]=$topicid;
						$data["content_id"]=$l;
						$data["content"]=$content;
						$data["user_id"]=$data["user_id"];
						$this->Content->save($data);

						$l++;
					}
			}
		}
	}

	function _save_new_topic_comment($datacontents, $data, $topicid){
		if(!empty($datacontents["Content"]["comment"]))
		{
			$j=1;
			foreach($datacontents["Content"]["comment"] as $key=>$comment)
			{
				if($comment === "disabled"){
				}else{
				$this->Comment->create();
				$data["topic_id"]=$topicid;
				$data["content_id"]=$j;
					if($comment === "Comment"){
						$data["comment"]="";
					}
					else{
						$data["comment"]=$comment;
					}
					$data["user_id"]=$data["user_id"];
					$this->Comment->save($data);

					$j++;
				}
			}
		}
	}

	function _make_tagarray($tagstring){
echo "<PRE>";
var_dump($tagstring);
echo "</PRE>";
		$newtagstring = preg_replace('/(\s)/','',$tagstring);
echo "<PRE>";
var_dump($newtagstring);
echo "</PRE>";
exit;
		$tag_array_t = explode(',',$newtagstring);

		return $tag_array_t;
	}

	function _insertNewTag($newtag){
		$tagdata = array();
		$tagdata['name'] = $newtag;

		$this->Tag->create();
		$this->Tag->save($tagdata);
	}

	function _insertNewTagTopic($topicid, $newtagid){
		$tagdata = array();
		$tagdata['topic_id'] = $topicid;
		$tagdata['tag_id'] = $newtagid;

		$this->TagsTopic->create();
		$this->TagsTopic->save($tagdata);
	}

	function image(){
		$this->request->data;
		if ($this->request->is('ajax')) {
			// Configure for ajax
			Configure::write('debug', 0);
			$this->autoRender = false;
			// Output
			$targettext = $this->data['input_text'];
			$number_perpage = $this->data['number_perpage'];
			$page_num = $this->data['page'];
			if(empty($page_num)){
				$page_num = 1;
			}
		}

		//Flickr
		App::import('Vendor', 'phpFlickr');
			$name = 'Flickr';
			$uses = array();
			$api_key = 'f76419f89a15fe062743699e01aa217b';
			$secret = '0beda1df1625f560';
			$flickr = new phpFlickr($api_key, $secret);
			$result = $flickr->photos_search(array(
				"text" => $targettext,
				"per_page" => $number_perpage,
				"page" => $page_num,
				//"license" => "1,2,3,4,5,6",
				"license" => "4,5,6",
				"extras" => "owner_name",
				//"sort" => 'relevant'
				"sort" => 'interestingness-asc'
			));

			$target_url = null;
			foreach ($result['photo'] as $photo) {
				$target_url = "http://farm".$photo['farm'].".static.flickr.com/".$photo['server']."/".$photo['id']."_".$photo['secret'];
				$owner_url = "http://www.flickr.com/photos/".$photo['owner']."/".$photo['id'];

				echo "<li style=\"float: left; margin: 0 10px 10px 0;\">";
				echo "<a href='".$target_url.".jpg' title='click to post the picture to the content'>";
//echo "<a target='_blank' href='http://farm".$photo['farm'].".static.flickr.com/".$photo['server']."/".$photo['id']."_".$photo['secret'].".jpg' title='".$photo['title']."' id='get_image'>";
				echo  "<img id='get_image' src='".$target_url."_s.jpg' alt=\"".$owner_url."(__)".$photo['title']."(__)".$photo['ownername']."\" />";
//echo  "<img id='get_image' src='http://farm".$photo['farm'].".static.flickr.com/".$photo['server']."/".$photo['id']."_".$photo['secret']."_s.jpg'>";
				echo "</a>";
				echo "</li>";
			}
			echo "<button id='moreButton' class='moreButton'>more</button>";
	}


	function uploadImage(){
		$me_array = $this->Session->read('Auth.User');
		$me = $me_array['id'];

		if (isset($_FILES['uploadedfile'])){
			//$name = $_FILES['uploadedfile']['name'];
			$extarray=$ext=array();
			$path = $_FILES['uploadedfile']['name'];
			$extarray = array("jpg","gif","png");
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$name=$me."_".date("YmdHis").".".$ext;

			//file check (type and size)
			if(array_search($ext,$extarray) === FALSE){
				echo "1|The selected file could not be uploaded. Only JPG, PNG and GIF images are supported.|";
			}elseif($_FILES['uploadedfile']['size'] > 512000){
				echo "2|The max file size is 500KB.|";
			}else{
				$filename = $_FILES['uploadedfile']['tmp_name'];
				$handle = fopen($filename, "r");
				$data = fread($handle, filesize($filename));
				$POST_DATA = array('file'=>base64_encode($data), 'name'=>$name, 'userid'=>$me);

				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, 'http://solidpower.qee.jp/upload_save.php');
				curl_setopt($curl, CURLOPT_TIMEOUT, 30);
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $POST_DATA);
				$response = curl_exec($curl);
				curl_close ($curl);

				$res_length=strlen($response);
				//substr($response, 0, $res_length);
				echo$res_length."|". $response;
			}
		}
	}

	function _checkImagefile($file_array){
	//http://qiita.com/mpyw/items/939964377766a54d4682//
	try {
		if (
			!isset($_FILES['uploadedfile']['error']) ||
			!is_int($_FILES['uploadedfile']['error'])
		){
			throw new RuntimeException('パラメータが不正です');
		}

		// $_FILES['upfile']['error'] の値を確認
		switch ($_FILES['uploadedfile']['error']) {
			case UPLOAD_ERR_OK: // OK
				break;
			case UPLOAD_ERR_NO_FILE:
				throw new RuntimeException('ファイルが選択されていません');
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				throw new RuntimeException('ファイルサイズが大きすぎます');
			default:
				throw new RuntimeException('その他のエラーが発生しました');
		}

		if ($_FILES['uploadedfile']['size'] > 1000000) {
			throw new RuntimeException('AAA ファイルサイズが大きすぎます');
		}

		$allowed_filetypes = array('.jpg','.gif','.bmp','.png'); 
		$filename = $_FILES['uploadedfile']['name']; // Get the name of the file (including file extension).
		$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
		if(!in_array($ext,$allowed_filetypes))
			die('The file you attempted to upload is not allowed.');
		} catch (RuntimeException $e) {
			echo $e->getMessage();
		}
	}


	function _get_editcontents($topic_array){
		$topic_id = $topic_array[0]['Topic']['id'];
		$topic_title = $topic_array[0]['Topic']['name'];
		$topic_category = $topic_array[0]['Topic']['category'];
		$topic_description = $topic_array[0]['Topic']['description'];
		$topic_userid = $topic_array[0]['Topic']['user_id'];
		$topic_check = $topic_array[0]['Topic']['checked'];
		//$topic_tags = $topic_array[0]['Tag']['name'];

		//array for all contents of the topic
		$contents_array = array();
		$contents_array[0]=array($topic_id,$topic_title,$topic_category,$topic_description,$topic_userid,$topic_check);
		$i = $j = $k = 0;

		//get All Title, Contetns, Comments, and put them into the content array
		if(!empty($topic_array[0]['Title']) AND !empty($topic_array[0]['Content']) and !empty($topic_array[0]['Comment'])){
			//Title
			foreach($topic_array[0]['Title'] as $content_title_array){
				$ctitle_array[$i] = $content_title_array['title'];
				$i++;
			}

			//Content
			foreach($topic_array[0]['Content'] as $content_content_array){
				$ccontents_array[$j] = $content_content_array['content'];
				$j++;
			}

			//Comment
			foreach($topic_array[0]['Comment'] as $content_comment_array){
				$ccomment_array[$k] = $content_comment_array['comment'];
				$k++;
			}

			//size of array
			$title_num = count($ctitle_array);
			$content_num = count($ccontents_array);
			$comment_num = count($ccomment_array);
			$count_array = array($title_num,$content_num,$comment_num);
			$item_num = max($count_array);

			//combine the three arrays into one array
			//*first item of the array is Topic title, description, category
			for($l = 1; $l < $item_num+1; $l++){
				$contents_array[$l]=array($ctitle_array[$l-1],$ccontents_array[$l-1],$ccomment_array[$l-1]);
			}
		}

		//get All Tag name, and put them into the content array, except deleted=1
		$n = 0;

		if(!empty($topic_array[0]['Tag'])){
			////if there are some vluews in the tag inputbox
			//get tags from DB
			foreach($topic_array[0]['Tag'] as $content_tag_array){
				if($content_tag_array['TagsTopic']['deleted'] != 1){
					$ctag_array[$n] = $content_tag_array['name'];
					$n++;
				}
			}

			if(!empty($ctag_array)){
				///when all the values are deleted from the tag inpubox, $ctag_array will be null
				$contents_array[0]+=array('6' => $ctag_array);
			}else{
				////if there is no values in the inputbox
				$contents_array[0]+=array('6' => "");
			}
		}
		else{
			////if there is no values in the inputbox
			$contents_array[0]+=array('6' => "");
		}

		return $contents_array;
	}

	function _checkUser($userid, $is_admin, $topicurl, $treferer){
		$searchresult=FALSE;
		//get topic id
		$tid = split(":",$topicurl);

		//if the user is admin, alow to create/edit the topic
		//$is_admin = 1;

		if(empty($tid[1])){
			return TRUE;
		}
		else{
			$topicid=$tid[1];
			$conditions = array();

			//check if the traffic comes form admin page, otherwise it comes from direct which is not correct
			if($treferer === "http://0-0b.com/administrations/"){
				if($is_admin!=0){
					$conditions['Topic.id'] = $tid[1];
					$searchresult = $this->Topic->find('all', array(
						'conditions' => $conditions
					));
				}
			}else{
				//only own created contents can edit from direct access, even if the user is admin
				$conditions['Topic.id'] = $tid[1];
				$conditions['Topic.user_id'] = $userid;
				$searchresult = $this->Topic->find('all', array(
					'conditions' => $conditions
				));
			}

			//return $searchresult;
			if(empty($searchresult)){
				return FALSE;
			}else{
				return $userid;
			}
		}
	}

	function _checkAdmin($adminuserid){
		//check if the user has admin priviledge
		$admin_array=array();
		$admin_array = $this->User->find('all',array(
			'conditions' => array('User.id' => $adminuserid)
		));

		$admin_num = $admin_array[0]['User']['admin'];
		return $admin_num;
	}

	function deletetopic(){
		//if POST is Error, return
		if($_SERVER["REQUEST_METHOD"] != "POST"){
			//Only POST Method
			header("HTTP/1.0 404 Not Found");
			return;
		}
		
		$topicid = 0; //target title id
		$topicid = $_POST["title_id"];


		$me_array = $this->Session->read('Auth.User');
		$me = $me_array['id'];

		$topic_array = $this->Topic->find('all', array('conditions' => array('Topic.id' => $topicid, 'Topic.deleted' => 0, 'Topic.user_id' => $me)));

		//Chech if the topic is owned by the logined user
		if(!empty($topic_array)){
			//check delete flag on the database
			$data=array();

			/// check the deleted and hide flag on ///
			$data['id']=$topicid;
			$data['deleted']=1;
			$data['hide']=1;
			//save Topic name and category to DB
			$this->Topic->save($data);
		}

		die();
	}
}
?>
