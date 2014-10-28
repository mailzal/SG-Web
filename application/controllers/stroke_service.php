<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Stroke_service extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('stroke_model');
    }
	
	function get()
    {    	 
    	$id = $this->_get('id');
    	if(!$id)
    	{
    		$strokes['data'] = $this->stroke_model->get_strokes();    		    		
    		if($strokes)
    			$this->response($strokes, 200); // 200 being the HTTP response code
    		else
    			$this->response(array('error' => 'Couldn\'t find any strokes!'), 404);
    	}

        $stroke['data'] = $this->stroke_model->get_stroke($id);
        if($stroke)
            $this->response($stroke, 200); // 200 being the HTTP response code
        else
            $this->response(array('error' => 'Stroke could not be found'), 404);
    }

    function post()
    {
        $data = $this->_post_args;
        try {
            $id = $this->stroke_model->insert_stroke($data);
        } catch (Exception $e) {
            $this->response(array('error' => $e->getMessage()), $e->getCode());
        }
        if ($id) {
            $stroke = $this->stroke_model->get_stroke($id);
            $this->response($stroke, 201); // 201 being the HTTP response code
        } else
            $this->response(array('error' => 'Stroke could not be created'), 404);
    }
    
    public function put()
    {
        $data = $this->_put_args;
        try {
            $id = $this->stroke_model->update_stroke($data['id'],$data);
        } catch (Exception $e) {
            $this->response(array('error' => $e->getMessage()), $e->getCode());
        }
        if ($id) {
            $stroke = $this->stroke_model->get_score($id);
            $this->response($stroke, 200); // 200 being the HTTP response code
        } else
            $this->response(array('error' => 'Stroke could not be found'), 404);
    }
        
    function delete()
    {
        $id = $this->_get('id');
        if(!$id)
        {
            $this->response(array('error' => 'An ID must be supplied to delete'), 400);
        }

        $stroke = $this->stroke_model->get_stroke($id);

        if($stroke) {
            try {
                $this->stroke_model->delete_stroke($id);
            } catch (Exception $e) {
                $this->response(array('error' => $e->getMessage()), $e->getCode());
            }
            $this->response($stroke, 200); // 200 being the HTTP response code
        } else
            $this->response(array('error' => 'Stroke could not be found'), 404);
    }
}