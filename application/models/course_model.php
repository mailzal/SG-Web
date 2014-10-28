<?php

class Course_model extends CI_Model
{

	function get_course_count(){
		$this->db->select('id')->from('course');
		$query = $this->db->get();
		return $query->num_rows();

	}

	function get_courses($num=20, $start=0)
	{
		$this->db->select()->from('course')->order_by('id','asc')->limit($num, $start);
		$query =$this->db->get();
		return $query->result_array();
	}

	function get_course($id)
	{
		$this->db->select()->from('course')->where('id',$id)->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->first_row('array');
	}

	function insert_course($data)
	{
		$this->db->insert('course',$data);
		return $this->db->insert_id();
	}

	function update_course($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('course', $data);
	}

	function delete_course($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('course');
	}
}