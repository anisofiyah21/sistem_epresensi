<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_presensi');
        $this->load->model('M_absen');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function datapresensi()
    {

        $data['title'] = 'Presensi';
        $data['presensi_list'] = $this->M_absen->getpresensi();
        $data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['presensi_list'] = $this->db->get('tb_kodepresensi')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('presensi/datapresensi', $data);
        $this->load->view('templates/footer');
    }

    public function tambahpresensi()
    {
        $data['title'] = 'Form Tambah Data Presensi';
        $data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->helper('string');
        $data['presensi_list'] = $this->M_absen->getall();
        $data['mapel'] = $this->db->get('tb_mapel')->result();


        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required');
        $this->form_validation->set_rules('jam_pulang', 'Jam Pulang', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('presensi/tambahpresensi', $data);
            $this->load->view('templates/footer');
        } else {


            $this->load->library('ciqrcode');
            $config['cahceable'] = true;
            $config['cahcedir'] = './assets/app-assets/qr';
            $config['errorlog'] = './assets/app-assets/qr';
            $config['imagedir'] = './assets/app-assets/qr/img/'; //Penyimpanan QR COde
            $config['quality'] = true;
            $config['size'] = '1024';
            $config['black'] = [224, 225, 255];
            $config['white'] = [70, 130, 180];

            $this->ciqrcode->initialize($config);

            $img_name = random_string('alnum', 16) . '.png'; //Penamaan QR Code

            $params['data'] = encrypt_url($this->input->post('kode'));
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $img_name;

            $hasil_qr = $this->ciqrcode->generate($params);

            if ($hasil_qr) {
                $data_presensi = [
                    'kode' => $this->input->post('kode', true),
                    'hari' => $this->input->post('hari', true),
                    'tanggal' => $this->input->post('tanggal', true),
                    'jam_masuk' => $this->input->post('jam_masuk', true),
                    'jam_pulang' => $this->input->post('jam_pulang', true),
                    'QR' => $img_name,
                ];

                $this->db->insert('tb_kodepresensi', $data_presensi);
                $this->session->set_flashdata('pesan', "
                <script>
                   Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data Berhasil Disimpan!',
                        })
                </script>
                ");
                redirect('presensi/datapresensi');
            } else {
                $this->session->set_flashdata('pesan', "
                <script>
                   Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Terjadi error!, Gagal Disimpan',
                        })
                </script>
                ");
                redirect('presensi/tambahpresensi');
            }
        }
    }

    public function hapusabsen($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_kodepresensi');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data user berhasil dihapus</div>');
        redirect('presensi/datapresensi');
    }

    public function editdatapresensi($id)
    {
        $data['title'] = 'Form Edit Data Presensi';
        $data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['tb_kodepresensi'] = $this->db->get_where('tb_kodepresensi', ['QR' => $id])->row_array();


        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required');
        $this->form_validation->set_rules('jam_pulang', 'Jam Pulang', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('presensi/editpresensi', $data);
            $this->load->view('templates/footer');
        }
    }

    public function proseseditpresensi()
    {

        $this->M_absen->proseseditpresensi($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data presensi berhasil diupdate</div>');
        redirect('presensi/datapresensi');
    }

    public function presensimasuk($data)
    {
        $kode = decrypt_url($data);
        // echo $no_event;
        // die;

        $query1 = $this->db->query("SELECT * FROM tb_user WHERE email NOT IN ( SELECT nip_guru FROM tb_absen WHERE kode = '$kode')");
        $query1_result = $query1->result();
        $presensi['belum_absen'] = $query1_result;

        $presensi['title'] = 'Presensi Masuk';
        $presensi['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $presensi['tb_kodepresensi'] = $this->M_absen->presensibyno($kode);
        $presensi['tb_absen'] = $this->M_absen->getbykode($kode);

        $waktu_sekarang = date('Y-m-d H:i', time());
        $tanggal = $presensi['tb_kodepresensi']->tanggal;
        $jam_pulang = $presensi['tb_kodepresensi']->jam_pulang;
        $akhir = "$tanggal $jam_pulang";

        if (strtotime($waktu_sekarang) < strtotime($akhir)) {
            $presensi['berakhir'] = "masih"; //Masih
        } else {
            $presensi['berakhir'] = "berakhir"; //Beakhir
        }

        $this->load->view('templates/header', $presensi);
        $this->load->view('templates/sidebar', $presensi);
        $this->load->view('templates/topbar', $presensi);
        $this->load->view('presensi/presensimasuk', $presensi);
        $this->load->view('templates/footer');
    }

    public function sudah_absen()
    {
        if ($this->input->is_ajax_request()) {
            $kode = $this->input->post('content');

            // $presensi = $this->M_absen->absenguru($kode);
            $presensi =  $this->db->get_where('tb_absen', ['kode' => $kode])->result();

            $html = '';

            if ($presensi) {
                foreach ($presensi as $row) {
                    $tb_guru = $this->db->get_where('tb_user', ['nip' => $row->nip_guru])->row();
                    $tb_mapel = $this->db->get_where('tb_mapel', ['id' => $tb_guru->mapel_id])->row();

                    if ($row->absen_masuk == 0 && $row->izinkan == 0) {
                        $telat = '<span class="badge badge-warning mb-2">Pending</span>';
                    }
                    if ($row->absen_masuk == 0 && $row->izinkan == 1) {
                        $telat = '<span class="badge badge-primary mb-2">Izin</span>';
                    }
                    if ($row->is_telat != null && $row->is_telat == 0) {
                        $telat = '<span class="badge badge-success mb-2">Sukses</span>';
                    }
                    if ($row->is_telat != null && $row->is_telat == 1) {
                        $telat = '<span class="badge badge-danger mb-2" style="margin-left: 80px;">Terlambat</span>';
                    }
                    $html .= '
                    <div class="col-sm-3 mt-3 shadow-sm bg-white rounded">
                        <a href="#" class="friends-suggestions-list">
                            <div class="position-relative">
                                <div class="float-left mb-0 mr-3">
                                    <img src="' . base_url('assets/img/guru/') . $tb_guru->image . '" alt="" class="rounded-circle thumb-md mt-2" width=50" height ="50">
                                </div>
                                <div class="desc">
                                    <h5 class="font-14 mb-1 pt-2 text-dark">' . $tb_guru->name . '</h5>';

                    $html .= '<small>' . $tb_mapel->nama_mapel . '</small><br>';
                    $html .= '' . $telat . '
                                </div>
                            </div>
                        </a>
                    </div>
                ';
                }
            } else {
                $html .= '
                    <div class="alert alert-warning ml-3" role="alert">
                        Belum Ada Data.
                    </div>
                ';
            }

            echo $html;
        } else {
            redirect('eror');
        }
    }

    public function belum_absen_masuk()
    {
        if ($this->input->is_ajax_request()) {
            $kode = $this->input->post('content');

            $query1 = $this->db->query("SELECT * FROM tb_user WHERE nip NOT IN ( SELECT nip_guru FROM tb_absen WHERE kode = '$kode') AND role_id = 2");
            $query1_result = $query1->result();
            $belum_absen = $query1_result;

            $html = '';

            if ($belum_absen) {
                foreach ($belum_absen as $row) {
                    $tb_mapel = $this->db->get_where('tb_mapel', ['id' => $row->mapel_id])->row();
                    $html .= '
                    <div class="col-sm-3 mt-3 shadow-sm bg-white rounded">
                        <a href="#" class="friends-suggestions-list">
                            <div class="position-relative">
                                <div class="float-left mb-0 mr-3">
                                    <img src="' . base_url('assets/img/guru/') . $row->image  . '" alt="" class="rounded-circle thumb-md mt-2" width=50" height ="50">
                                </div>
                                <div class="desc">
                                    <h5 class="font-14 mb-1 pt-2 text-dark">' . $row->name . '</h5>';
                    $html .= '<small>' . $tb_mapel->nama_mapel . '</small><br>';
                    $html .= '<span class="badge badge-danger mb-2" style="margin-left: 80px;">Belum Absen</span>';
                    $html .= '</div>
                            </div>
                        </a>
                    </div>
                ';
                }
            } else {
                $html .= '
                    <div class="alert alert-success ml-3" role="alert">
                        Sudah Absen semua
                    </div>
                ';
            }

            echo $html;
        } else {
            redirect('eror');
        }
    }

    public function presensipulang($data)
    {
        $kode = decrypt_url($data);
        // $data['event'] = $this->presensi->getpresensibynoevent($no_event);
        // $data['presensi'] = $this->presensi->getbynoevent($no_event);
        $presensi['title'] = 'Presensi Pulang';
        $presensi['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $presensi['tb_kodepresensi'] = $this->M_absen->presensibyno($kode);
        $presensi['tb_absen'] = $this->M_absen->getbykode($kode);


        $waktu_sekarang = date('Y-m-d H:i', time());
        $tanggal = $presensi['tb_kodepresensi']->tanggal;
        $jam_pulang = $presensi['tb_kodepresensi']->jam_pulang;
        $akhir = "$tanggal $jam_pulang";

        if (strtotime($waktu_sekarang) < strtotime($akhir)) {
            $presensi['berakhir'] = "masih"; //Masih
        } else {
            $presensi['berakhir'] = "berakhir"; //Beakhir
        }

        $this->load->view('templates/header', $presensi);
        $this->load->view('templates/sidebar', $presensi);
        $this->load->view('templates/topbar', $presensi);
        $this->load->view('presensi/presensipulang', $presensi);
        $this->load->view('templates/footer');
    }

    public function sudah_absen_keluar()
    {
        if ($this->input->is_ajax_request()) {
            $kode = $this->input->post('content');

            $presensi =  $this->M_absen->absenguru($kode);

            $html = '';

            if ($presensi) {
                foreach ($presensi as $row) {
                    if ($row->absen_pulang != 0 || $row->izinkan == '0' || $row->izinkan == '1') {

                        $tb_guru = $this->db->get_where('tb_user', ['nip' => $row->nip_guru])->row();
                        $tb_mapel = $this->db->get_where('tb_mapel', ['id' => $tb_guru->mapel_id])->row();

                        if ($row->izinkan == '1') {
                            $telat = '<span class="badge badge-primary mb-2">Izin</span>';
                        }
                        if ($row->izinkan == '0') {
                            $telat = '<span class="badge badge-warning mb-2">Pending</span>';
                        }
                        if ($row->keterangan == "Selesai Sebelum Waktu" && $row->absen_masuk != 0 && $row->absen_pulang !== 0) {
                            $telat = '<span class="badge badge-danger mb-2" style="margin-left: 50px;">Selesai Sebelum Waktu</span>';
                        }
                        if ($row->keterangan == "Tepat Waktu" && $row->absen_masuk != 0 && $row->absen_pulang !== 0) {
                            $telat = '<span class="badge badge-success mb-2">Sukses</span>';
                        }

                        $html .= '

                            <div class="col-sm-3 mt-3 shadow-sm bg-white rounded">
                                <a href="#" class="friends-suggestions-list">
                                    <div class="position-relative">
                                        <div class="float-left mb-0 mr-3">
                                             <img src="' . base_url('assets/img/guru/') . $tb_guru->image  . '" alt="" class="rounded-circle thumb-md mt-2" width=50" height ="50">
                                        </div>
                                        <div class="desc">
                                            <h5 class="font-14 mb-1 pt-2 text-dark">' . $tb_guru->name . '</h5>';
                        $html .= '<small class="text-muted">' . $tb_mapel->nama_mapel . '</small><br>';
                        $html .= $telat;
                        $html .= '
                                        </div>
                                    </div>
                                </a>
                            </div>
                        ';
                    }
                }
            } else {
                $html .= '
                    <div class="alert alert-danger ml-3" role="alert">
                        Belum Ada Data.
                    </div>
                ';
            }

            echo $html;
        } else {
            redirect('eror');
        }
    }


    public function belum_absen_keluar()
    {
        if ($this->input->is_ajax_request()) {
            $kode = $this->input->post('content');

            $query1 = $this->db->query("SELECT * FROM tb_user WHERE nip IN ( SELECT nip_guru FROM tb_absen WHERE kode = '$kode' AND keterangan IS NULL) AND role_id = 2");
            $query1_result = $query1->result();
            $belum_absen = $query1_result;

            $html = '';

            if ($belum_absen) {
                foreach ($belum_absen as $row) {
                    $tb_mapel = $this->db->get_where('tb_mapel', ['id' => $row->mapel_id])->row();
                    $html .= '
                        <div class="col-sm-3 mt-3 shadow-sm bg-white rounded">
                            <a href="#" class="friends-suggestions-list">
                                <div class="position-relative">
                                    <div class="float-left mb-0 mr-3">
                                        <img src="' . base_url('assets/img/guru/') . $row->image  . '" alt="" class="rounded-circle thumb-md mt-2" width=50" height ="50">
                                    </div>
                                    <div class="desc">
                                        <h5 class="font-14 mb-1 pt-2 text-dark">' . $row->name . '</h5>';
                    $html .= '<small>' . $tb_mapel->nama_mapel . '</small><br>';
                    $html .= '<span class="badge badge-danger mb-2" style="margin-left: 80px;">Belum Absen</span>';
                    $html .= '</div>
                                </div>
                            </a>
                        </div>
                    ';
                }
            } else {
                $html .= '
                    <div class="alert alert-success ml-3" role="alert">
                        Sudah Absen semua
                    </div>
                ';
            }

            echo $html;
        } else {
            redirect('eror');
        }
    }



    // PERMOHONAN IZIN
    public function listpermohonan($data)
    {
        $kode = decrypt_url($data);
        $where = [
            'kode' => $kode,
            'absen_masuk' => '0',
        ];

        $presensi['title'] = 'Permohonan Izin';
        $presensi['list_izin'] = $this->db->get_where('tb_absen', $where)->result();
        $presensi['tb_kodepresensi'] = $this->db->get_where('tb_kodepresensi', ['kode' => $kode])->row();
        $presensi['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $presensi);
        $this->load->view('templates/sidebar', $presensi);
        $this->load->view('templates/topbar', $presensi);
        $this->load->view('presensi/izin', $presensi);
        $this->load->view('templates/footer');
    }

    public function izinkan()
    {
        $nip = decrypt_url($this->input->get('tb_user'));
        $kode = decrypt_url($this->input->get('tb_kodepresensi'));

        $where = [
            'kode' => $kode,
            'nip_guru' => $nip
        ];

        $this->db->set('izinkan', 1);
        $this->db->where($where);
        $this->db->update('tb_absen');

        $this->session->set_flashdata('pesan', "
                <script>
                   Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Permohonan Di izinkan',
                        })
                </script>
                ");

        redirect('presensi/listpermohonan/' . $this->input->get('tb_kodepresensi'));
    }


    public function datapresensiguru()
    {

        $data['title'] = 'Presensi';
        $data['presensi_list'] = $this->M_absen->getpresensi();
        $data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['presensi_list'] = $this->db->get('tb_kodepresensi')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('presensi/datapresensiguru', $data);
        $this->load->view('templates/footer');
    }

    public function presensimasukguru($data)
    {
        $kode = decrypt_url($data);

        $tb_guru = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row();

        if (!$tb_guru) {
            $tb_guru = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row();
        }

        $presensi['title'] = 'Presensi Masuk';
        $presensi['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $presensi['absenguru'] = $this->db->get_where('tb_absen', ['nip_guru' => $tb_guru->nip, 'kode' => $kode])->row();
        $presensi['tb_kodepresensi'] = $this->M_absen->presensibyno($kode);
        // $presensi['tb_guru'] = $this->db->get_where('tb_guru', ['NIP' => $this->session->userdata('NIP')])->row();
        $presensi['tb_guru'] = $tb_guru;
        $presensi['kode_presensi'] = $kode;
        // var_dump($presensi['absenguru']);
        // die;

        $this->load->view('templates/header', $presensi);
        $this->load->view('templates/sidebar', $presensi);
        $this->load->view('templates/topbar', $presensi);
        $this->load->view('presensi/presensimasukguru', $presensi);
        $this->load->view('templates/footer');
    }

    public function absen_masuk()
    {
        if ($this->input->is_ajax_request()) {
            $kode = decrypt_url($this->input->post('content'));
            if (!$kode) {
                echo 'tidak_ada';
                die();
            }
            $tb_kodepresensi = $this->M_absen->presensibyno($kode);
            if (!$tb_kodepresensi) {
                echo 'tidak_ada';
                die();
            }
            // var_dump($tb_kodepresensi);
            // die;

            $tb_guru = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row();

            if (!$tb_guru) {
                $tb_guru = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row();
            }
            $mapel = $this->db->get_where('tb_mapel', ['id' => $tb_guru->mapel_id])->row();

            $waktu_scan =  date('H:i', time());
            $waktu_scan2 = time();
            $batas1 = $tb_kodepresensi->jam_masuk;
            // $batas2 = intval($batas1);
            // $batas = date('H:i', $batas1);
            if ((strtotime($waktu_scan) > strtotime($batas1))) {
                $telat = 1;
            } else {
                $telat = 0;
            }
            $data = [
                'kode' => $kode,
                'nama_guru' => $tb_guru->name,
                'nip_guru' => $tb_guru->nip,
                'mapel' => $mapel->nama_mapel,
                'absen_masuk' => $waktu_scan2,
                'is_telat' => $telat,
            ];

            $this->db->insert('tb_absen', $data);
            echo 'berhasil';
        } else {
            redirect('eror');
        }
    }

    public function presensipulangguru($data_ev)
    {


        $kode = decrypt_url($data_ev);

        $tb_guru = $this->db->get_where('tb_user', ['nip' => $this->session->userdata('NIP')])->row();

        if (!$tb_guru) {
            $tb_guru = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row();
        }

        $presensi['title'] = 'Presensi Pulang';
        $presensi['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $presensi['absenguru'] = $this->db->get_where('tb_absen', ['nip_guru' => $tb_guru->nip, 'kode' => $kode])->row();
        $presensi['tb_kodepresensi'] = $this->M_absen->presensibyno($kode);
        // $presensi['tb_guru'] = $this->db->get_where('tb_guru', ['NIP' => $this->session->userdata('NIP')])->row();
        $presensi['tb_guru'] = $tb_guru;
        $presensi['kode_absensi'] = $kode;
        // var_dump($presensi['tb_kodepresensi']);
        // die;

        $this->load->view('templates/header', $presensi);
        $this->load->view('templates/sidebar', $presensi);
        $this->load->view('templates/topbar', $presensi);
        $this->load->view('presensi/presensipulangguru', $presensi);
        $this->load->view('templates/footer');
    }

    public function absen_pulang()
    {
        if ($this->input->is_ajax_request()) {
            $kode = decrypt_url($this->input->post('content'));
            $tb_kodepresensi = $this->M_absen->presensibyno($kode);
            if (!$tb_kodepresensi) {
                echo 'tidak_ada';
                die();
            }
            $tb_guru = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row();

            if (!$tb_guru) {
                $tb_guru = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row();
            }

            $cek = [
                'kode' => $kode,
                'nip_guru' => $tb_guru->nip
            ];

            $cek_sudah_absen = $this->db->get_where('tb_absen', $cek)->row();

            if (!$cek_sudah_absen) {
                echo 'sudah_absen';
                die();
            }

            $waktu_scan =  date('H:i', time());
            $waktu_scan2 = time();
            $batas1 = $tb_kodepresensi->jam_pulang;
            // $batas2 = intval($batas1);
            // $batas = date('H:i', $batas1);
            if ((strtotime($waktu_scan) < strtotime($batas1))) {
                $keterangan = "Selesai Sebelum Waktu";
            } else {
                $keterangan = "Tepat Waktu";
            }
            $data = [
                'absen_pulang' => $waktu_scan2,
                'keterangan' => $keterangan,
            ];
            $where = [
                'kode' => $kode,
                'nip_guru' => $tb_guru->nip
            ];
            $this->db->update('tb_absen', $data, $where);

            echo 'berhasil';
        } else {
            redirect('eror');
        }
    }

    public function izinguru($data_izin)
    {
        $kode = decrypt_url($data_izin);
        $presensi['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $where = [
            'kode' => $kode,
            'nip_guru' => $presensi['tb_user']['nip'],
            'absen_masuk' => '0',
            'absen_pulang' => '0',
            'izinkan !=' => null
        ];

        $where2 = [
            'kode' => $kode,
            'nip_guru' => $presensi['tb_user']['nip'],
        ];


        $data['list_izin'] = $this->db->get_where('tb_absen', $where)->row();
        $data['list_presensi'] = $this->db->get_where('tb_absen', $where2)->row();

        // var_dump($data['list_presensi']);
        // die;

        $presensi['tb_kodepresensi'] = $this->db->get_where('tb_kodepresensi', ['kode' => $kode])->row();
        $presensi['tb_guru'] = $this->db->get_where('tb_user', ['nip' => $this->session->userdata('nip')])->row();
        $presensi['title'] = 'Permohonan Izin';


        $this->load->view('templates/header', $presensi);
        $this->load->view('templates/sidebar', $presensi);
        $this->load->view('templates/topbar', $presensi);
        $this->load->view('presensi/izinguru', $data);
        $this->load->view('templates/footer');
    }

    public function kirim_izin()
    {
        $kode = decrypt_url($this->input->post('kode'));
        $tb_guru = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row();
        $tb_mapel = $this->db->get_where('tb_mapel', ['id' => $tb_guru->mapel_id])->row();

        $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|GIF|JPG|JPEG|pdf|doc|docx|';
        $config['upload_path'] = './assets/app-assets/izin/';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('suket')) {
            $suket = $this->upload->data('file_name');
            $data = [
                'kode' => $kode,
                'nama_guru' => $tb_guru->name,
                'nip_guru' => $tb_guru->nip,
                'mapel' => $tb_mapel->nama_mapel,
                'izinkan' => 0,
                'surat_ket' => $suket,
                'keterangan' => $this->input->post('keterangan')

            ];

            $sql = $this->db->insert('tb_absen', $data);

            if ($sql) {
                $this->session->set_flashdata('pesan', '
                    <script>
                         Swal.fire(
                            "Berhasil!",
                            "Izin Berhasil Dikirim",
                            "success"
                        );
                    </script>
                ');
                redirect('presensi/datapresensiguru/' . encrypt_url($kode));
            } else {
                $this->session->set_flashdata('pesan', '
                    <script>
                         Swal.fire(
                            "Oopss!",
                            "Gagal Dikirim",
                            "error"
                        );
                    </script>
                ');
                redirect('presensi/izinguru/' . encrypt_url($kode));
            }
        } else {
            $this->session->set_flashdata('pesan', '
                    <script>
                         Swal.fire(
                            "Oopss!",
                            "Gagal Dikirim",
                            "error"
                        );
                    </script>
                ');
            redirect('presensi/izinguru/' . encrypt_url($kode));
        }
    }
}
