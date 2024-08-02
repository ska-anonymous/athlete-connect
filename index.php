<?php
require_once('athlete/php_processing/db_connect.php');
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <title>Athlete Connect | Landig page</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .carousel-inner img {
            max-height: 200px !important;
        }
    </style>


</head>

<body>
    <header data-bs-theme="dark">
        <div class="collapse bg-dark text-light" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4>About</h4>
                        <p class="text-body-secondary">At Athlete Connect, we are passionate about connecting athletes
                            with their dreams. Our platform serves as a bridge, bringing together talented athletes and
                            influential agents, fostering opportunities for success. We believe in empowering athletes
                            to showcase their skills, while providing agents with a platform to discover and nurture
                            exceptional talent. Join us on this journey to unlock your potential and make your mark in
                            the world of sports.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4>Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Follow on Twitter</a></li>
                            <li><a href="#" class="text-white">Like on Facebook</a></li>
                            <li><a href="#" class="text-white">Email me</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <strong>
                        <img style="filter:invert(1)" src="dist/img/athlete-logo.png" width="100" alt="">
                    </strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>

    <main>

        <section class="py-5 text-center text-light"
            style="background: url('https://source.unsplash.com/random/900x500/?athlete,sports') no-repeat center center/cover;">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto" style="background:#00000073;">
                    <h1 class="fw-light">Athlete Connect</h1>
                    <p class="lead text-light">Unlock the Power of Connection: Athlete Connect - Your Gateway
                        to Success. Seamlessly Connect with Elite Athletes, Empowering Agents, and Unleash your Full
                        Potential in the Sporting Arena.</p>
                    <p>
                        <a href="agent" class="btn btn-primary my-2">Login as Agent</a>
                        <a href="athlete" class="btn btn-secondary my-2">Login As Athlete</a>
                    </p>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM athletes LIMIT 9";
                    $qry = $pdo->prepare($sql);
                    $qry->execute();
                    if ($qry->rowCount()) {
                        $data = $qry->fetchAll(PDO::FETCH_ASSOC);
                        $i = 0;
                        foreach ($data as $row) {
                            $i++;
                            $carousel_id = 'carousel_' . $i;
                            $sport_pictures = explode('|next|', $row['sport_pictures']);
                            $sport_pic_1 = '';
                            $sport_pic_2 = '';
                            $sport_pic_3 = '';
                            if (isset($sport_pictures[0])) {
                                $sport_pic_1 = $sport_pictures[0];
                            }
                            if (isset($sport_pictures[1])) {
                                $sport_pic_2 = $sport_pictures[1];
                            }
                            if (isset($sport_pictures[2])) {
                                $sport_pic_3 = $sport_pictures[2];
                            }
                            ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <?php echo $row['first_name'] . " " . $row['last_name']; ?>
                                        </h3>
                                        <span class="float-right">
                                            <?php echo $row['primary_sport']; ?>
                                        </span>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div id="<?php echo $carousel_id; ?>" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#<?php echo $carousel_id; ?>" data-slide-to="0" class="active">
                                                </li>
                                                <li data-target="#<?php echo $carousel_id; ?>" data-slide-to="1"></li>
                                                <li data-target="#<?php echo $carousel_id; ?>" data-slide-to="2"></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100"
                                                        src="athlete/uploads/sport_pics/<?php echo $sport_pic_1; ?>"
                                                        alt="First Sport Picture">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100"
                                                        src="athlete/uploads/sport_pics/<?php echo $sport_pic_2; ?>"
                                                        alt="Second Sport Picture">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100"
                                                        src="athlete/uploads/sport_pics/<?php echo $sport_pic_3; ?>"
                                                        alt="Third Sport Picture">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#<?php echo $carousel_id; ?>" role="button"
                                                data-slide="prev">
                                                <span class="carousel-control-custom-icon" aria-hidden="true">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#<?php echo $carousel_id; ?>" role="button"
                                                data-slide="next">
                                                <span class="carousel-control-custom-icon" aria-hidden="true">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <div class="mt-2" style="height:80px; overflow-y:auto;">
                                            <b>Achievements:</b>
                                            <?php echo $row['athletic_achievements']; ?>
                                        </div>
                                        <div class="card collapsed-card mt-2">
                                            <div class="card-header">
                                                <h3 class="card-title">Details</h3>

                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                            class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body" style="overflow-x:auto;">
                                                <table style="width:100%;">
                                                    <tr>
                                                        <th>Gender</th>
                                                        <td>
                                                            <?php echo $row['gender']; ?>
                                                        </td>
                                                        <th>Age</th>
                                                        <td>
                                                            <?php echo date('Y') - date('Y', strtotime($row['date_of_birth'])); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hieght</th>
                                                        <td>
                                                            <?php echo $row['height']; ?> in
                                                        </td>
                                                        <th>Weight</th>
                                                        <td>
                                                            <?php echo $row['weight']; ?> kg
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>City</th>
                                                        <td>
                                                            <?php echo $row['city']; ?>
                                                        </td>
                                                        <th>Country</th>
                                                        <td>
                                                            <?php echo $row['country']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Education</th>
                                                        <td>
                                                            <?php echo $row['education_level']; ?>
                                                        </td>
                                                        <th>Nationality</th>
                                                        <td>
                                                            <?php echo $row['nationality']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Secondary Sports</th>
                                                        <td colspan="3">
                                                            <?php echo $row['secondary_sports']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Awards</th>
                                                        <td colspan="3">
                                                            <?php echo $row['awards']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td colspan="3">
                                                            <?php echo $row['address']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <?php
                                                            echo '
                                                                <a class="btn btn-success btn-block" href="agent/dashboard/submit_offer.php?id=' . $row['athlete_id'] . '">Offer Now</a>
                                                                    ';
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    </main>

    <footer class="text-body-secondary py-5 bg-dark text-light">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#" class="text-light">Back to top</a>
            </p>
            <p class="mb-1 text-light">© 2023 Athlete Connect. All rights reserved. | Privacy Policy | Terms of Service
                | Contact
                Us</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

</body>

</html>