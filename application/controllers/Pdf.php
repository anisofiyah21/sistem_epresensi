<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_presensi', 'tb_user');
        $this->load->model('M_presensi', 'tb_guru');
        $this->load->model('M_presensi', 'tb_mapel');
        $this->load->model('M_absen', 'tb_absen');
        date_default_timezone_set('Asia/Jakarta');
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        is_admin();
    }

    // public function absensi($data)
    // {
    //     base_url('assets/img/');

    //     $kode = decrypt_url($data);
    //     $tb_kodepresensi = $this->M_absen->presensibyno($kode);
    //     $presensi = $this->M_absen->absenguru($kode);

    //     $nama_file = 'Absensi ' . $kode->hari;
    //     $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
    //     $mpdf->SetHTMLHeader('<div style="text-align: left; margin-left: 20px; font-weight: bold;">
    //     <img src="' . base_url() . 'assets/img/rb.png" width="120px" style="margin-top: 20px;" alt="">
    //     </div>', 'O');
    //     $mpdf->SetHTMLHeader('<div style="text-align: left; margin-left: 20px; font-weight: bold;">
    //     <img src="' . base_url() . 'assets/img/rb.png" width="120px" style="margin-top: 20px;" alt="">
    //     </div>', 'E');

    //     $mpdf->SetHTMLFooter('
    //     <table border="0" width="100%" style="vertical-align: bottom; font-family: serif; 
    //         font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border: none;">
    //         <tr border="0">
    //             <td width="33%" style="text-align: left; border: none;">{DATE j-m-Y}</td>
    //             <td width="33%" align="center" style="border: none;">{PAGENO}/{nbpg}</td>
    //             <td width="33%" style="text-align: right; border: none;">E-Presensi SMK Ifadah</td>
    //         </tr>
    //     </table>');  // Note that the second parameter is optional : default = 'O' for ODD

    //     $mpdf->SetHTMLFooter('
    //     <table border="0" width="100%" style="vertical-align: bottom; font-family: serif; 
    //         font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
    //         <tr border="0">
    //             <td width="33%"><span style="font-weight: bold; font-style: italic;">E-Presensi SMK Ifadah/span></td>
    //             <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
    //             <td width="33%" style="text-align: left; ">{DATE j-m-Y}</td>
    //         </tr>
    //     </table>', 'E');

    //     $html = '
    //         <html lang="en">
    //         <head>
    //             <meta charset="UTF-8">
    //             <meta name="viewport" content="width=device-width, initial-scale=1.0">
    //             <title>Report</title>
    //             <style>
    //                 body{
    //                     font-family: sans-serif;
    //                 }
    //                 table{
    //                     border: 0.1px solid #708090;
    //                 }
    //                 tr td{
    //                     text-align: center;
    //                     border: 0.1px solid #708090;
    //                     font-weight: 20;
    //                 }
    //                 tr th{
    //                     border: 0.1px solid #708090;
    //                 }
    //                 input[type=text] {
    //                     border: none;
    //                     background: transparent;
    //                 }
    //             </style>
    //         </head>

    //         <body>
    //         <h2 style="text-align: center;">SISTEM E-PRESENSI<br><small>SMK IFADAH</small></h2>
    //             <p style="text-align: center;">jl. KH. Umar, Kejawan, Sukolilo Timur., Kec. Labang, Kabupaten Bangkalan, Jawa Timur 69163</p>
    //             <hr>
    //             <center>
    //                 <table width="100%" align="center" style="border: none;">
    //                     <tr>
    //                         <th style="border: none;">Nomor Absen</th>
    //                         <th style="border: none;">Nama Absen</th>
    //                         <th style="border: none;">Tanggal</th>
    //                         <th style="border: none;">Jam</th>
    //                     </tr>
    //                     <tr>
    //                         <td style="border: none; background: trasparent">' . $tb_kodepresensi->kode . '</td>
    //                         <td style="border: none; background: trasparent">' . $tb_kodepresensi->hari . '</td>
    //                         <td style="border: none; background: trasparent">' . $tb_kodepresensi->tanggal . '</td>
    //                         <td style="border: none; background: trasparent">' . $tb_kodepresensi->jam_masuk . '-' . $tb_kodepresensi->jam_pulang . '</td>
    //                     </tr>
    //                 </table>
    //             </center>
    //             <hr>
    //                 <h4 style="text-align: center;">List Sudah Presensi</h4>
    //             <table border="0.1" cellpadding="10" cellspacing="0" width="100%">
    //                 <tr>
    //                     <th>NAMA Guru</th>
    //                     <th>NIP</th>
    //                     <th>MAPEL</th>
    //                     <th>ABSEN MASUK</th>
    //                     <th>KETERANGAN</th>
    //                     <th>ABSEN PULANG</th>
    //                     <th>KETERANGAN AKHIR</th>
    //                 </tr>';
    //     $mapel = $this->db->get('tb_mapel')->result();
    //     foreach ($presensi as $p) {
    //         $html .= '<tr>';
    //         $html .= '<td>' . $p->nama_guru . '</td>';
    //         $html .= '<td>' . $p->nip_guru . '</td>';
    //         $html .= '<td>' . $p->mapel . '</td>';
    //         if ($p->absen_masuk == 0 && $p->izinkan == 0) {
    //             $html .= '<td>' . "Pending" . '</td>';
    //         }
    //         if ($p->absen_masuk == 0 && $p->izinkan == 1) {
    //             $html .= '<td>' . "izin" . '</td>';
    //         }
    //         if ($p->absen_masuk != 0) {
    //             $html .= '<td>' . date('H:i', $p->absen_masuk) . '</td>';
    //         }


    //         if ($p->absen_masuk == 0 && $p->izinkan == 0) {
    //             $html .= '<td>' . "Pending" . '</td>';
    //         }
    //         if ($p->absen_masuk == 0 && $p->izinkan == 1) {
    //             $html .= '<td>' . "Izin" . '</td>';
    //         }
    //         if ($p->is_telat != null && $p->is_telat == 0) {
    //             $html .= '<td>' . "Sukses" . '</td>';
    //         }
    //         if ($p->is_telat != null && $p->is_telat == 1) {
    //             $html .= '<td>' . "Terlambat" . '</td>';
    //         }

    //         if ($p->absen_masuk == 0 && $p->izinkan == 0) {
    //             $html .= '<td>' . "Pending" . '</td>';
    //         }
    //         if ($p->absen_masuk == 0 && $p->izinkan == 1) {
    //             $html .= '<td>' . "izin" . '</td>';
    //         }
    //         if ($p->absen_masuk != 0 && $p->absen_pulang == 0) {
    //             $html .= '<td>-</td>';
    //         }
    //         if ($p->absen_masuk != 0 && $p->absen_pulang != 0) {
    //             $html .= '<td>' . date('H:i', $p->absen_pulang) . '</td>';
    //         }

    //         if ($p->absen_masuk != 0 && $p->absen_keluar == 0) {
    //             $html .= '<td>Bolos</td>';
    //         } else {
    //             $html .= '<td>' . $p->keterangan . '</td>';
    //         }
    //         $html .= '</tr>';
    //     }
    //     $html .= '</table>';
    //     $html .=
    //         '
    //         <h4 style="text-align: center;">List Belum Presensi</h4>
    //             <table border="0.1" cellpadding="10" cellspacing="0" width="100%">
    //                 <tr>
    //                     <th>NAMA GURU</th>
    //                     <th>NIP</th>
    //                     <th>MAPEL</th>
    //                 </tr>
    //     ';
    //     $query1 = $this->db->query("SELECT * FROM tb_guru WHERE NIP NOT IN ( SELECT nip_guru FROM tb_absen WHERE kode = '$kode')");
    //     $query1_result = $query1->result();
    //     $belum_absen = $query1_result;

    //     foreach ($belum_absen as $belum) {
    //         $html .= '<tr>';
    //         $html .= '<td>' . $belum->nama_guru . '</td>';
    //         $html .= '<td>' . $belum->NIP . '</td>';
    //         foreach ($mapel as $mpl) {
    //             if ($mpl->kode == $belum->Mapel) {
    //                 $html .= '<td>' . $mpl->nama_mapel . '</td>';
    //             }
    //         }
    //         $html .= '</tr>';
    //     }
    //     $html .= '
    //             </table>
    //             </body>
    //             </html>
    //             ';

    //     $mpdf->WriteHTML($html);
    //     $mpdf->Output("$nama_file.pdf", \Mpdf\Output\Destination::INLINE);
    // }

    public function exportqr($data)
    {
        $kode = decrypt_url($data);
        $tb_kodepresensi = $this->db->get_where('tb_kodepresensi', ['kode' => $kode])->row();

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $mpdf->SetHTMLHeader('<div style="text-align: left; margin-left: 20px; font-weight: bold;">
        <img src="' . base_url() . 'assets/img/ifadah.PNG" width="110px" style="margin-top: 20px;" alt="">
        </div>', 'O');
        $mpdf->SetHTMLHeader('<div style="text-align: left; margin-left: 20px; font-weight: bold;">
        <img src="' . base_url() . 'assets/img/ifadah.PNG" width="110px" style="margin-top: 20px;" alt="">
        </div>', 'E');

        $mpdf->SetHTMLFooter('
        <table border="0" width="100%" style="vertical-align: bottom; font-family: serif; 
            font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border: none;">
            <tr border="0">
                <td width="33%" style="text-align: left; border: none;">{DATE j-m-Y}</td>
                <td width="33%" align="center" style="border: none;">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right; border: none;">E-Presensi SMK IFADAH</td>
            </tr>
        </table>');  // Note that the second parameter is optional : default = 'O' for ODD

        $mpdf->SetHTMLFooter('
        <table border="0" width="100%" style="vertical-align: bottom; font-family: serif; 
            font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
            <tr border="0">
                <td width="33%"><span style="font-weight: bold; font-style: italic;">E-Presensi SMK Ifadah/span></td>
                <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: left; ">{DATE j-m-Y}</td>
            </tr>
        </table>', 'E');

        $html = '
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Report</title>
                <style>
                    body{
                        font-family: sans-serif;
                    }
                    table{
                        border: 0.1px solid #708090;
                    }
                    tr td{
                        text-align: center;
                        border: 0.1px solid #708090;
                        font-weight: 20;
                    }
                    tr th{
                        border: 0.1px solid #708090;
                    }
                    input[type=text] {
                        border: none;
                        background: transparent;
                    }
                </style>
            </head>

            <body>
                <h2 style="text-align: center;">SISTEM E-PRESENSI<br><small>SMK IFADAH</small></h2>
                <p style="text-align: center;">jl. KH. Umar, Kejawan, Sukolilo Timur.,<br> Kec. Labang, Kabupaten Bangkalan, Jawa Timur 69163</p>
                <hr>
                <p style="text-align: center; font-weight: bold;">QR Code Presensi ' . $tb_kodepresensi->hari . '</p>
                <div style="display: flex; justify-content: center">
                    <img src="' . '' . base_url() . 'assets/app-assets/qr/img/' . $tb_kodepresensi->QR . '" alt="Gambar Qr">
                </div>
                <script>
                    setTimeout(() => {
                        window.print();
                    }, 500);
                </script>
            </body>
            </html>';

        echo $html;

        // $mpdf->WriteHTML($html);
        // $mpdf->Output("$nama_file.pdf", \Mpdf\Output\Destination::INLINE);
    }
}
