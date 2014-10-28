<?php

class Stroke_model extends CI_Model
{

	function get_stroke_count(){
		$this->db->select('id')->from('stroke');
		$query = $this->db->get();
		return $query->num_rows();

	}

	function get_strokes($num=20, $start=0)
	{		
		$this->db->select()->from('stroke')->order_by('id', 'asc')->limit($num, $start);
		$query =$this->db->get();
		return $query->result_array();
	}

	function get_stroke($id)
	{
		$this->db->select()->from('stroke')->where('id',$id)->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->first_row('array');
	}

	function insert_stroke($data)
	{
		$this->db->insert('stroke',$data);
		return $this->db->insert_id();
	}

	function update_stroke($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('stroke', $data);
	}

	function delete_stroke($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('stroke');
	}
}