<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php';?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Quiz</title>
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'nav.php'?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> 🧠Create A Quizlie🧠 </h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="card col-12" id="card">

                            
                                <div class="card-body" id="card-body">
                                   
                                   
                                </div>
                                <!-- /.card-body -->

                                
                            </form>

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

    <!-- REQUIRED SCRIPTS -->
    <script>

function submitForm() {
    // Create a FormData object to store form data
    var formData = new FormData($('#quizForm')[0]);
    var count=0;
    // Use AJAX to submit the form
    $.ajax({
        type: 'POST',
        url: 'addQuizAction.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log('quiz success');
            count++;
            $.ajax({
            url: 'addQuestion.php', // Replace with the correct path to your createquiz.php file
            type: 'GET',
            data: { count: count },
            success: function (response) {
                // Update the content of the div with id "card-body"
                $('#card-body').html(response);
            },
            error: function (xhr, status, error) {
                console.error('Error loading createquiz.php:', error);
            }
        });

        },
        error: function(error) {
            console.error('error', error);
            // Handle errors if needed
        }
    });
}
    $(document).ready(function () {
        // Make an AJAX GET request
        $.ajax({
            url: 'createquiz.php', // Replace with the correct path to your createquiz.php file
            type: 'GET',
            success: function (response) {
                // Update the content of the div with id "card-body"
                $('#card-body').html(response);
            },
            error: function (xhr, status, error) {
                console.error('Error loading createquiz.php:', error);
            }
        });
    });

        function countCharacters() {
            let description = document.getElementById('description').value;
            let charactersLeft = 150 - description.length;
            document.getElementById('charCount').innerText = charactersLeft + ' characters left';
        }

        function validateForm() {
            // Perform additional validation if needed
            // For example, you can check if the character count is within the allowed limit
            let description = document.getElementById('description').value;
            let characters = description.length;
            if (characters > 150) {
                alert('Description should not exceed 150 characters.');
                return false;
            }
            return true;
        }
    </script>

</body>
</html>
