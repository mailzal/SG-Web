<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_list extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _golfscore_output($output = null)
	{
		$this->load->view('main_page.php',$output);
	}
	
	public function index()
	{
		$this->_golfscore_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function user_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('user');
			$crud->set_subject('user');
			$crud->required_fields('user_name');
			$crud->columns('user_name','password','address');

			$output = $crud->render();

			$this->_golfscore_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function course_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('course');
			$crud->set_subject('course');
			$crud->required_fields('course_name');
			$crud->columns('course_name','date','country');

			$output = $crud->render();

			$this->_golfscore_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function game_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('game');
			$crud->set_subject('game');
			$crud->columns('game_name','play_date_time','handicap');

			$output = $crud->render();

			$this->_golfscore_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function score_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('score');
			$crud->set_subject('score');
			$crud->required_fields('user_name');
			$crud->columns('score_name','score_desc','putts');

			$output = $crud->render();

			$this->_golfscore_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function stroke_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('stroke');
			$crud->set_subject('stroke');
			$crud->required_fields('stroke_name');
			$crud->columns('stroke_name','stroke_desc');

			$output = $crud->render();

			$this->_golfscore_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function user_has_game_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('user_has_game');
			$crud->set_subject('user_has_game');
			$crud->required_fields('user_id','game_id');
			$crud->columns('user_id','game_id','user_has_game_desc');

			$output = $crud->render();

			$this->_golfscore_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}