<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Majukan Pembangunan Wisata Daerah Anda</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('desa/isi_survey'); ?>">
                <div class="form-group">
                    <label>Nama Pariwisata</label>
                    <input type="text" class="form-control" name="nm_pariwisata" value="<?= set_value('nm_pariwisata'); ?>">
                    <?= form_error('nm_pariwisata', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" value="<?= set_value('alamat'); ?>">
                    <?= form_error('alamat', '<div class="text-danger small">', '</div>') ?>
                </div>
                <?php foreach ($kriteria as $kr) : ?>
                    <div class="form-group">
                        <label name="id_kriteria"><?= $kr['nm_kriteria']; ?></label>
                        <select name="id_subkriteria" class="form-control">
                            <option value="">----- Pilih Opsi -----</option>
                            <?php foreach ($subkriteria as $sk) : ?>
                                <?php if ($kr['id_kriteria'] == $sk['id_kriteria']) { ?>
                                    <option value="<?= $sk['nilai']; ?>"><?= $sk['nm_subkriteria']; ?></option>
                            <?php }
                            endforeach; ?>
                        </select>
                        <?= form_error('nm_kriteria', '<div class="text-danger small">', '</div>') ?>
                    </div>
                <?php endforeach ?>
                <button type="submit" class="btn btn-primary">Simpan</button>


                
            </form>
        </div>
    </div>