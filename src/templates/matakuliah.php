<?php $this->layout('layout') ?>

<?php $this->start('page') ?>
    <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#modalMatakuliah">Tambah matakuliah</a>
    <h2>Data matakuliah</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>kode</td>
                <td>nama matakuliah</td>
                <td>semester</td>
                <td>jumlah sks</td>
                <td>action</td>
                <td>server</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($matakuliah as $row) { ?>
            <tr>
                <td><?= $row["kode"] ?></td>
                <td><?= $row["nama"] ?></td>
                <td><?= $row["semester"] ?></td>
                <td><?= $row["sks"] ?></td>
                <td>
                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                        <a class="btn btn-danger" href="<?= $base_url ?>/matakuliah/delete/<?=$row["kode"] ?>" role="button">hapus</a>
                        <a class="btn btn-primary" href="<?= $base_url ?>/matakuliah/edit/<?=$row["kode"] ?>" role="button">edit</a>
                    </div>
                </td>
                <td><?= $row["server"] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id=modalMatakuliah class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Masukan kode</h4>
                </div>
                <div class="modal-body">
                    <form class="form" action="<?= $base_url ?>/matakuliah/add", method="get">
                        <div class="form-group">
                            <input type="text" name="kode" class="form-control" placeholder="kode">
                        </div>
                        <button type="submit" class="btn btn-default">simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $this->stop() ?>
