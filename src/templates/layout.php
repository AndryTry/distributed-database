<html>
    <head>
        <title>Basis Data Terdistribusi</title>
        <link href="/static/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li><a href="/mahasiswa">Mahasiswa</a></li>
                        <li><a href="/matakuliah">Matakuliah</a></li>
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

        <script src="/static/assets/jquery/jquery.min.js"></script>
        <script src="/static/assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>