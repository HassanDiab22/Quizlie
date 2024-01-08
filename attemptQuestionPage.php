<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php';?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attempt</title>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'nav.php'?>
        <?php
              if (!isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] != 1) {
                  header("Location: login.php");
              }
              $question_number;
              if(!isset($_GET["question_number"])){
                $question_number=1;
              }else{
                $question_number=$_GET["question_number"];
              }
            ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="card col-12" id="card">

                            
                                <div class="card-body" id="card-body">
                                   
                                   
                                </div>
                                <!-- /.card-body -->


                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->



     <script>
         $(document).ready(function() {
            // On page load, send an AJAX get request
            $.ajax({
                type: "GET",
                url: "getQuestion.php",
                data: {
                    question_number: <?php echo $question_number; ?>
                },
                success: function(response) {
                    // Handle the response, you can update the card-body or perform other actions
                    $("#card-body").html(response);
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        });
        function submitQuestionAttemptForm() {
    // Check if a choice is selected
    var selectedChoice = document.querySelector('input[name="choices"]:checked');

    if (!selectedChoice) {
        alert('Please select an answer before moving forward.');
        return;
    }

    // Get the question number from the hidden input field
    var questionNumber = $('#questionForm input[name="count"]').val();

    // Create a FormData object to store form data
    var formData = new FormData($('#questionForm')[0]);

    // Append the selected choice to the FormData
    formData.append('selected_choice', selectedChoice.value);

    // Append the question number to the URL
    var url = 'checkPage.php?question_number=' + questionNumber;

    // Use AJAX to submit the form
    $.ajax({
        type: 'POST', // Change to POST to send FormData
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log('Question attempt success:', response);

            // You can handle the response as needed
            // For example, update the content of the div with id "card-body"
            $('#card-body').html(response);

            // Alternatively, you can redirect the user to the next question page
            // window.location.href = 'nextQuestionPage.php';
        },
        error: function (error) {
            console.error('Error submitting question attempt:', error);
            // Handle errors if needed
        }
    });
}



    </script>

</body>
</html>
