<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Course_service extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('course_model');
    }
	
	function get()
    {    	 
    	$id = $this->_get('id');
    	if(!$id)
    	{
    		$courses['data'] = $this->course_model->get_courses();    		    		
    		if($courses)
    			$this->response($courses, 200); // 200 being the HTTP response code
    		else
    			$this->response(array('error' => 'Couldn\'t find any courses!'), 404);
    	}

        $course['data'] = $this->course_model->get_course($id);
        if($course)
            $this->response($course, 200); // 200 being the HTTP response code
        else
            $this->response(array('error' => 'Course could not be found'), 404);
    }

    function post()
    {
        $data = $this->_post_args;
        try {
            $id = $this->course_model->insert_course($data);
        } catch (Exception $e) {
            $this->response(array('error' => $e->getMessage()), $e->getCode());
        }
        if ($id) {
            $course = $this->course_model->get_course($id);
            $this->response($course, 201); // 201 being the HTTP response code
        } else
            $this->response(array('error' => 'Course could not be created'), 404);
    }
    
    public function put()
    {
        $data = $this->_put_args;
        try {
            $id = $this->course_model->update_course($data['id'],$data);
        } catch (Exception $e) {
            $this->response(array('error' => $e->getMessage()), $e->getCode());
        }
        if ($id) {
            $course = $this->course_model->get_course($id);
            $this->response($course, 200); // 200 being the HTTP response code
        } else
            $this->response(array('error' => 'Course could not be found'), 404);
    }
        
    function delete()
    {
        $id = $this->_get('id');
        if(!$id)
        {
            $this->response(array('error' => 'An ID must be supplied to delete'), 400);
        }

        $course = $this->course_model->get_course($id);

        if($course) {
            try {
                $this->course_model->delete_course($id);
            } catch (Exception $e) {
                $this->response(array('error' => $e->getMessage()), $e->getCode());
            }
            $this->response($course, 200); // 200 being the HTTP response code
        } else
            $this->response(array('error' => 'Course could not be found'), 404);
    }
}