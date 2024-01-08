<?php
require_once("Config.php");
session_start();
$quiz_id = $_SESSION["quiz_id"];
$query = "SELECT * FROM quiz WHERE quiz_id = $quiz_id";
$result=$con->query($query);

$quiz_attempt = $_SESSION["attempt_id"];
$question_number = isset($_GET['question_number']) ? $_GET['question_number'] : 1;
$sql = "SELECT * FROM question WHERE quiz_id = " . $quiz_id;

$result = mysqli_query($con, $sql);

$questions = [];
while ($row = mysqli_fetch_array($result)) {
    array_push($questions, $row);
}



$current_question = $questions[$question_number - 1];
$correct_answer = $current_question['correct_choice'];
if($current_question['correct_choice']==$_POST['selected_choice']){
    
    $q = "UPDATE quiz_attempt SET score = score + 25 WHERE attempt_id = $quiz_attempt ;";
    $con->query($q);
}
function check($index,$choice, $correct_answer)
{   

    if ($correct_answer.'' == $index) {
        echo '<label  class="text-success">' . $choice . '</label>';
        
    } else {
     
        echo '<label  class="text-danger">' . $choice . '</label>';
    }
}



?>

<form method="post"  enctype="multipart/form-data" id="questionForm">
    <div class="card-header">
        <h3 class="card-title">Quedstion number <?php echo $_GET['question_number']; ?></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="question_title"> <?php echo $current_question['question_text']; ?></label>
        </div>

        <div class="form-group icheck-amethyst d-inline">
            <input type="radio" id="choice_1" name="choices" value="c1" required disabled>
            
            <label for="choice_1" class="text-danger"><?php check('1',$current_question['choice1'],$correct_answer ); ?></label>
        </div>
        <br>
        <div class="form-group icheck-amethyst d-inline">
            <input type="radio" id="choice_2" name="choices" value="c2" required disabled>
            <label for="choice_2"><?php check('2',$current_question['choice2'],$correct_answer );?></label>
        </div>
        <br>
        <div class="form-group icheck-amethyst d-inline">
            <input type="radio" id="choice_3" name="choices" value="c3" required disabled>
            <label for="choice_3"><?php check('3',$current_question['choice3'],$correct_answer ); ?></label>
        </div>
        <br>
        <div class="form-group icheck-amethyst d-inline">
            <input type="radio" id="choice_4" name="choices" value="c4" required disabled>
            <label for="choice_4"><?php check('4',$current_question['choice4'],$correct_answer ); ?></label>
        </div>
   
        <input name="count" type="number" value="<?php echo $_GET['question_number']; ?>" style="display:none">
    </div>
    <!-- /.card-body -->

    <div class="btn custom-btn btn-block" onclick="getNextQuestion()" >
        &#x1F3C3; Lets move forward &#x1F3C3;
    </div>
</form>
<script>
    function getNextQuestion() {
        // Increment the question_number
        var nextQuestionNumber = <?php echo $_GET["question_number"] + 1; ?>;
        
        // Send an AJAX get request
        $.ajax({
            type: "GET",
            url: "getQuestion.php",
            data: {
                question_number: nextQuestionNumber
            },
            success: function(response) {
                // Handle the response, you can update the card-body or perform other actions
                $("#card-body").html(response);
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    }
</script>