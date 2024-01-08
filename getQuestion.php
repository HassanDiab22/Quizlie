<?php
require_once("Config.php");
session_start();
$quiz_id = $_SESSION["quiz_id"];
$question_number = isset($_GET['question_number']) ? $_GET['question_number'] : 1;
$sql = "SELECT * FROM question WHERE quiz_id = " . $quiz_id;

$result = mysqli_query($con, $sql);

$questions = [];

$query = "SELECT * FROM quiz WHERE quiz_id = $quiz_id";
$result2=$con->query($query);
$number_of_questions=-1;
if ($result2) {
    $quiz = $result2->fetch_assoc();
    $number_of_questions = $quiz['number_questions'];
} 
if ($question_number > $number_of_questions) {
    
    header("Location: score.php");
    exit; // Add exit to stop further execution
}


while ($row = mysqli_fetch_array($result)) {
    array_push($questions , $row);
}

$current_question=$questions[$question_number-1];

?>

<form method="post" action="" enctype="multipart/form-data" id="questionForm">
    <div class="card-header">
        <h3 class="card-title">Question number <?php echo $_GET['question_number']; ?></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="question_title"> <?php echo $current_question['question_text']; ?></label>
        </div>

        <div class="form-group icheck-amethyst d-inline">
            <input type="radio" id="choice_1" name="choices" value="c1" required>
            <label for="choice_1"><?php echo $current_question['choice1'] ?></label>
        </div>
        <br>
        <div class="form-group icheck-amethyst d-inline">
            <input type="radio" id="choice_2" name="choices" value="2" required>
            <label for="choice_2"><?php echo $current_question['choice2'] ?></label>
        </div>
        <br>
        <div class="form-group icheck-amethyst d-inline">
            <input type="radio" id="choice_3" name="choices" value="3" required>
            <label for="choice_3"><?php echo $current_question['choice3']; ?></label>
        </div>
        <br>
        <div class="form-group icheck-amethyst d-inline">
            <input type="radio" id="choice_4" name="choices" value="4" required>
            <label for="choice_4"><?php echo $current_question['choice4']; ?></label>
        </div>

        <input name="count" type="number" value="<?php echo $_GET['question_number']; ?>" style="display:none">
    </div>
    <!-- /.card-body -->

    <div class="btn custom-btn btn-block" name="add_question" onclick="submitQuestionAttemptForm()">
        &#x1F3C3; Lets move forward &#x1F3C3;
    </div>
</form>
