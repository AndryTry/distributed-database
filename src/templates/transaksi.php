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
                        <a class="btn btn-danger" href="<?= $base_url ?>/transaksi/delete/<?=$row["kode"] ?>" role="button">hapus</a>
                        <a class="btn btn-primary" href="<?= $base_url ?>/transaksi/edit/<?=$row["kode"] ?>" role="button">edit</a>
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
                    <form class="form" action="<?= $base_url ?>/transaksi/add" method="get">
                        <div class="form-group">
                            <select class="form-control" id="nim" name="nim">
                                <option></option>
                                <?php foreach($mahasiswa as $row) { ?>
                                <option value="<?= $row["nim"] ?>"><?= $row["nim"]." ".$row["nama"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function() {
        $('#nim').combobox  ();
      });
    </script>
<?php $this->stop() ?>
