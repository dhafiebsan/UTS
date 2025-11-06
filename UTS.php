<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS Web 2</title>
</head>

<body>
    <fieldset>
        <table>
            <form action="" method="POST">
                <tr>
                    <td><label for="">Nama</label></td>
                    <td>:</td>
                    <td>
                        <select name="Nama">
                            <?php
                            $NamaAnggota = ["Dhafi", "Budi", "Mas Helgi", "Mas Io", "Mas Reza"];
                            foreach ($NamaAnggota as $Nama) {
                                echo "<option>" . $Nama . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Posisi</label></td>
                    <td>:</td>
                    <td>
                        <select name="Posisi">
                            <?php
                            $PosisiTim = ["Lead Development", "QA Engineer", "DevOps Engineer", "Backend Dev", "Frontend Dev"];
                            foreach ($PosisiTim as $Posisi) {
                                echo "<option>" . $Posisi . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="">Jam Kerja/bulan</label></td>
                    <td>:</td>
                    <td><input class="input" type="number" name="JamKerja"></td>
                </tr>
                <tr>
                    <td><label for="">Harga Proyek</label></td>
                    <td>:</td>
                    <td><input class="input" type="number" name="HargaProyek"></td>
                </tr>
                <tr>
                    <td colspan="3"><input class="submit" type="submit" name="submit"></td>
                </tr>
            </form>
        </table>
    </fieldset>

    <?php
    $NamaAnggota = ($_POST["Nama"] ?? "");
    $PosisiTim =  ($_POST["Posisi"] ?? "");
    $JamKerja = (int)($_POST["JamKerja"] ?? 0);
    $HargaProyek = (float)($_POST["HargaProyek"] ?? 0);

    $JamNormal = 160;

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

    if(isset($_POST["submit"])){
        echo "Nama Anggota : " . $NamaAnggota . "<br>";
        echo "Posisi : " . $PosisiTim . "<br>";
        echo "Jam Kerja : " . $JamKerja . "<br>";
        echo "Harga Proyek : Rp." . number_format((float)($HargaProyek), 0, ",", ".") . "<br>";
        echo "Fee : Rp." . number_format((float)($JumlahFee), 0, ",", ".") . "<br>";
        echo "Total Gaji : Rp." . number_format((float)($TotalGaji), 0, ",", ".");
    }
    ?>
</body>

</html>