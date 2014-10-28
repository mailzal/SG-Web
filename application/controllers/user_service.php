<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class User_service extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
	
	function get()
    {    	 
    	$id = $this->_get('id');
    	if(!$id)
    	{
    		$users['data'] = $this->user_model->get_users();    		    		
    		if($users)
    			$this->response($users, 200); // 200 being the HTTP response code
    		else
    			$this->response(array('error' => 'Couldn\'t find any users!'), 404);
    	}

        $user['data'] = $this->user_model->get_user($id);
        if($user)
            $this->response($user, 200); // 200 being the HTTP response code
        else
            $this->response(array('error' => 'User could not be found'), 404);
    }

    function post()
    {
        $id = $this->_get('id');
        $data = $this->_post_args;
        if($id)
        {
            try {
                $user = $this->user_model->get_user($id);
            } catch (Exception $e){
                $this->response(array('error' => $e->getMessage()), $e->getCode());
            }
            if($user)
            {
                $this->user_model->update_user($id,$data);
                $user = $this->user_model->get_user($id);
                $this->response($user, 201); // 201 being the HTTP response code
            }
            else
            {
                $newId = $this->user_model->insert_user($data);
                $user= $this->user_model->get_user($newId);
                $this->response($user, 201); // 201 being the HTTP response code
            }
            
        }
        else
        {
            $newId = $this->user_model->insert_user($data);
            $user= $this->user_model->get_user($newId);
            $this->response($user, 201); // 201 being the HTTP response code
        }
    }
    
    public function put()
    {
		$data = $this->_put_args;
        $id = $this->_get('id');
        try {
            $id = $this->user_model->update_user_r($id,$data);
		} catch (Exception $e) {
			$this->response(array('error' => $e->getMessage()), $e->getCode());
		}
		if ($id) {
			$user = $this->user_model->get_user($id);
            $this->response($user, 200); // 200 being the HTTP response code
		} else
			$this->response(array('error' => 'User could not be found'), 404);
    }
        
    function delete()
    {
    	$id = $this->_get('id');
    	if(!$id)
    	{
    		$this->response(array('error' => 'An ID must be supplied to delete'), 400);
    	}

        $user = $this->user_model->get_user($id);

    	if($user) {
    		try {
    			$this->user_model->delete_user($id);
    		} catch (Exception $e) {
    			$this->response(array('error' => $e->getMessage()), $e->getCode());
    		}
    		$this->response($user, 200); // 200 being the HTTP response code
    	} else
    		$this->response(array('error' => 'User could not be found'), 404);
    }

    // function u_post()
    // {
    //     $data = $this->_post_args;
    //     try {
    //         $id = $this->user_model->insert_user($data);
    //     } catch (Exception $e) {
    //         $this->response(array('error' => $e->getMessage()), $e->getCode());
    //     }
    //     if ($id) {
    //         $user = $this->user_model->get_user($id);
    //         $this->response($user, 201); // 201 being the HTTP response code
    //     } else
    //         $this->response(array('error' => 'User could not be created'), 404);
    // }
}