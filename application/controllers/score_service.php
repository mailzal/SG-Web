<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Score_service extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('score_model');
    }
	
	function get()
    {    	 
    	$id = $this->_get('id');
    	if(!$id)
    	{
    		$scores['data'] = $this->score_model->get_scores();    		    		
    		if($scores)
    			$this->response($scores, 200); // 200 being the HTTP response code
    		else
    			$this->response(array('error' => 'Couldn\'t find any scores!'), 404);
    	}

        $score['data'] = $this->score_model->get_score($id);
        if($score)
            $this->response($score, 200); // 200 being the HTTP response code
        else
            $this->response(array('error' => 'Score could not be found'), 404);
    }

    function post()
    {
        $data = $this->_post_args;
        try {
            $id = $this->score_model->insert_score($data);
        } catch (Exception $e) {
            $this->response(array('error' => $e->getMessage()), $e->getCode());
        }
        if ($id) {
            $score = $this->score_model->get_score($id);
            $this->response($score, 201); // 201 being the HTTP response code
        } else
            $this->response(array('error' => 'Score could not be created'), 404);
    }
    
    public function put()
    {
        $data = $this->_put_args;
        try {
            $id = $this->score_model->update_score($data['id'],$data);
        } catch (Exception $e) {
            $this->response(array('error' => $e->getMessage()), $e->getCode());
        }
        if ($id) {
            $score = $this->score_model->get_score($id);
            $this->response($score, 200); // 200 being the HTTP response code
        } else
            $this->response(array('error' => 'Score could not be found'), 404);
    }
        
    function delete()
    {
        $id = $this->_get('id');
        if(!$id)
        {
            $this->response(array('error' => 'An ID must be supplied to delete'), 400);
        }

        $score = $this->score_model->get_score($id);

        if($score) {
            try {
                $this->score_model->delete_score($id);
            } catch (Exception $e) {
                $this->response(array('error' => $e->getMessage()), $e->getCode());
            }
            $this->response($score, 200); // 200 being the HTTP response code
        } else
            $this->response(array('error' => 'Score could not be found'), 404);
    }
}