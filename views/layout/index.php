<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zakat</title>
    <link rel="icon" type="image/png" href="/views/img/zakat (1).png">

    <!-- Bootstrap Jtable CSS CDN -->
    <!-- <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js" /> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>
        @media (min-width: 992px) {
            .desktop {
                display: block;
            }

            .mobile {
                display: none;
            }
        }

        @media (max-width: 991px) {
            .desktop {
                display: none;
            }

            .mobile {
                display: block;
            }
        }

        .news-marquee {
            overflow: hidden;
            background-color: rgba(113, 117, 120, 0.105);
            white-space: nowrap;
            box-sizing: border-box;
            position: sticky;
            top: 56px;
            height: 40px;
            line-height: 40px;
            z-index: 1020;
        }

        .news-content {
            display: flex;
            /* position: absolute; */
            white-space: nowrap;
            animation: scrollNews 50s linear infinite;
        }

        .news-item {
            display: inline-block;
            margin-right: 150px;
        }

        @keyframes scrollNews {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }
        }

        ::-webkit-scrollbar {
            width: 12px;
        }

        * {
            scrollbar-width: thin;
        }

        /* .shadow-dark {
            box-shadow: 0 1px 3px 1px rgba(151, 151, 151, 0.5), 0 0px 20px 1px rgba(0, 0, 0, 0.61);
        } */

        .shadow-white {
            box-shadow: 1px 1px 1px 0 rgba(255, 255, 255, 0.389), 0 0px 30px 0 rgba(4, 4, 4, 0.648);
        }

        .shadow-dark {
            box-shadow: 1px 1px 1px 0 rgba(0, 0, 0, 0.389), 0 0px 30px 0 rgba(4, 4, 4, 0.648);
        }

        .line {
            flex-grow: 1;
            height: 1px;
            background-color: #5a5a5a;
            /* Ganti warna sesuai tema */
        }

        .round {
            border-radius: 20px;
        }
    </style>
</head>

<body style="color: white; background-color: rgb(28, 32, 35);">

    <?php
    include 'navbar.php';
    ?>

    <!-- main content -->
    <div class="container-fluid">
        <?php
        include $content;
        ?>
    </div>

    <br>
    <br>
    <br>

    <?php
    include 'footer.php';
    ?>



    <!-- jtable js cdn -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- <script type="text/javascript"
                    src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script> -->

    <script>
        new DataTable('#example');
    </script>

    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('dynamicForm');
            const inputContainer = document.getElementById('inputContainer');

            function addInputField() {
                const newInputGroup = document.createElement('div');
                newInputGroup.classList.add('input-group', 'mb-3', 'inputField');
                newInputGroup.innerHTML = `
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" name="rincian[]" required placeholder="Rincian...">
                    <button class="btn btn-light deleteButton" type="button"><i class="bi bi-trash3"></i></button>
                    <div class="invalid-feedback">
                        Silahkan isikan rincian, jika tidak ada rincian hapus inputannya
                    </div>
                `;
                inputContainer.appendChild(newInputGroup);
                updateDeleteButtons();
            }

            function updateDeleteButtons() {
                document.querySelectorAll('.deleteButton').forEach(button => {
                    button.onclick = function() {
                        this.parentElement.remove();
                    }
                });
            }

            updateDeleteButtons();
            document.querySelector('.addInputButton').addEventListener('click', addInputField);
        });
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('dynamicForm2');
            const inputContainer = document.getElementById('inputContainer2');

            function addInputField() {
                const newInputGroup = document.createElement('div');
                newInputGroup.classList.add('input-group', 'mb-3', 'inputField2');
                newInputGroup.innerHTML = `
                <textarea name="" id="" class="form-control" name="keterangan[]" required placeholder="keterangan..."></textarea>
                <button class="btn btn-light deleteButton2" type="button"><i class="bi bi-trash3"></i></button>
                <div class="invalid-feedback">
                    Silahkan isikan keterangan, jika tidak ada keterangan hapus inputannya
                </div>
                `;
                inputContainer.appendChild(newInputGroup);
                updateDeleteButtons();
            }

            function updateDeleteButtons() {
                document.querySelectorAll('.deleteButton2').forEach(button => {
                    button.onclick = function() {
                        this.parentElement.remove();
                    }
                });
            }

            updateDeleteButtons();
            document.querySelector('.addInputButton2').addEventListener('click', addInputField);
        });
    </script>

    <!-- Chart Js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart js -->
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
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

    <!-- Bootstrap Js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>