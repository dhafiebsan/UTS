<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS Web 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <div class="card-shadow">
            <div class="card-header bg-primary text-white rounded">
                <h4 class="mb-0 p-2">Form Perhitungan Gaji Proyek</h4>
            </div>
        </div>
        <div class="card-body mt-3">
            <form action="" method="POST">
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="">Nama</label>
                    <div class="col-sm-9">
                        <select name="Nama" class="form-select">
                            <?php
                            $NamaAnggota = ["Dhafi", "Budi", "Mas Helgi", "Mas Io", "Mas Reza"];
                            foreach ($NamaAnggota as $Nama) {
                                echo "<option>" . $Nama . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="">Posisi</label>
                    <div class="col-sm-9">
                        <select name="Posisi" class="form-select">
                            <?php
                            $PosisiTim = ["Lead Development", "QA Engineer", "DevOps Engineer", "Backend Dev", "Frontend Dev"];
                            foreach ($PosisiTim as $Posisi) {
                                echo "<option>" . $Posisi . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="">Jam Kerja/bulan</label>
                    <div class="col-sm-9">
                        <input type="number" name="JamKerja" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="">Harga Proyek</label>
                    <div class="col-sm-9">
                        <input type="number" name="HargaProyek" class="form-control">
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" name="submit" class="btn btn-success">Hitung Gaji</button>
                </div>
            </form>
        </div>
    </div>
    <fieldset>
        <table>

        </table>
    </fieldset>

    <?php
    $NamaAnggota = ($_POST["Nama"] ?? "");
    $PosisiTim =  ($_POST["Posisi"] ?? "");
    $JamKerja = (int)($_POST["JamKerja"] ?? 0);
    $HargaProyek = (float)($_POST["HargaProyek"] ?? 0);

    $JamNormal = 160;
    $UpahKerja = 0;
    $PersenUpahLembur = 0;
    $PersenFee = 0;
    $TotalUpahKerja = 0;
    $TotalUpahLembur = 0;
    $TotalGaji = 0;

    if ($PosisiTim == "Lead Development") {
        $UpahKerja = 450000; //upah kerja per jam
        $PersenUpahLembur = 0.18 * $UpahKerja; //upah lembur per jam
        $PersenFee = 0.05;
    } elseif ($PosisiTim == "QA Engineer") {
        $UpahKerja = 250000;
        $PersenUpahLembur = 0.12 * $UpahKerja;
        $PersenFee = 0.01;
    } elseif ($PosisiTim == "DevOps Engineer") {
        $UpahKerja = 350000;
        $PersenUpahLembur = 0.1 * $UpahKerja;
        $PersenFee = 0.025;
    } elseif ($PosisiTim == "Backend Dev") {
        $UpahKerja = 300000;
        $PersenUpahLembur = 0.15 * $UpahKerja;
        $PersenFee = 0.03;
    } elseif ($PosisiTim == "Frontend Dev") {
        $UpahKerja = 300000;
        $PersenUpahLembur = 0.15 * $UpahKerja;
        $PersenFee = 0.03;
    }

    $JumlahFee = $HargaProyek * $PersenFee;

    if ($JamKerja > $JamNormal) {
        $TotalUpahKerja = $JamNormal * $UpahKerja;
        $TotalUpahLembur = (($UpahKerja * $PersenUpahLembur) + $UpahKerja) * ($JamKerja - $JamNormal);
        $TotalGaji = $TotalUpahKerja + $TotalUpahLembur + $JumlahFee;
    } else {
        $TotalGaji = ($JamKerja * $UpahKerja) + $JumlahFee;
    }

    if (isset($_POST["submit"])) {
        echo '<div class="container mt-4">';
        echo '<div class="card">';
        echo '<div class="card-header bg-info text-white"><strong>Hasil Perhitungan Gaji</strong></div>';
        echo '<div class"card-body">';
        echo '<table class="table table-bordered">';
        echo '<tr><th>Nama Anggota</th><td>' . $NamaAnggota . '</td></tr>';
        echo '<tr><th>Posisi</th><td>' . $PosisiTim . '</td></tr>';
        echo '<tr><th>Jam Kerja</th><td>' . $JamKerja . '</td></tr>';
        echo '<tr><th>Harga Proyek</th><td>Rp.' . number_format((float)($HargaProyek), 0, ",", ".") . '</td></tr>';        echo "<tr><th>Fee</th><td>Rp." . number_format((float)($JumlahFee), 0, ",", ".") . '</td></tr>';
        echo '<tr class="table-success"><th>Total Gaji</th><td><strong>Rp.' . number_format((float)($TotalGaji), 0, ",", ".") . '</strong></td></tr>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</body>

</html>