<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('dinas/edit_validasi/') . $wisata['id_pariwisata']; ?>">
                <div class="form-group">
                    <label>Status</label>
                    <select name="id_status" class="form-control">
                        <?php
                        if ($wisata['status'] == 0) {
                            $wisata['status'] = 'Tidak Valid';
                        } else {
                            $wisata['status'] = 'Valid';
                        }
                        ?>
                        <option value="0" <?php if ($wisata['id_status'] == 0) echo "selected"; ?>>Tidak Valid</option>
                        <option value="1" <?php if ($wisata['id_status'] == 1) echo "selected"; ?>>Valid</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>