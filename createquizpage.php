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
        <?php
              if (!isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] != 1) {
                  header("Location: login.php");
              }
            ?>
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

         <?php include 'footer.php';?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script>
   
var count=0;
function submitForm() {
    var formData = new FormData($('#quizForm')[0]);
    $.ajax({
        type: 'POST',
        url: 'addQuizAction.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            
            
            console.log(count);
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
function submitQuestionForm() {
    event.preventDefault();
    
    // Validate the form
    if (validateForm2()) {
        // Create a FormData object to store form data
        var formData = new FormData($('#questionForm')[0]);

        // Use AJAX to submit the form
        $.ajax({
            type: 'POST',
            url: 'addQuestionAction.php',
            data: formData ,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log('question success '+count);
                            
                count++;
                if(response=='done'){
                    window.location.href ='index.php';
                }
                
                $.ajax({
                    url: 'addQuestion.php',
                    type: 'GET',
                    data: { count: count },
                    success: function (response) {
                        $('#card-body').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error loading createquestion.php:', error);
                    }
                });
            },
            error: function (error) {
                console.error('error', error);
                // Handle errors if needed
            }
        });
    }
}


function validateForm2() {
    var isValid = true;
    // Check your form fields for validation
    // Example: Check if the title field is not empty
    var title = $('#quiz_title').val();
    var c1 = $('#choice_1').val();
    var c2 = $('#choice_2').val();
    var c3 = $('#choice_3').val();
    var c4 = $('#choice_4').val();
    var rc = $('#right_choice').val();
    console.log(rc)
    if (title.trim() === '') {
        alert('Title cannot be empty.');
        isValid = false;
    }
    if (c1.trim() === '' ) {
        alert('Choice 1 cannot be empty.');
        isValid = false;
    }
    if (c2.trim() === '' ) {
        alert('Choice 2 cannot be empty.');
        isValid = false;
    }
    if (c3.trim() === '' ) {
        alert('Choice 3 cannot be empty.');
        isValid = false;
    }
    if (c4.trim() === '' ) {
        alert('Choice 4 cannot be empty.');
        isValid = false;
    }
    if (rc >4 || rc<0 ) {
        alert('right choice should be between 1 & 4.');
        isValid = false;
    }


    return isValid;
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
