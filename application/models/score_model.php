<?php

class Score_model extends CI_Model
{

	function get_score_count(){
		$this->db->select('id')->from('score');
		$query = $this->db->get();
		return $query->num_rows();

	}

	function get_scores($num=20, $start=0)
	{
		$this->db->select()->from('score')->order_by('id','asc')->limit($num, $start);
		$query =$this->db->get();
		return $query->result_array();
	}

	function get_score($id)
	{
		$this->db->select()->from('score')->where('id',$id)->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->first_row('array');
	}

	function insert_score($data)
	{
		$this->db->insert('score',$data);
		return $this->db->insert_id();
	}

	function update_score($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('score', $data);
	}

	function delete_score($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('score');
	}
}