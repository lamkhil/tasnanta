<div class="container fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('desa/edit_survey/') . $wisata['id_pariwisata']; ?>">
                <div class="form-group">
                    <label>Nama Pariwisata</label>
                    <input type="text" class="form-control" name="nm_pariwisata" value="<?= $wisata['nm_pariwisata']; ?>">
                    <?= form_error('nm_pariwisata', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" value="<?= $wisata['alamat']; ?>">
                    <?= form_error('alamat', '<div class="text-danger small">', '</div>') ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>