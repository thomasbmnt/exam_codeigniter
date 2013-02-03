<?php

class M_Member extends CI_Model
{

	public function verifier($data)
	{
		$query = $this->db->get_where('membres', array('email' => $data['email'], 'mdp' => sha1($data['mdp'])));
		return $query->result_array();
	}
	
	public function verifierEmail($data)
	{
		$query = $this->db->get_where('membres', array('email' => $data['email']));
		return $query->result_array();
	}
	
	public function add($data)
	{
		$data = array(
			'membre_id' => '',
		   'nom' => $data['nom'] ,
		   'mdp' => sha1($data['pswd']) ,
		   'email' => $data['email']
		);
		
		$this->db->insert('membres', $data); 
	}

}