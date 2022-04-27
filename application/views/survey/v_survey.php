<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan') ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <a class="btn btn-primary" href="<?= base_url('desa/isi_survey'); ?>"><i class="fas fa-fw fa-plus"></i> Tambah <?= $title; ?></a>
            <div class="table-responsive my-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pariwisata</th>
                            <?php foreach ($kriteria as $kr) : ?>
                            <th><?= $kr['nm_kriteria']; ?></th>
                            <?php endforeach ?>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($nilai as $n) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $n['nm_pariwisata']; ?></td>
                                <?php foreach ($n['nilai'] as $n2) : ?>
                                    <td><?= $n2['nm_subkriteria']; ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <a class="btn btn-success" href="<?= base_url('desa/edit_survey/') . $n2['id_pariwisata']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                    <a class="btn btn-danger" data-toggle="modal" data-target="#hapusModalWis"><i class="fas fa-fw fa-trash"></i></a>
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

<!-- Hapus Modal-->
<div class="modal fade" id="hapusModalWis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Yakin ingin menghapus data?</h5>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</a>
                <a class="btn btn-danger" href="<?= base_url('desa/hapus_survey/') . $w['id_pariwisata']; ?>">Ya</a>
            </div>
        </div>
    </div>
</div>