<div class="container fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('dinas/tambah_pengguna'); ?>">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="<?= set_value('email') ?>">
                    <?= form_error('email', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?= set_value('username') ?>">
                    <?= form_error('username', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" name="telp" value="<?= set_value('telp') ?>">
                    <?= form_error('telp', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                    <?= form_error('password', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="id_level" class="form-control">
                        <option value="">Pilih role</option>
                        <?php
                        if ($r['level'] == 1) {
                            $r['level'] = 'Dinas';
                        } else {
                            $r['level'] = 'Desa';
                        }
                        ?>
                        <option value="1" <?= set_select('id_level', '1', TRUE); ?>>Dinas</option>
                        <option value="2" <?= set_select('id_level', '1', TRUE); ?>>Desa</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>