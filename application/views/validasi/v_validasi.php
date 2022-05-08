<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm my-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">No</th>
                            <th style="text-align: center; vertical-align: middle;">Tgl</th>
                            <th style="text-align: center; vertical-align: middle;">Waktu</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Pariwisata</th>
                            <th style="text-align: center; vertical-align: middle;">Alamat</th>
                            <th style="text-align: center; vertical-align: middle;">Status Validasi</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($wisata as $w) : ?>
                            <?php
                            if ($w['id_status'] == 0) {
                                $w['id_status'] = '<button class="btn btn-danger btn-sm">Tidak Valid</button>';
                            } else {
                                $w['id_status'] = '<button class="btn btn-success btn-sm">Valid</button>';
                            }
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?= $no++; ?></td>
                                <td><?= explode(" ", $w['tgl'])[0]; ?></td>
                                <td><?= explode(" ", $w['tgl'])[1]; ?></td>
                                <td><?= $w['nm_pariwisata']; ?></td>
                                <td><?= $w['alamat']; ?></td>
                                <td style="text-align: center; vertical-align: middle;"><?= $w['id_status']; ?>
                                </td>
                                <td style="text-align: center; vertical-align: middle; white-space:nowrap">
                                    <a class="btn btn-info btn-sm" href="<?= base_url('dinas/validasi/') . $w['id_pariwisata']; ?>">Validasi</a>
                                    <a class="btn btn-info btn-sm" href="<?= base_url('dinas/edit_validasi/') . $w['id_pariwisata']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->