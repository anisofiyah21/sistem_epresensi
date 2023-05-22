<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_presensi extends CI_Model{
	public function getAllsistem_epresensi(){
		return $this->db->get('sistem_epresensi')->result_array();
	}
	

public function ambil_id_user($id)
{
	return $this->db->get_where('tb_user', ['id' => $id])->row_array();
}

public function prosesedituser()
{
	
	$data = [
		"name" => $this->input->post('name'),
		"email" => $this->input->post('email'),
		"password" => $this->input->post('password'),
		"role_id" => $this->input->post('role_id'),
	];

	$this->db->where('id', $this->input->post('id'));
	$this->db->update('tb_user', $data);
}

// public function ambil_id_guru($id)
// {
// 	return $this->db->get_where('tb_user', ['id' => $id])->row_array();
// }

// public function proseseditguru()
// {
	
// 	$data = [
// 		"NIP" => $this->input->post('NIP'),
// 		"Nama" => $this->input->post('name'),
// 		"JK" => $this->input->post('JK'),
// 		"Alamat" => $this->input->post('address'),
// 		"Mapel" => $this->input->post('mapel'),
// 		"Email" => $this->input->post('email'),
// 		"Status" => $this->input->post('status'),
// 	];

// 	$upload_image = $_FILES['Foto']['name'];

// 		if($upload_image){
// 			$config['allowed_types'] = 'gif|jpg|png';
// 			$config['max_size'] = '2048';
// 			$config['upload_path'] = './assets/img/guru/';

// 			$this->load->library('upload', $config);

// 				if($this->upload->do_upload('Foto')){
// 					$old_image = $data['tb_guru']['Foto'];
// 					if($old_image != 'default.png'){
// 						unlink(FCPATH . 'assets/img/guru/' . $old_image);
// 				}
// 					$new_foto = $this->upload->data('file_name');
// 					$this->db->set('Foto', $new_foto);
// 				} else{
// 					echo $this->upload->display_errors();
// 			}
// 		}
		

// 	$this->db->where('id', $this->input->post('id'));
// 	$this->db->update('tb_user', $data);
// }

public function ambil_id_mapel($id)
{
	return $this->db->get_where('tb_mapel', ['id' => $id])->row_array();
}

public function proseseditmapel()
{
	
	$data = [
		"kode" => $this->input->post('code'),
		"nama_mapel" => $this->input->post('name'),
	];

	$this->db->where('id', $this->input->post('id'));
	$this->db->update('tb_mapel', $data);
}

}
