<?php

function kode()
{
    $ci = get_instance();

    $data = $ci->db->get('tb_kodepresensi')->last_row();
    if ($data) {
        $kode = $data->kode;

        // mengambil angka dari kode Produk terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($kode, 5, 4);

        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG
        $huruf = "KD-";
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    } else {
        return 'KD-001';
    }
}

function is_admin()
{
    $ci = get_instance();

    $data = [
        'email' => $ci->session->userdata('email'),
        'role_id' => $ci->session->userdata('role_id'),
    ];

    if ($data) {
        if ($data['role_id'] != 1) {
            redirect('eror');
        }
    } else {
        redirect('tb_user');
    }
}

function is_guru()
{
    $ci = get_instance();

    $data = [
        'email' => $ci->session->userdata('email'),
        'role_id' => $ci->session->userdata('role_id'),
    ];

    if ($data) {
        if ($data['role'] != 2) {
            redirect('eror');
        }
    } else {
        redirect('tb_user');
    }
}
