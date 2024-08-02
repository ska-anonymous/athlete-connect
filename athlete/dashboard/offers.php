<!DOCTYPE html>
<html lang="en">

<head>
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <title>AthleteConnect | Athlete</title>

    <!-- include Header here -->
    <?php
    require_once("../components/header.php");
    require_once('../php_processing/db_connect.php');
    ?>
    <!-- Header Ends here -->
    <?php
    // change the offer status
    if (isset($_POST['btn_accept'])) {
        $offer_id = $_POST['btn_accept'];
        // check if this athlete has already accepted someone else offer
        $athlete_id = $_SESSION['athlete_id'];
        $sql = "SELECT * FROM offers WHERE athlete_id='$athlete_id' AND status='1'";
        $qry = $pdo->prepare($sql);
        $qry->execute();
        if ($qry->rowCount()) {
            $offer_accepted = $qry->fetch(PDO::FETCH_ASSOC);
            $agent_id = $offer_accepted['agent_id'];
            $sql = "SELECT first_name,last_name FROM agents WHERE agent_id='$agent_id'";
            $qry = $pdo->prepare($sql);
            $qry->execute();
            $agent_data = $qry->fetch(PDO::FETCH_ASSOC);
            $agent_name = $agent_data['first_name'] . " " . $agent_data['last_name'];
            $error_message = "You have already accepted $agent_name Offer. You can Only accept 1 offer";
        } else {
            $sql = "UPDATE offers SET status='1' WHERE offer_id='$offer_id'";
            $qry = $pdo->prepare($sql);
            $qry->execute();
            if ($qry->rowCount()) {
                $success_message = "Accepted";
            } else {
                $error_message = "Failed Try Again Later";
            }
        }
    }

    // IF REJECT BUTTON IS CLICKED
    if (isset($_POST['btn_reject'])) {
        $offer_id = $_POST['btn_reject'];
        $sql = "UPDATE offers SET status='2' WHERE offer_id='$offer_id'";
        $qry = $pdo->prepare($sql);
        $qry->execute();
        if ($qry->rowCount()) {
            $success_message = "Rejected";
        } else {
            $error_message = "Failed Try Again Later";
        }
    }
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Offers</h1>
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
                                            <th>Agent Picture</th>
                                            <th>Agent Name</th>
                                            <th>Country</th>
                                            <th>Offer Date</th>
                                            <th>Offer Duration</th>
                                            <th>Offer Amount</th>
                                            <th>Offer Status</th>
                                            <th>Offer Terms</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // GET OFFERS DATA  
                                        $athlete_id = $_SESSION['athlete_id'];
                                        $sql = "SELECT * FROM offers WHERE athlete_id='$athlete_id'";
                                        $qry = $pdo->prepare($sql);
                                        $qry->execute();
                                        if ($qry->rowCount()) {
                                            $data = $qry->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($data as $row) {
                                                $agent_id = $row['agent_id'];
                                                // fetch agent info
                                                $sql = "SELECT * FROM agents WHERE agent_id='$agent_id'";
                                                $qry = $pdo->prepare($sql);
                                                $qry->execute();
                                                $agent = $qry->fetch(PDO::FETCH_ASSOC);

                                                if ($row['status'] == 0) {
                                                    $offer_status = '<span class="text-warning">Pending</span>';

                                                    $action = '<form action="" method="post"><button type="submit" name="btn_accept" value="' . $row['offer_id'] . '" class="btn btn-sm btn-success">Accept</button><button type="submit" name="btn_reject" value="' . $row['offer_id'] . '" class="btn btn-sm btn-danger">Reject</button></form>';
                                                } elseif ($row['status'] == 1) {
                                                    $offer_status = '<span class="text-success">Accepted</span>';
                                                    $action = '<span>----</span>';
                                                } elseif ($row['status'] == 2) {
                                                    $offer_status = '<span class="text-danger">Rejected</span>';
                                                    $action = '<span>----</span>';
                                                }

                                                echo '
                                                    <tr>
                                                        <td><img class="img rounded" width="50" src="../../agent/uploads/profile_pics/' . $agent['profile_picture'] . '"></td>
                                                        <td>' . $agent['first_name'] . " " . $agent['last_name'] . '</td>
                                                        <td>' . $agent['country'] . '</td>
                                                        <td>' . date('d-m-Y', strtotime($row['created_at'])) . '</td>
                                                        <td>' . $row['duration'] . ' months</td>
                                                        <td>' . $row['amount'] . '</td>
                                                        <td>' . $offer_status . '</td>
                                                        <td>' . $row['terms'] . '</td>
                                                        <td>' . $action . '</td>
                                                    </tr>
                                                
                                                ';

                                            }
                                        } else {
                                            echo '
                                                    <tr>
                                                        <td colspan="8" class="text-danger"><h3>No Offers Received</h3></td>
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
    <?php
    if (isset($success_message) && $success_message != "") {
        echo '
                <script>
                    toastr.success("' . $success_message . '");
                </script>
            
            ';
    }

    if (isset($error_message) && $error_message != "") {
        echo '
        <script>
            toastr.error("' . $error_message . '");
        </script>
    
    ';
    }
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