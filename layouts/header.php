<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Custom CSS -->
    <style>
        /* Navbar */
        .navbar {
            background-color: #11B69F !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .navbar a.nav-link {
            color: white !important;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar a.nav-link:hover {
            color: #117fb6 !important;
        }

        .navbar .dropdown-menu {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .navbar .dropdown-menu a {
            color: #117fb6 !important;
            font-weight: bold;
        }

        .navbar .dropdown-menu a:hover {
            background-color: #11B69F !important;
            color: white !important;
        }

        /* Sidebar */
        .main-sidebar {
            background-color: #117fb6 !important;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar {
            background: linear-gradient(180deg, #117fb6, #11B69F);
            color: white;
            font-weight: bold;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .sidebar a.nav-link {
            color: white !important;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar a.nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2) !important;
            transform: scale(1.05);
        }

        .sidebar .nav-icon {
            color: white !important;
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .user-panel {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 10px;
            color: white;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .user-panel .info a {
            color: white !important;
            font-weight: bold;
            font-size: 1rem;
        }

        .user-panel .info a:hover {
            text-decoration: underline;
        }

        /* Animations */
        .sidebar-menu li.nav-item:hover {
            transform: translateX(5px);
            transition: transform 0.3s ease-in-out;
        }

        .navbar a.nav-link i {
            transition: transform 0.3s ease;
        }

        .navbar a.nav-link:hover i {
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- User Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="http://<?= $_SERVER['HTTP_HOST'] ?>/cindy/pages/auth/destroy.php" class="dropdown-item">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar bg-primary">
            <!-- User Panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">Hai, <?= ucwords($_SESSION['username']) ?></a>
                </div>
            </div>

                    <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Menambahkan menu Logout -->
                    <?php if ($_SESSION['akses'] == 'admin') : ?>
                        <li class="nav-item">
                            <a href="<?= $base_admin ?>" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $base_admin . '/dokter' ?>" class="nav-link">
                                <i class="nav-icon fas fa-user-md"></i>
                                <p>Dokter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $base_admin . '/pasien' ?>" class="nav-link">
                                <i class="nav-icon fas fa-user-injured"></i>
                                <p>Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $base_admin . '/poli' ?>" class="nav-link">
                                <i class="nav-icon fas fa-hospital"></i>
                                <p>Poli</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $base_admin . '/obat' ?>" class="nav-link">
                                <i class="nav-icon fas fa-pills"></i>
                                <p>Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://<?= $_SERVER['HTTP_HOST']?>/cindy/pages/auth/destroy.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    <?php elseif ($_SESSION['akses'] == 'dokter') : ?>
                        <li class="nav-item">
                            <a href="<?= $base_dokter ?>" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $base_dokter . '/jadwal_periksa' ?>" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>Jadwal Periksa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $base_dokter . '/memeriksa_pasien' ?>" class="nav-link">
                                <i class="nav-icon fas fa-stethoscope"></i>
                                <p>Memeriksa Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $base_dokter . '/riwayat_pasien' ?>" class="nav-link">
                                <i class="nav-icon fas fa-notes-medical"></i>
                                <p>Riwayat Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $base_dokter . '/profil' ?>" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="http://<?= $_SERVER['HTTP_HOST']?>/cindy/pages/auth/destroy.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a href="<?= $base_pasien ?>" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $base_pasien . '/poli' ?>" class="nav-link">
                                <i class="nav-icon fas fa-hospital"></i>
                                <p>Poli</p>
                            </a>
                        <li class="nav-item">
                            <a href="http://<?= $_SERVER['HTTP_HOST']?>/cindy/pages/auth/destroy.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</body>

</html>
