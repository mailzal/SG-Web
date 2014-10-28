<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Game_service extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('game_model');
    }
	
	function get()
    {    	 
    	$id = $this->_get('id');
    	if(!$id)
    	{
    		$games['data'] = $this->game_model->get_games();    		    		
    		if($games)
    			$this->response($games, 200); // 200 being the HTTP response code
    		else
    			$this->response(array('error' => 'Couldn\'t find any games!'), 404);
    	}

        $game['data'] = $this->game_model->get_game($id);
        if($game)
            $this->response($game, 200); // 200 being the HTTP response code
        else
            $this->response(array('error' => 'Game could not be found'), 404);
    }

    function post()
    {
        $data = $this->_post_args;
        try {
            $id = $this->game_model->insert_game($data);
        } catch (Exception $e) {
            $this->response(array('error' => $e->getMessage()), $e->getCode());
        }
        if ($id) {
            $game = $this->game_model->get_game($id);
            $this->response($game, 201); // 201 being the HTTP response code
        } else
            $this->response(array('error' => 'Game could not be created'), 404);
    }
    
    public function put()
    {
        $data = $this->_put_args;
        try {
            $id = $this->game_model->update_game($data['id'],$data);
        } catch (Exception $e) {
            $this->response(array('error' => $e->getMessage()), $e->getCode());
        }
        if ($id) {
            $game = $this->game_model->get_game($id);
            $this->response($game, 200); // 200 being the HTTP response code
        } else
            $this->response(array('error' => 'Game could not be found'), 404);
    }
        
    function delete()
    {
        $id = $this->_get('id');
        if(!$id)
        {
            $this->response(array('error' => 'An ID must be supplied to delete'), 400);
        }

        $game = $this->game_model->get_game($id);

        if($game) {
            try {
                $this->game_model->delete_game($id);
            } catch (Exception $e) {
                $this->response(array('error' => $e->getMessage()), $e->getCode());
            }
            $this->response($game, 200); // 200 being the HTTP response code
        } else
            $this->response(array('error' => 'Game could not be found'), 404);
    }
}