<?php $this->layout('layout') ?>

<?php $this->start('page') ?>
    <h2>Edit mahasiswa <?= $this->e($nim) ?></h2>
    <form action="<?= $base_url ?>/mahasiswa/add" method="post">
        <input type="hidden" name="nim" value="<?= $this->e($nim) ?>">
        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" class="form-control" id="nim" placeholder="nim" disabled value="<?= $this->e($nim) ?>">
        </div>
        <div class="form-group">
            <label for="nama">nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="<?= $this->e($nama) ?>">
        </div>
        <div class="form-group">
            <label for="alamat">alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" value="<?= $this->e($alamat) ?>">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
<?php $this->stop() ?>
