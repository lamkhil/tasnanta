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
                            <th style="text-align: center; vertical-align: middle;">Total Poin</th>
                            <th style="text-align: center; vertical-align: middle;">Build Status</th>
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
                                <td><?= $no++; ?></td>
                                <td><?= explode(" ", $w['tgl'])[0]; ?></td>
                                <td><?= explode(" ", $w['tgl'])[1]; ?></td>
                                <td><?= $w['nm_pariwisata']; ?></td>
                                <td><?= $w['alamat']; ?></td>
                                <td><?= round($w['total_saw'],2); ?></td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <a class="btn btn-info btn-sm" href="<?= base_url('dinas/pemeringkatan/#') ?>"><i class="fas fa-fw fa-envelope"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$('#dataTable').DataTable();
$(document).ready(function () {
  $('#dataTable').DataTable({
    "aaSorting": [],
    columnDefs: [{
    orderable: false,
    targets: 0
    },
    {
    orderable: false,
    targets: 1
    },
    {
    orderable: false,
    targets: 2
    },
    {
    orderable: false,
    targets: 3
    },
    {
    orderable: false,
    targets: 4
    },
    {
    orderable: false,
    targets: 6
    }]
  });
    $('.dataTables_length').addClass('bs-select');
});
</script>
<!-- /.container-fluid -->