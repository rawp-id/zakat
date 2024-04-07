<!-- Dashboard -->
<div class="container mt-4">
    <h3>Dashboard</h3>
    <!-- <hr> -->
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 30px;">
                <div class="card-body mt-2 mb-3">
                    <h5 class="card-title">Grafik Zakat</h5>
                    <hr>
                    <canvas id="myChart" width="3" height="1.5"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12">
            <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 25px;">
                <div class="card-body mt-2 mb-2">
                    <h5 class="card-title">Total Zakat</h5>
                    <hr>
                    <h1><?= $total ?> Orang</h1>
                </div>
            </div>
            <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 25px;">
                <div class="card-body mt-2 mb-2">
                    <h5 class="card-title">Total Massa</h5>
                    <hr>
                    <h1><?= $massa ?> Kg</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart Js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart js -->
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php
                foreach ($daily as $data) {
                    echo '"' . $data['tanggal'] . '"' . ",";
                }
                ?>
            ],
            datasets: [{
                label: '# of Votes',
                data: [
                    <?php
                    foreach ($daily as $data) {
                        echo $data['total'] . ",";
                    }
                    ?>
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>