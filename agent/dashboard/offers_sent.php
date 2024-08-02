<!DOCTYPE html>
<html lang="en">

<head>
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                        <h1 class="m-0">My Offers</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Main Content Starts Here -->
                <div class="card">
                    <div class="card-body" style="overflow-x:auto;">
                        <div class="row">
                            <div class="col-12">
                                <table id="offers-table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Athlete Picture</th>
                                            <th>Athlete Name</th>
                                            <th>Athlete Sport</th>
                                            <th>Offer Date</th>
                                            <th>Offer Duration</th>
                                            <th>Offer Amount</th>
                                            <th>Offer Status</th>
                                            <th>Offer Terms</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // GET OFFERS DATA  
                                        $agent_id = $_SESSION['agent_id'];
                                        $sql = "SELECT * FROM offers WHERE agent_id='$agent_id'";
                                        $qry = $pdo->prepare($sql);
                                        $qry->execute();
                                        if ($qry->rowCount()) {
                                            $data = $qry->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($data as $row) {
                                                $athlete_id = $row['athlete_id'];
                                                // fetch athlete info
                                                $sql = "SELECT * FROM athletes WHERE athlete_id='$athlete_id'";
                                                $qry = $pdo->prepare($sql);
                                                $qry->execute();
                                                $athlete = $qry->fetch(PDO::FETCH_ASSOC);

                                                if ($row['status'] == 0) {
                                                    $offer_status = '<span class="text-warning">Pending</span>';
                                                } elseif ($row['status'] == 1) {
                                                    $offer_status = '<span class="text-success">Accepted</span>';
                                                } elseif ($row['status'] == 2) {
                                                    $offer_status = '<span class="text-danger">Rejected</span>';
                                                }

                                                echo '
                                                    <tr>
                                                        <td><img class="img rounded" width="50" src="../../athlete/uploads/profile_pics/' . $athlete['profile_picture'] . '"></td>
                                                        <td>' . $athlete['first_name'] . " " . $athlete['last_name'] . '</td>
                                                        <td>' . $athlete['primary_sport'] . '</td>
                                                        <td>' . date('d-m-Y', strtotime($row['created_at'])) . '</td>
                                                        <td>' . $row['duration'] . ' months</td>
                                                        <td>' . $row['amount'] . '</td>
                                                        <td>' . $offer_status . '</td>
                                                        <td>' . $row['terms'] . '</td>
                                                    </tr>
                                                
                                                ';

                                            }
                                        } else {
                                            echo '
                                                    <tr>
                                                        <td colspan="8" class="text-danger"><h3>You have not sent any offers</h3></td>
                                                    </tr>
                                                ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $('#offers-table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": false,
        });
    </script>