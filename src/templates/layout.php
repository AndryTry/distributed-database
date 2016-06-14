<html>
    <head>
        <title>Basis Data Terdistribusi</title>
        <link href="<?= $base_url ?>/static/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= $base_url ?>/static/assets/combobox/bootstrap-combobox.css" rel="stylesheet" />
        <script src="<?= $base_url ?>/static/assets/jquery/jquery.min.js"></script>
        <script src="<?= $base_url ?>/static/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= $base_url ?>/static/assets/combobox/bootstrap-combobox.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= $base_url ?>/">Home</a></li>
                        <li><a href="<?= $base_url ?>/mahasiswa">Mahasiswa</a></li>
                        <li><a href="<?= $base_url ?>/matakuliah">Matakuliah</a></li>
                        <li><a href="<?= $base_url ?>/transaksi">Transaksi</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->section('page')?>
                </div>
            </div>
        </div>
    </body>
</html>
