<?php $this->layout('layout') ?>

<?php $this->start('page') ?>
    <h2>Edit transaksi <?= $this->e($kode) ?></h2>
    <form action="/transaksi/add/<?= $this->e($kode) ?>" method="post">
        <input type="hidden" name="jumlah" value="<?= $this->e($jumlah) ?>">
        <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" class="form-control" id="kode" placeholder="kode" disabled value="<?= $this->e($kode) ?>">
        </div>
        <div class="form-group">
            <label for="nim">Nim</label>
            <input type="text" class="form-control" name="nim" id="nim" placeholder="nim" value="<?= $this->e($nim) ?>">
        </div>
        <div class="form-group">
            <label for="tahun_akademik">Tahun akademik</label>
            <input type="text" class="form-control" name="tahun_akademik" id="tahun_akademik" placeholder="tahun akademik" value="<?= $this->e($tahun_akademik) ?>">
        </div>
        <div class="form-group">
            <label for="semester">Semester</label>
            <input type="text" class="form-control" name="semester" id="semester" placeholder="semester" value="<?= $this->e($semester) ?>">
        </div>

        <h3>Matakuliah</h3>
        <?php for($i=1; $i <= $jumlah; $i++){ ?>
        <div class="form-group">
            <label for="matakuliah">Matakuliah <?= $i?></label>
            <input type="text" class="form-control" name="matakuliah<?= $i?>" id="matakuliah" placeholder="mata kuliah <?= $i ?>" value="<?= $this->e($matakuliah[$i]["kode_matakuliah"]) ?>">
        </div>
        <?php } ?>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
<?php $this->stop() ?>