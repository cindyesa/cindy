<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Poliklinik</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./dist/css/welcome_styles.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to bottom right, #117fb6, #11B69F);
            font-family: Arial, sans-serif;
            color: white;
        }

        .navbar {
            background-color: rgba(17, 182, 159, 0.9) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.1);
        }

        .card-custom {
            border: 2px solid black;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.85);
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .card-custom h2 {
            color: #117fb6;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .card-custom p {
            color: #333;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #11B69F;
            border-color: #11B69F;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background-color: #0E8D82;
            border-color: #0E8D82;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
        }

        a.text-decoration-none {
            text-decoration: none;
        }

        section {
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
    </style>
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="">POLIKLINIK BK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <?php if ($muncul) : ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="http://<?= $_SERVER['HTTP_HOST'] ?>/cindy/pages/<?= $arah ?>">Dashboard</a></li>
                    </ul>
                </div>
            <?php endif ?>
        </div>
    </nav>

    <!-- Features section-->
    <?php if (!$muncul) : ?>
        <section class="py-5 border-bottom" id="features">
            <div class="container px-5 my-5">
                <div class="row gx-5 d-flex flex-column text-center">
                    <div class="col-lg-6 mb-5 mx-auto">
                        <div class="card card-custom p-4">
                            <h2 class="h4 fw-bolder">Dokter</h2>
                            <p>Login untuk Dokter</p>
                            <a class="text-decoration-none" href="http://<?= $_SERVER['HTTP_HOST'] ?>/cindy/pages/auth/login.php">
                                <button class="btn btn-primary">Login</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container px-5 my-5">
                <div class="row gx-5 d-flex flex-column text-center">
                    <div class="col-lg-6 mb-5 mx-auto">
                        <div class="card card-custom p-4">
                            <h2 class="h4 fw-bolder">Pasien</h2>
                            <p>Login untuk Pasien</p>
                            <a class="text-decoration-none" href="http://<?= $_SERVER['HTTP_HOST'] ?>/cindy/pages/auth/login-pasien.php">
                                <button class="btn btn-primary">Login</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endif ?>
    <?php include('footer.php'); ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
