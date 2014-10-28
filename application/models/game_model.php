<?php

class Game_model extends CI_Model
{

	function get_game_count(){
		$this->db->select('id')->from('game');
		$query = $this->db->get();
		return $query->num_rows();

	}

	function get_games($num=20, $start=0)
	{
		$this->db->select()->from('game')->order_by('id','asc')->limit($num, $start);
		$query =$this->db->get();
		return $query->result_array();
	}

	function get_game($id)
	{
		$this->db->select()->from('game')->where('id',$id)->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->first_row('array');
	}

	function insert_game($data)
	{
		$this->db->insert('game',$data);
		return $this->db->insert_id();
	}

	function update_game($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('game', $data);
	}

	function delete_game($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('game');
	}
}