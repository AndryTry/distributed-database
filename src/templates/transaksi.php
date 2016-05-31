<?php $this->layout('layout') ?>

<?php $this->start('page') ?>
    <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#modalTransaksi">Tambah transaksi</a>
    <h2>Data transaksi</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>kode</td>
                <td>nim</td>
                <td>tahun akademik</td>
                <td>semester</td>
                <td>action</td>
                <td>server</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($transaksi as $row) { ?>
            <tr>
                <td><?= $row["kode"] ?></td>
                <td><?= $row["nim"] ?></td>
                <td><?= $row["tahun_akademik"] ?></td>
                <td><?= $row["semester"] ?></td>
                <td>
                    <div class="btn-group btn-group-xs" role="group" aria-label="...">
                        <a class="btn btn-danger" href="/transaksi/delete/<?=$row["kode"] ?>" role="button">hapus</a>
                        <a class="btn btn-primary" href="/transaksi/edit/<?=$row["kode"] ?>" role="button">edit</a>
                    </div>
                </td>
                <td><?= $row["server"] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id=modalTransaksi class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Masukan nim</h4>
                </div>
                <div class="modal-body">
                    <form class="form" action="/transaksi/add" method="get">
                        <div class="form-group">
                            <input type="text" name="nim" class="form-control" placeholder="nim">
                        </div>
                        <div class="form-group">
                            <input type="text" name="jumlah" class="form-control" placeholder="jumlah transaksi">
                        </div>
                        <button type="submit" class="btn btn-default">simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $this->stop() ?>