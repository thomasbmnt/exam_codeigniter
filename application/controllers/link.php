<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link extends CI_Controller {
	  
	public function __construct()
	{
		parent::__construct();
		/*
if( !$this->session->userdata('logged_in')){
			redirect('member');
		}
*/
	}
	  
	  
	public function index()
	{
		$this->load->helper('form');
		$this->load->model('M_Link');
		
		$data['titre'] = 'Entrée d\'url';
		$data['liens'] = $this->M_Link->lister();
		$data['vue'] = $this->load->view('link', $data, TRUE);
	
		$this->load->view('layout', $data);
			
	}

	public function load()
	{
		$this->load->model('M_Link');
		$data['adresse'] = $this->input->post('adresse');
		
		if( empty($data['adresse']) )
		{
			
			$data['titre'] = 'erreur';
			$data['error'] = 'Le champs ne peut être vide';
		}
		else
		{
			header('Content-type: text/html; charset=UTF-8');
			$this->load->library('curl');
			/* gestion du HTTP:// facultatif */
			
			/* Cas 1 : L'utilisateur a écrit une adresse avec seulement www. devant */
			if( preg_match( '#(^www)#im', $data['adresse'] ) ) {
				$data['adresse'] = 'http://' . $data['adresse'];
			} 
			/* Cas 2 : L'utilisateur a écrit une adresse sans www. ni http:// */
			else if( !preg_match( '#(http://www)#im', $data['adresse'] ) && !preg_match( '#(^http)#im', $data['adresse'] ) ) {
				$data['adresse'] = 'http://www.' . $data['adresse'];
			} 
	
			
		 
			$file_contents = $this->curl->simple_get($data['adresse']);
			
			// echo nl2br(htmlspecialchars($file_contents));
			
			/* Recupération de la description */
			$regexDescription = '#.*name="description"\scontent="(.*)"#im';
			preg_match($regexDescription,
			$file_contents, $data['descriptionURL']);
			
			/* Récuparation du titre */
			$regexTitre = '#<title>(.*)</title>#';
			preg_match($regexTitre,
			$file_contents, $data['titreURL']);
			
			/* On recupère toutes les images du site */
			$regexImages = '#<img.*src="(.*?)"#im';
			preg_match_all($regexImages,
			$file_contents, $data['imagesURL']);
			

			/* Librairie pour le XML : DoMXML*/
	
			$dom = new DOMDocument();
			@$dom->loadHTML($file_contents);
			
			//$nodes = $dom->getElementsByTagName('title');
			
			//echo $nodes->item(0)->nodeValue;
			
			$nodes = $dom->getElementsByTagName('meta');
			
			foreach ( $nodes as $value ) :
				if( strtolower($value->getAttribute("name")) == "description" )
					echo $value->getAttribute("content") . 'ok';
			endforeach;
			
			
			/* ***************************** */
			
			$data['titre'] = 'Résultat';
		}
		
		$data['liens'] = $this->M_Link->lister();
		$data['vue'] = $this->load->view('link', $data, TRUE);
		
		$this->load->view('layout', $data);
	}
	
	
	public function delete($it)
	{
		$this->load->model('M_Link');
		
		if( $this->input->is_ajax_request() ){
			$this->M_Link->delete($it);
			echo 'lien supprimé';
		} else {
			$it = $this->uri->segment(3);
			$this->M_Link->delete($it);
			redirect(site_url());
		}
	}
	
	public function ajouter()
	{
		$this->load->model('M_Link');


		if( $this->input->is_ajax_request() ){
			$this->M_Link->add($this->input->post(), $this->input->post('image'));
			echo 'lien ajouté';
			return;
		} else {
			if( $this->input->post('image') )
			{
				$imageName = $this->uploadImage($this->input->post('image'));
			}
		
			$this->M_Link->add($this->input->post(), $imageName);
			
			
			
			redirect(site_url());
		}
	}
	
	public function edit()
	{
		$this->load->model('M_Link');


		if( $this->input->post() ){
			$vars = $this->input->post();
			
			if( empty($vars['lien']) || empty($vars['description']) || empty($vars['titre']) ) {
				$data['error'] = "<p>Vous devez remplir tous les champs</p>";
				$data['lien'] = $this->M_Link->getOne();
			} else {
				$this->M_Link->update($vars);
				redirect(site_url());
			}
		} else {
			$data['lien'] = $this->M_Link->getOne();
		}
		
		
		$data['lien'] = $data['lien'][0];
		$data['titre'] = "Modification de lien";
		$data['vue'] = $this->load->view('link_edit', $data, TRUE);
		
		$this->load->view('layout', $data);
	}
	
	public function uploadImage($image){
		
		/* Récupération de l'image */
	
		$size = getimagesize($image);
		$img = file_get_contents($image);
		$size['mime'];
		
		$width = $size[0];
		$height = $size[1];
		
		$format = explode("/", $size['mime']);
		
		$key = md5(time());
		
		$imageName = $key.'.'.$format[1];
		
		
		$fp = fopen('web/uploads/'.$imageName, 'w');
		
		fwrite($fp, $img);
		
		fclose($fp);
		
		/* Calculs de redimensionnements */
		
		/* Si l'image est plus large que haute */
		if( $width > $height )
		{
			$newWidth = ($width/$width)*250;
			$newHeight = ($height/$width)*250;
		}
		/* Si la hauteur est plus grande que la largeur */
		else if( $height > $width)
		{
			$newWidth = ($width/$height)*250;
			$newHeight = ($height/$height)*250;
			
		}
		/* Si les dimensions sont égales */
		else
		{
			$newWidth = 250;
			$newHeight = 250;
		}
		
		/* On redimensionne l'image */
		
		$config['image_library'] = 'gd2';
		$config['source_image']	= 'web/uploads/'.$imageName;
		$config['maintain_ratio'] = TRUE;
		$config['width']	 = $newWidth;
		$config['height']	= $newHeight;
		
		$this->load->library('image_lib', $config); 
		
		$this->image_lib->resize();
		
		
		
		return site_url().'web/uploads/'.$imageName;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */