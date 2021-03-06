<?php $this->layout('layout') ?>

<?php $this->start('page') ?>
    <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#modalMahasiswa">Tambah mahasiswa</a>
    <h2>Data mahasiswa</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>nim</td>
                <td>nama</td>
                <td>alamat</td>
                <td>action</td>
                <td>server</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($mahasiswa as $row ){ ?>
            <tr>
                <td><?= $row["nim"] ?></td>
                <td><?= $row["nama"] ?></td>
                <td><?= $row["alamat"] ?></td>
                <td>
                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                        <a class="btn btn-danger" href="<?= $base_url ?>/mahasiswa/delete/<?= $row["nim"] ?>" role="button">hapus</a>
                        <a class="btn btn-primary" href="<?= $base_url ?>/mahasiswa/edit/<?= $row["nim"] ?>" role="button">edit</a>
                    </div>
                </td>
                <td><?= $row["server"] ?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id=modalMahasiswa class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Masukan nim</h4>
                </div>
                <div class="modal-body">
                    <form class="form" action="<?= $base_url ?>/mahasiswa/add" method="get">
                        <div class="form-group">
                            <input type="text" name="nim" class="form-control" placeholder="nim">
                        </div>
                        <button type="submit" class="btn btn-default">simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $this->stop() ?>
