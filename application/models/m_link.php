<?php

class M_Link extends CI_Model
{

	public function delete($item)
	{
		$this->db->where('idLink', $item);
		$this->db->delete('links');
	}
	
	public function lister()
	{
		$this->db->order_by("idLink", "desc");
		$query = $this->db->get_where('links', array('membre_id' => $this->session->userdata('id')));
		
		return $query->result_array();
	}
	
	public function getOne()
	{
		$query = $this->db->get_where('links', array('idLink' => $this->uri->segment(3) ,'membre_id' => $this->session->userdata('id')));
		
		return $query->result_array();
	}
	
	public function add($array, $image)
	{
		$data = array(
			'idLink' => '',
		   'titre' => $array['titre'] ,
		   'description' => $array['description'] ,
		   'image' => $image,
		   'lien' => $array['lien'],
		   'membre_id' => $this->session->userdata('id')
		);
		
		$this->db->insert('links', $data); 
	}
	
	
	public function update($array)
	{

		$this->db->where('idLink', $this->uri->segment(3));
		$data = array(
		   'titre' => $array['titre'] ,
		   'description' => $array['description'] ,
		   'image' => $array['image'],
		   'lien' => $array['lien']
		);
		
		 $this->db->update('links', $data);
	}


}