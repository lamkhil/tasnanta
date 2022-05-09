<div class="container fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= base_url('dinas/tambah_pengguna/'.$argument); ?>">
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
                    <label><?=$argument == 'desa'? 'Nama Desa':'Nama Lengkap' ?></label>
                    <input type="text" class="form-control" name="nama_lengkap" value="<?= set_value('nama_lengkap') ?>">
                    <?= form_error('nama_lengkap', '<div class="text-danger small">', '</div>') ?>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                    <?= form_error('password', '<div class="text-danger small">', '</div>') ?>
                </div>
                <input type="hidden" id="id_level" name="id_level" value=<?=$argument == 'desa'?2:1?>>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>