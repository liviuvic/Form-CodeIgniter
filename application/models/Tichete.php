<?php
class Tichete extends CI_Model {

	public function __construct() {
		parent::__construct(); 
		$this->load->database();
    }

	public function tichete_list() {
        return
			$this->db->select('t1.ID, t1.Denumire as Denumire, t1.Descriere, t1.Data, t2.ID as ID_Parinte, t2.Denumire as Parinte')
			->from('tichete t1')
			->join('tichete t2', 't1.Parinte = t2.ID', 'left')
			->order_by('t1.Data', 'DESC')
			->get()
			->result_array();
    }

	public function edit($id) {
		return
			$this->db->select('t1.ID, t1.Denumire as Denumire, t1.Descriere, t1.Data, t2.ID as ID_Parinte, t2.Denumire as Parinte')
			->from('tichete t1')
			->where('t1.ID', $id)
			->join('tichete t2', 't1.Parinte = t2.ID', 'left')
			->order_by('t1.Data', 'DESC')
			->get()
			->result_array();
		//return $data;
		//print_r($data);die();
	}

	public function adauga($form_data) {
		$this->db->insert('tichete', $form_data);
		return 'adaugat';
	}

	public function modifica($form_data) {
		$this->db->where('id', $form_data['id'])
		->update('tichete', $form_data);
		return 'modificat';
	}

	public function sterge($id) {
		$this->db->where('id', $id)
		->delete('tichete');
	}
}
?>
