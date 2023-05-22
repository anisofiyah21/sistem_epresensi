<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_presensi');
	}

	public function index()
	{

		$data['total_mapel'] = count($this->db->get('tb_mapel')->result());
		$data['total_user'] = count($this->db->get('tb_user')->result());
		$data['total_presensi'] = count($this->db->get('tb_kodepresensi')->result());
		$data['total_laporan'] = count($this->db->get('tb_absen')->result());

		$data['title'] = 'Dashboard';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function datauser()
	{
		$data['title'] = 'Data User';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['DataUser'] = $this->db->get('tb_user')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/datauser', $data);
		$this->load->view('templates/footer');
	}

	public function dataguru()
	{
		$data['title'] = 'Data Guru';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['DataGuru'] = $this->db->get_where('tb_user', ['role_id' => 2])->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/dataguru', $data);
		$this->load->view('templates/footer');
	}

	public function datamapel()
	{
		$data['title'] = 'Data Mapel';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['DataMapel'] = $this->db->get('tb_mapel')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/datamapel', $data);
		$this->load->view('templates/footer');
	}

	public function tambahuser()
	{
		$data['title'] = ' Form Tambah Data User';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
		$this->form_validation->set_rules('password2', 'password confirmation', 'required|trim|min_length[6]|matches[password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/tambahuser', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.png',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => htmlspecialchars($this->input->post('role_id', true)),
				'date_created' => time()
			];

			$this->db->insert('tb_user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! user berhasil ditambahkan</div>');
			redirect('admin/datauser');
		}
	}

	public function tambahmapel()
	{
		$data['title'] = 'Form Tambah Data Mapel';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('code', 'Code', 'required|trim');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/tambahmapel', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'kode' => htmlspecialchars($this->input->post('code', true)),
				'nama_mapel' => htmlspecialchars($this->input->post('name', true)),
			];

			$this->db->insert('tb_mapel', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Mata Pelajaran berhasil ditambahkan</div>');
			redirect('admin/datamapel');
		}
	}

	public function tambahguru()
	{
		$data['title'] = 'Form Tambah Data Guru';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['mapel'] = $this->db->get('tb_mapel')->result();

		$this->form_validation->set_rules('nip', 'NIP', 'required|trim');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('mapel_id', 'mapel', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/tambahguru', $data);
			$this->load->view('templates/footer');
		} else {

			// $data = [
			// 	'NIP' => htmlspecialchars($this->input->post('NIP', true)),
			// 	'Nama' => htmlspecialchars($this->input->post('name', true)),
			// 	'JK' => htmlspecialchars($this->input->post('JK', true)),
			// 	'Alamat' => htmlspecialchars($this->input->post('address', true)),
			// 	'Mapel' => htmlspecialchars($this->input->post('mapel', true)),
			// 	'Email' => htmlspecialchars($this->input->post('email', true)),
			// 	'Status' => htmlspecialchars($this->input->post('status', true)),
			// ];

			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.png',
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'date_created' => time(),
				'nip' => htmlspecialchars($this->input->post('nip', true)),
				'mapel_id' => htmlspecialchars($this->input->post('mapel_id', true))
			];


			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/guru/';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$new_foto = $this->upload->data('file_name');
					$data['image'] = $new_foto;
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->db->insert('tb_user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Guru berhasil ditambahkan</div>');
			redirect('admin/dataguru');
		}
	}

	public function hapususer($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tb_user');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data user berhasil dihapus</div>');
		redirect('admin/datauser');
	}

	public function hapusmapel($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tb_mapel');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data mapel berhasil dihapus</div>');
		redirect('admin/datamapel');
	}

	public function hapusguru($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tb_user');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data guru berhasil dihapus</div>');
		redirect('admin/dataguru');
	}

	public function editdatauser($id)
	{
		$data['title'] = 'Form Edit Data User';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['tb_user'] = $this->M_presensi->ambil_id_user($id);
		$data['role_id'] = ['1', '2'];


		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/edituser', $data);
			$this->load->view('templates/footer');
		}
	}


	public function prosesedituser()
	{

		$this->M_presensi->prosesedituser($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data user berhasil diupdate</div>');
		redirect('admin/datauser');
	}


	public function editdataguru($id)
	{
		$data['title'] = 'Form Edit Data Guru';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['tb_guru'] = $this->db->get_where('tb_user', ['id' => $id])->row_array();
		$data['mapel'] = $this->db->get('tb_mapel')->result();
		// $data['status'] = ['0', '1'];

		$this->form_validation->set_rules('NIP', 'NIP', 'required|trim');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('mapel', 'Mapel', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/editguru', $data);
			$this->load->view('templates/footer');
		}
	}


	public function proseseditguru()
	{
		// $this->M_presensi->proseseditguru($id);
		$data = [
			'nip' => $this->input->post('nip'),
			'name' => $this->input->post('name'),
			'mapel_id' => $this->input->post('mapel_id'),
			'email' => $this->input->post('email'),
			'image' => $this->input->post('gambar_lama')
		];
		$upload_image = $_FILES['image']['name'];
		if ($upload_image) {
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['upload_path'] = './assets/img/guru/';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$old_image = $data['image'];
				if ($old_image != 'default.png') {
					unlink(FCPATH . 'assets/img/guru/' . $old_image);
				}
				$new_foto = $this->upload->data('file_name');
				// $this->db->set('Foto', $new_foto);
				$data['image'] = $new_foto;
			} else {
				echo $this->upload->display_errors();
			}
		}
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('tb_user', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data guru berhasil diupdate</div>');
		redirect('admin/dataguru');
	}


	public function editdatamapel($id)
	{
		$data['title'] = 'Form Edit Data Mapel';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['tb_mapel'] = $this->M_presensi->ambil_id_mapel($id);

		$this->form_validation->set_rules('code', 'Code', 'required|trim');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/editmapel', $data);
		$this->load->view('templates/footer');
	}


	public function proseseditmapel()
	{
		$this->M_presensi->proseseditmapel($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data mapel berhasil diupdate</div>');
		redirect('admin/datamapel');
	}

	public function laporan()
	{
		$data['title'] = 'Laporan Presensi';
		$data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		// $data['presensi_list'] = $this->db->get('tb_kodepresensi')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('presensi/laporan', $data);
		$this->load->view('templates/footer');
	}

	
	public function cetak_laporan($bulan)
	{
		$this->db->select('*');
		$this->db->from('tb_kodepresensi');
		$this->db->like('tanggal', $bulan);
		// $this->db->where('year(tanggal)', $bulan);
		$data['tb_kodepresensi'] = $this->db->get()->result();
		$data['bulan'] = $bulan;
		$this->load->view('presensi/cetak-laporan', $data);
	}
}
