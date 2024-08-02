<!DOCTYPE html>
<html lang="en">

<style>
    .carousel-inner img {
        max-height: 200px !important;
    }
</style>

<head>
    <title>AthleteConnect | Agent</title>

    <!-- include Header here -->
    <?php
    require_once("../components/header.php");
    require_once('../php_processing/db_connect.php');
    ?>
    <!-- Header Ends here -->



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Athletes List</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Main Content Starts Here -->
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM athletes";
                    $qry = $pdo->prepare($sql);
                    $qry->execute();
                    if ($qry->rowCount()) {
                        // also make array from athletes and agents ids combination from offers table to check that if a specific athlete has been offered by this agent already
                        $sql_2 = "SELECT * FROM offers";
                        $qry_2 = $pdo->prepare($sql_2);
                        $qry_2->execute();
                        $offers = array();
                        $agent_id = $_SESSION['agent_id'];
                        if ($qry_2->rowCount()) {
                            $offers_data = $qry_2->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($offers_data as $offers_row) {
                                array_push($offers, $offers_row['agent_id'] . "," . $offers_row['athlete_id']);
                            }
                        }

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
                                                        src="../../athlete/uploads/sport_pics/<?php echo $sport_pic_1; ?>"
                                                        alt="First Sport Picture">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100"
                                                        src="../../athlete/uploads/sport_pics/<?php echo $sport_pic_2; ?>"
                                                        alt="Second Sport Picture">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100"
                                                        src="../../athlete/uploads/sport_pics/<?php echo $sport_pic_3; ?>"
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
                                                            $athlete_id = $row['athlete_id'];
                                                            $combination = $agent_id . "," . $athlete_id;
                                                            $status = 0;
                                                            if (in_array($combination, $offers)) {
                                                                echo '
                                                                        <a class="btn btn-warning btn-block" href="#">Already Offered</a>
                                                                    ';
                                                            } else {
                                                                echo '
                                                                        <a class="btn btn-success btn-block" href="submit_offer.php?id=' . $row['athlete_id'] . '">Offer Now</a>
                                                                    ';
                                                            }
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
                    } else {
                        echo '<h3 class="text-danger">No Athletes Registered</h3>';
                    }
                    ?>
                </div>
                <!-- Main Content Ends Here -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Include Footer Here -->
    <?php
    require_once("../components/footer.php");
    ?>