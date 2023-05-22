<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Presensi <?= $bulan; ?></title>
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <h2>Laporan Absensi</h2>
    <p>Periode : <?= $bulan; ?></p>
    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>NAMA</th>
                <th>NIP</th>
                <th>Mapel</th>
                <th>Absen Masuk</th>
                <th>Keterangan</th>
                <th>Absen Pulang</th>
                <th>Keterangan Akhir</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($tb_kodepresensi as $kp) : ?>

                <?php $tb_absen = $this->db->get_where('tb_absen', ['kode' => $kp->kode])->result(); ?>
                <?php foreach ($tb_absen as $tba) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $kp->tanggal; ?></td>
                        <td><?= $tba->nama_guru; ?></td>
                        <td><?= $tba->nip_guru; ?></td>
                        <td><?= $tba->mapel; ?></td>
                        <?php

                        if ($tba->absen_masuk == '0' && $tba->izinkan == '0') {
                            echo '<td>' . "Pending" . '</td>';
                        }
                        if ($tba->absen_masuk == '0' && $tba->izinkan == '1') {
                            echo '<td>' . "izin" . '</td>';
                        }
                        if ($tba->absen_masuk != '0') {
                            echo '<td>' . date('H:i', $tba->absen_masuk) . '</td>';
                        }
                        ?>

                        <?php
                        if ($tba->absen_masuk == '0' && $tba->izinkan == '0') {
                            echo '<td>' . "Pending" . '</td>';
                        }
                        if ($tba->absen_masuk == '0' && $tba->izinkan == '1') {
                            echo '<td>' . "Izin" . '</td>';
                        }
                        if ($tba->is_telat != null && $tba->is_telat == '0') {
                            echo '<td>' . "Sukses" . '</td>';
                        }
                        if ($tba->is_telat != null && $tba->is_telat == '1') {
                            echo '<td>' . "Terlambat" . '</td>';
                        }
                        ?>

                        <?php
                        if ($tba->absen_masuk == '0' && $tba->izinkan == '0') {
                            echo '<td>' . "Pending" . '</td>';
                        }
                        if ($tba->absen_masuk == '0' && $tba->izinkan == '1') {
                            echo '<td>' . "izin" . '</td>';
                        }
                        if ($tba->absen_masuk != '0' && $tba->absen_pulang == '0') {
                            echo '<td>-</td>';
                        }
                        if ($tba->absen_masuk != '0' && $tba->absen_pulang != '0') {
                            echo '<td>' . date('H:i', $tba->absen_pulang) . '</td>';
                        }
                        ?>

                        <?php
                        if ($tba->absen_masuk != '0' && $tba->absen_pulang == '0') {
                            echo '<td>Bolos</td>';
                        } else {
                            echo '<td>' . $tba->keterangan . '</td>';
                        }
                        ?>

                    </tr>
                <?php endforeach; ?>

                <?php
                $query1 = $this->db->query("SELECT * FROM tb_user WHERE nip NOT IN ( SELECT nip_guru FROM tb_absen WHERE kode = '$kp->kode') AND role_id = 2");
                $query1_result = $query1->result();
                $belum_absen = $query1_result;
                ?>
                <?php foreach ($belum_absen as $ba) : ?>
                    <?php $mapel = $this->db->get_where('tb_mapel', ['id' => $ba->mapel_id])->row(); ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $kp->tanggal; ?></td>
                        <td><?= $ba->name; ?></td>
                        <td><?= $ba->nip; ?></td>
                        <td><?= $mapel->nama_mapel; ?></td>
                        <td>belum absen</td>
                        <td>belum absen</td>
                        <td>belum absen</td>
                        <td>
                            Aplha
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>