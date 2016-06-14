<?php $this->layout('layout') ?>

<?php $this->start('page') ?>
    <h2>Edit matakuliah <?= $this->e($kode) ?></h2>
    <form action="<?= $base_url ?>/matakuliah/add/<?= $this->e($kode) ?>" method="post">
        <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" class="form-control" id="kode" placeholder="kode" disabled value="<?= $this->e($kode) ?>">
        </div>
        <div class="form-group">
            <label for="nama">nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="<?= $this->e($nama) ?>">
        </div>
        <div class="form-group">
            <label for="semester">semester</label>
            <input type="text" class="form-control" id="semester" name="semester" placeholder="semester" value="<?= $this->e($semester) ?>">
        </div>
        <div class="form-group">
            <label for="sks">sks</label>
            <input type="text" class="form-control" id="sks" name="sks" placeholder="sks" value="<?= $this->e($sks) ?>">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
<?php $this->stop() ?>
