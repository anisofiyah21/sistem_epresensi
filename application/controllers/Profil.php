<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function profile()
	{
		$data['title'] = 'My Profile';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('profil/profile', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$data['title'] = 'Edit Profile';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['mapel'] = $this->db->get('tb_mapel')->result();
		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('profil/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			// cek jika ada gambar yang akan diupload
			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					$old_image = $data['tb_user']['image'];
					if ($old_image != 'default.png') {
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}
			$this->db->set('name', $name);
			if ($data['tb_user']['role_id'] == '2') {
				$this->db->set('nip', $this->input->post('nip'));
				$this->db->set('mapel_id', $this->input->post('mapel_id'));
			}
			$this->db->where('email', $email);
			$this->db->update('tb_user');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile berhasil di update</div>');
			redirect('profil/profile');
		}
	}
	public function changepassword()
	{
		$data['title'] = 'Ubah Password';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'password saat ini', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'Password Terbaru', 'required|trim|min_length[6]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'konfirmasi password', 'required|trim|min_length[6]|matches[new_password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('profil/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $data['tb_user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password saat ini tidak sesuai!</div>');
				redirect('profil/changepassword');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password saat ini</div>');
					redirect('profil/changepassword');
				} else {
					//password OK
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('tb_user');
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
					redirect('profil/changepassword');
				}
			}
		}
	}
}
