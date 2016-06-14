<?php $this->layout('layout') ?>

<?php $this->start('page') ?>
    <h2>Transaksi <?= $this->e($kode) ?></h2>
    <form action="<?= $base_url ?>/transaksi/add/<?= $this->e($kode) ?>" method="post">
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
                <h4>Matakuliah</h4>
            </div>
        </div>

        <?php for($i=1; $i <= $jumlah; $i++){ ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control" id="matakuliah<?= $i?>" name="matakuliah<?= $i?>">
                        <option></option>
                        <?php foreach($matakuliah as $row) { ?>
                        <option value="<?= $row["kode"] ?>"><?= $row["kode"]." ".$row["nama"] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <?php } ?>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <script>
        var collection = {};

        <?php for($i=1; $i <= $jumlah; $i++){ ?>

        collection["matakuliah<?= $i?>"] = $("#matakuliah<?= $i?>").val();

        $("#matakuliah<?= $i?>" ).on("change", function() {
            if (collection["matakuliah<?= $i?>"] != ""){
              // set flag sebelumnya ke o
              $.ajax({
                url: "<?= $base_url ?>/matakuliah/json/unflag/<?= $this->e($nim)[0] ?>/" + collection["matakuliah<?= $i?>"]
              }).done(function( data ) {
                console.log(data);
              });
            }

            // set flag ke 1
            $.ajax({
                url: "<?= $base_url ?>/matakuliah/json/flag/<?= $this->e($nim)[0] ?>/" + $("#matakuliah<?= $i?>").val()
            }).done(function( data ) {
              console.log(data)
            });
            collection["matakuliah<?= $i?>"] = $("#matakuliah<?= $i?>").val();
        });
        <?php } ?>
    </script>
<?php $this->stop() ?>
