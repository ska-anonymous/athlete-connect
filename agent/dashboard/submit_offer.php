<?php
// first check if the id is not set
if (!isset($_GET['id']) || $_GET['id'] == "") {
    die("ID not set! Please don't visit this page directly.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>AthleteConnect | Agent</title>

    <!-- include Header here -->
    <?php
    require_once("../components/header.php");
    require_once('../php_processing/db_connect.php');
    ?>
    <!-- Header Ends here -->

    <?php
    // now check for if already sent offer from this agent to this athlete
    $athlete_id = $_GET['id'];
    $agent_id = $_SESSION['agent_id'];

    $sql = "SELECT * FROM offers WHERE agent_id='$agent_id' AND athlete_id='$athlete_id'";
    $qry = $pdo->prepare($sql);
    $qry->execute();
    if ($qry->rowCount()) {
        echo '
                <script>
                    alert("You Have already Offered to this athlete");
                    window.location.href = "athletes_list.php";
                </script>
            ';
        exit(0);
    }

    // now get the athlete data
    $sql = "SELECT * FROM athletes WHERE athlete_id='$athlete_id'";
    $qry = $pdo->prepare($sql);
    $qry->execute();
    if ($qry->rowCount()) {
        $data = $qry->fetch(PDO::FETCH_ASSOC);
    } else {
        echo '
                <script>
                    alert("This Athlete Does not Exists");
                    window.location.href = "athletes_list.php";
                </script>
            ';
        exit(0);
    }

    // submit the offer if button is clicked
    if (isset($_POST['btn_offer'])) {
        $duration = trim($_POST['duration']);
        $amount = trim($_POST['amount']);
        $terms = trim($_POST['terms']);

        $sql = "INSERT INTO `offers`( `agent_id`, `athlete_id`, `duration`, `amount`, `terms`, `status`) VALUES ('$agent_id','$athlete_id','$duration','$amount','$terms','0')";
        $qry = $pdo->prepare($sql);
        $qry->execute();
        if ($qry->rowCount()) {
            $offer_sent = true;
        } else {
            $offer_sent = false;
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
                        <h1 class="m-0">Send Offer</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Main Content Starts Here -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="athlete_name">Athlete Name</label>
                                                <input type="text" class="form-control" name="" id="athlete_name"
                                                    value="<?php echo $data['first_name'] . ' ' . $data['last_name']; ?>"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="duration">Duration (Months)</label>
                                                <input type="number" min="0" step="any" class="form-control"
                                                    name="duration" id="duration" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="text" class="form-control" name="amount" id="amount"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="terms">Terms</label>
                                                <textarea rows="5" type="text" maxlength="500" class="form-control"
                                                    name="terms" id="terms" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="btn_offer"
                                                    class="btn btn-primary btn-block">Send
                                                    Offer</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
    if (isset($offer_sent)) {
        if ($offer_sent == true) {
            echo '
                    <script>
                        toastr.success("Offer Sent Successfully");
                    </script>
                ';
        } else {
            echo '
                    <script>
                        toastr.error("Failed to send offer! Try Again Later");
                    </script>
                ';
        }
    }
    ?>