<?php

class M_absen extends CI_Model
{

    public function getpresensi()
    {
        $this->db->select('*');
        $this->db->from('tb_kodepresensi');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result_array();
    }

    public function presensibyno($data)
    {
        return $this->db->get_where('tb_kodepresensi', ['kode' => $data])->row();
    }

    public function getall()
    {
        $this->db->select("*");
        $this->db->from('tb_absen');
        $this->db->join('tb_kodepresensi', 'tb_kodepresensi.kode = tb_absen.kode');
        return $this->db->get()->result();
    }

    public function getbykode($data)
    {
        $this->db->select("*");
        $this->db->from('tb_absen');
        $this->db->join('tb_kodepresensi', 'tb_kodepresensi.kode = tb_absen.kode');
        $this->db->where('tb_absen.kode', $data);
        return $this->db->get()->result();
    }

    public function absenguru($data1)
    {
        $this->db->select("*");
        $this->db->from('tb_absen');
        $this->db->join('tb_kodepresensi', 'tb_kodepresensi.kode = tb_absen.kode');
        $this->db->where('tb_absen.kode', $data1);
        return $this->db->get()->result();
    }

    public function absenguru1($data1, $data2)
    {
        $this->db->select("*");
        $this->db->from('tb_absen');
        $this->db->join('tb_kodepresensi', 'tb_kodepresensi.kode = tb_absen.kode');
        $this->db->where('tb_absen.kode', $data1);
        $this->db->where('tb_absen.nip_guru', $data2);
        return $this->db->get()->row();
    }

    public function insert_bulk($data)
    {
        return $this->db->insert_batch('tb_absen', $data);
    }

    public function getmapel()
    {
        return $this->db->get('tb_mapel')->result();
    }

    public function getclassbykode($data)
    {
        return $this->db->get_where('tb_mapel', ['kode' => $data])->row();
    }


    public function getuser()
    {
        $this->db->select("*");
        $this->db->from('tb_user');
        $this->db->join('tb_mapel', 'tb_mapel.kode = tb_user.role_id');
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result();
    }

    public function getuserbyemail($data)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_mapel', 'tb_mapel.kode = tb_user.role_id');
        $this->db->where('tb_user.email', $data);
        return $this->db->get()->row();
    }




    public function ambil_id_presensi($id)
    {
        return $this->db->get_where('tb_kodepresensi', ['id' => $id])->row_array();
    }

    public function proseseditpresensi()
    {

        $data = [
            "hari" => $this->input->post('hari'),
            "tanggal" => $this->input->post('tanggal'),
            "jam_masuk" => $this->input->post('jam_masuk'),
            "jam_pulang" => $this->input->post('jam_pulang'),
        ];



        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tb_kodepresensi', $data);
    }
}
