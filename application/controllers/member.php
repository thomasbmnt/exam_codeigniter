<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if( $this->session->userdata('logged_in') && $this->uri->segment(2) != "deconnexion"){
			redirect('link/');
		}
	}
	  
	public function index()
	{
		$this->load->helper('form');
		
		$data['titre'] = 'Connexion';
		$data['vue'] = $this->load->view('member_form', $data, TRUE);
		
		$this->load->view('layout', $data);
			
	}
	
	public function login()
	{
		$this->load->model('M_Member');
		
		$data['mdp'] = $this->input->post('mdp');
		$data['email'] = $this->input->post('email');
		
		$donnees = $this->M_Member->verifier($data);
		
		
		if( $donnees )
		{	
			$this->session->set_userdata('logged_in', true);
			$this->session->set_userdata('email', $this->input->post('email'));
			$this->session->set_userdata('pseudo', $donnees[0]['nom']);
			$this->session->set_userdata('id', $donnees[0]['membre_id']);
			redirect('link/');
		}
		else
		{
			redirect('error/mauvais_identifiant');
		}
	}
	
	public function create()
	{
		$data['titre'] = 'Création d\'un compte';
		$data['vue'] = $this->load->view('member_create', $data, TRUE);
		$this->load->view('layout', $data);
	}
	
	public function createAccount()
	{
		$this->load->model('M_Member');
	
		$data['email'] = $this->input->post('email');
		$data['nom'] = $this->input->post('nom');
		$data['pswd'] = $this->input->post('mdp');
		$data['pswd_confirm'] = $this->input->post('mdp_confirmation');
		$data['error'] = "";
		

		if( !empty($data['email']) && !empty($data['pswd']) && !empty($data['pswd_confirm']) && !empty($data['nom']) ) {
			$data['retour'] = $this->M_Member->verifierEmail($data);
			if( $data['retour'] ) {
				$data['error'] .= '<p>L\'adresse email que vous avez entré figure déjà dans notre base de données.</p>';
			} else {
				$this->M_Member->add($data);
			}
		} else {
			if( empty( $data['email']) ){
				$data['error'] .= '<p>Le champs email ne peut être vide.</p>';
			} if ( empty( $data['pswd']) ) {
				$data['error'] .= '<p>Le champs Mot de passe ne peut être vide.</p>';
			} if ( empty( $data['nom']) ) {
				$data['error'] .= '<p>Le champs Nom ne peut être vide.</p>';
			} if ( empty( $data['pswd_confirm']) ) {
				$data['error'] .= '<p>Le champs Confirmation ne peut être vide.</p>';
			} else if ( $data['pswd_confirm'] != $data['pswd'] ) {
				$data['error'] .= '<p>La confirmation du mot de passe ne correspond pas.</p>';
			}
		}
		$data['titre'] = 'Création d\'un compte';
		$data['vue'] = $this->load->view('member_create', $data, TRUE);
		$this->load->view('layout', $data);

	}

	
	public function deconnexion()
	{
		$this->session->sess_destroy();
		redirect(site_url());
	}
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */