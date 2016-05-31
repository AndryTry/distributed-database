<?php $this->layout('layout') ?>

<?php $this->start('page') ?>
    <h2>Transaksi <?= $this->e($kode) ?></h2>
    <form action="/transaksi/add/<?= $this->e($kode) ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" name="jumlah" value="<?= $this->e($jumlah) ?>">
                <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" class="form-control" id="kode" placeholder="kode" disabled value="<?= $this->e($kode) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <input type="hidden" name="nim" value="<?= $this->e($nim) ?>">
                <div class="form-group">
                    <label for="nim">Nim</label>
                    <input type="text" class="form-control" name="nim" id="nim" placeholder="nim" disabled value="<?= $this->e($nim) ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tahun_akademik">Tahun akademik</label>
                    <input type="text" class="form-control" name="tahun_akademik" id="tahun_akademik" placeholder="tahun akademik" value="<?= $this->e($tahun_akademik) ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="text" class="form-control" name="semester" id="semester" placeholder="semester" value="<?= $this->e($semester) ?>">
                </div>
            </div>
        </div>
        <h3>Matakuliah</h3>
        <div class="row">
            <div class="col-md-3">
                <h4>Kode matakuliah</h4>
            </div>
            <div class="col-md-9">
                <h4>Nama matakuliah</h4>
            </div>
        </div>

        <?php for($i=1; $i <= $jumlah; $i++){ ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="matakuliah<?= $i?>" id="matakuliah<?= $i?>" placeholder="kode kuliah <?= $i ?>" value="<?= $this->e($matakuliah[$i]["kode_matakuliah"]) ?>">
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="nama matakuliah <?= $i ?>" id="nama_matakuliah<?= $i?>" disabled value="<?= $this->e($matakuliah[$i]["nama_matakuliah"]) ?>">
                </div>
            </div>
        </div>
        <?php } ?>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <script>
        <?php for($i=1; $i <= $jumlah; $i++){ ?>
        $("#matakuliah<?= $i?>" ).keyup(function() {
            $.ajax({
                url: "http://localhost:5000/matakuliah/json/get/<?= $this->e($nim)[0] ?>/" + $("#matakuliah<?= $i?>").val()
            }).done(function( data ) {
                var nama = $.parseJSON(data)["nama"];
                $("#nama_matakuliah<?= $i?>").val(nama);
                console.log(nama)
            });
        });
        <?php } ?>
    </script>
<?php $this->stop() ?>