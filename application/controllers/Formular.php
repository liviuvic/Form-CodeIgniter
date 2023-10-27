<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formular extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
        $this->load->model('tichete', 'Tichete');
    }

	public function index() {
		$tichete = $this->Tichete->tichete_list();
		$data = array('tichete' => $tichete);
		//return $this->response->setJSON($tichete);
		$this->load->view('formular', $data);
	}

	public function edit($id) {
		$tichet = $this->Tichete->edit($id);
		$data = json_encode($tichet[0]);
		echo $data;
	}

	public function adauga() {
		$form_data = $this->input->post();
		$id = $this->input->post("id");
		$actiune = $id == '' ? $this->Tichete->adauga($form_data) : $this->Tichete->modifica($form_data);

		
		$denumire = $this->input->post("denumire");
		$descriere = $this->input->post("descriere");
		$data = $this->input->post("data");
		$id_parinte = $this->input->post("parinte");
		echo 'Ai ' . $actiune . ' tichetul:<br>' .
			'Numarul: ' . $id . '<br>' .
			'Denumirea: ' . $denumire . '<br>' . 
			'Descrierea: ' . $descriere . '<br>' .
			'Data: ' . $data . '<br>' . 
			'Parintele: ' . $id_parinte . '<br><br>' . 
			'<a href="/Formular">Revino la Formular</a>';
	}

	public function sterge($id) {
		$this->Tichete->sterge($id);
		echo 'Ai sters tichetul cu numarul: ' . $id . '<br><br>' . 
		'<a href="/Formular">Revino la Formular</a>';
	}
}
