<?php
require "./functions.php";

$mahasiswa = query_select("SELECT * FROM mahasiswa");

$result = mysqli_query($conn, "SELECT * FROM mahasiswa");
$mahasiswa = [];

while ($row = mysqli_fetch_assoc($result)) {
    array_push($mahasiswa, $row);
}

$tik = 0;
$te = 0;
$an = 0;
$ts = 0;
$tm = 0;
$ak = 0;
$tgp = 0;

for ($i = 0; $i < count($mahasiswa); $i++) {

    if (strcmp($mahasiswa[$i]['jurusan'], " Teknik Informatika dan Komputer") == 0) {
        $tik++;
    } else if (strcmp($mahasiswa[$i]['jurusan'], " Teknik Elektro") == 0) {
        $te++;
    } else if (strcmp($mahasiswa[$i]['jurusan'], " Administrasi Niaga") == 0) {
        $an++;
    } else if (strcmp($mahasiswa[$i]['jurusan'], " Teknik Sipil") == 0) {
        $ts++;
    } else if (strcmp($mahasiswa[$i]['jurusan'], " Teknik Mesin") == 0) {
        $tm++;
    } else if (strcmp($mahasiswa[$i]['jurusan'], " Akuntansi") == 0) {
        $ak++;
    } else {
        $tgp++;
    }
}

?>

<!DOCTYPE html>
<html lang="en" data-theme="corporate">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data In Chart</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="w-full py-10 flex items-center justify-center flex-col">

    <div class="flex items-center">
        <div class="w-[400px]">
            <canvas id="doughnut-container"></canvas>
        </div>
        <div class="w-[1000px]">
            <canvas id="bar-container"></canvas>
        </div>
    </div>
    <div class="flex items-center">
        <div class="w-[400px]">
            <canvas id="polararea-container"></canvas>
        </div>
        <div class="w-[1000px]">
            <canvas id="line-container"></canvas>
        </div>
    </div>

    <a href="index.php" class="btn btn-sm mt-5">view table</a>

    <script>
    const configData = {
        data: {
            datasets: [{
                data: [
                    <?=$tik?>,
                    <?=$te?>,
                    <?=$an?>,
                    <?=$ts?>,
                    <?=$tm?>,
                    <?=$ak?>,
                    <?=$tgp?>
                ]
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                "Teknik Informatika",
                "Teknik Elektro",
                "Administrasi Niaga",
                "Teknik Sipil",
                "Teknik Mesin",
                "Akuntansi",
                "Teknik Grafika dan Penerbitan"
            ]
        },
    };


    const doughnutContainer = document.querySelector('#doughnut-container')
    const barContainer = document.querySelector('#bar-container');
    const polarareaContainer = document.querySelector('#polararea-container');
    const lineContainer = document.querySelector('#line-container');

    new Chart(doughnutContainer, {
        type: 'doughnut',
        ...configData
    });

    new Chart(barContainer, {
        type: 'bar',
        ...configData,
    })

    new Chart(polarareaContainer, {
        type: 'polarArea',
        ...configData,
    })

    new Chart(lineContainer, {
        type: 'line',
        ...configData
    })
    </script>
</body>

</html>