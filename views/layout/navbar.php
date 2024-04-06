    <!-- navbar top -->
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <?php
            if ($type === "auth") {
            ?>
                <button class="btn btn-light desktop" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" style="border-radius: 100px; width: 7%; margin-right: 1%;"><i class="bi bi-list"></i>
                    Menu</button>
                <ul class="navbar-nav me-auto mobile">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Login</a></li>
                            <li><a class="dropdown-item" href="#">Register</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-in-right"></i> Kembali</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi bi-box-arrow-in-right"></i> Kembali</a>
                        </li>
                    </ul>
                </div>
            <?php
            } else {
            ?>
                <button class="btn btn-light desktop" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" style="border-radius: 100px; width: 7%; margin-right: 1%;"><i class="bi bi-list"></i>
                    Menu</button>
                <!-- <img class="desktop" src="/views/img/zakat (1).png" alt="zakat" width="2%"> -->
                <!-- <a class="navbar-brand" href="#">Dashboard</a> -->
                <!-- <div class="collapse navbar-collapse"></div> -->
                <img class="mobile" src="/views/img/zakat (1).png" alt="zakat" width="10%">
                <div class="d-flex">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Hai, Rifky Aryo <sup><i class="bi bi-circle-fill" style="color: green; font-size: 80%;">On</i></sup></a>
                        </li>
                    </ul>
                </div>
            <?php
            }
            ?>
        </div>
    </nav>

    <!-- navbar bottom -->
    <nav class="navbar navbar-expand navbar-expand-lg fixed-bottom mobile bg-dark border-top border-body" data-bs-theme="dark">
        <ul class="navbar-nav nav-justified w-100">
            <li class="nav-item">
                <a href="/home" class="nav-link {{ $title === 'Home' ? 'active' : '' }}"><i class="bi bi-house-fill" style="font-size: 25px;"></i></a>
            </li>
            <li class="nav-item">
                <a href="/saham" class="nav-link {{ $title === 'Saham' ? 'active' : '' }}{{ $title === 'Crypto' ? 'active' : '' }}{{ $title === 'Forex' ? 'active' : '' }}"><i class="bi bi-file-bar-graph-fill" style="font-size: 25px;"></i></a>
            </li>
            <li class="nav-item">
                <a href="/profile" class="nav-link {{ $title === 'profile' ? 'active' : '' }}"><i class="bi bi-person-fill" style="font-size: 25px;"></i></a>
            </li>
        </ul>
    </nav>

    <!-- menu -->
    <div class="offcanvas offcanvas-start text-bg-dark" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <?php
        if ($type == "auth") {
        ?>
            <!-- login -->
            <div class="container">
                <nav class="navbar" data-bs-theme="dark">
                    <div class="container-fluid">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?= $title === "login" ? "active" : "" ?>" href="/login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $title === "register" ? "active" : "" ?>" href="/register">Register</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#"><i class="bi bi-box-arrow-in-right"></i> Kembali</a>
                            </li> -->
                        </ul>
                    </div>
                </nav>
            </div>

        <?php
        } else {
        ?>
            <!-- dashboard -->
            <div class="container">
                <nav class="navbar" data-bs-theme="dark">
                    <div class="container-fluid">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?= $title === "dashboard" ? "active" : "" ?>" aria-current="page" href="/dashboard"><i class="bi bi-house-door"></i> Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $title === "form" ? "active" : "" ?>" href="/form"><i class="bi bi-pencil-square"></i> Form Zakat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $title === "verif-zakat" ? "active" : "" ?>" href="/verifikasi-zakat"><i class="bi bi-check2-square"></i> Verifikasi Zakat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $title === "table" ? "active" : "" ?>" href="/table"><i class="bi bi-file-bar-graph"></i> Data Zakat</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-gear"></i> Pengaturan
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="\maintenance"><i class="bi bi-person-circle"></i> Profile</a></li>
                                    <!-- <li><a class="dropdown-item" href="#">Another action</a></li> -->
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/logout"> <i class="bi bi-box-arrow-in-right"></i> Log Out</a></li>
                                </ul>
                            </li>
                            <!-- <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li> -->
                        </ul>
                        <form class="d-flex mt-4" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- running text -->
    <div class="news-marquee">
        <div class="news-content">
            <span class="news-item">Zakat V2.0</span>
            <span class="news-item">Selamat Menunaikan Ibadah Puasa 1445 H</span>
            <span class="news-item">Dalam keheningan bulan suci, warna-warni doa dan kesyukuran melukis hati.</span>
            <span class="news-item">Ramadhan, lukisan indah di palet cinta dan kedamaian.</span>
        </div>
    </div>