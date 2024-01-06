<form method="post" action="addQuestionAction.php" enctype="multipart/form-data">
<div class="card-header"><?php session_start();?>
                <h3 class="card-title">Question number <?php echo $_SESSION['count']; ?></h3>
</div>
                <div class="card-body" >
                  <div class="form-group">
                    <label for="question_title"> title</label>
                    <input type="text" class="form-control" id="quiz_title" placeholder="Enter Quiz Title" name="quiz_title" required>
                  </div>
                  <div class="form-group">
                    <label for="choice_1">choice 1️⃣</label>
                    <input type="text" class="form-control" id="choice_1" placeholder="Enter choice 1" name="choice_1" required>
                  </div>
                  <div class="form-group">
                    <label for="choice_2">choice 2️⃣</label>
                    <input type="text" class="form-control" id="choice_2" placeholder="Enter choice 2" name="choice_2" required>
                  </div>
                  <div class="form-group">
                    <label for="choice_3">choice 3️⃣</label>
                    <input type="text" class="form-control" id="choice_3" placeholder="Enter choice 3" name="choice_3" required>
                  </div>
                  <div class="form-group">
                    <label for="choice_4">choice 4️⃣</label>
                    <input type="text" class="form-control" id="choice_4" placeholder="Enter choice 4" name="choice_4" required>
                  </div>

                  <div class="form-group">
                    <label for="right_choice">Correct Answer ✅</label>
                    <input type="number" class="form-control" id="choice_4" value="1" name="right_choice" max="4" min="1" required>
                  </div>
                  <input type="number" name="count" value="<?php echo $_SESSION['count']; ?>" style="display:none">

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn custom-btn btn-block" name="add_question"> &#x1F3C3; Lets move forward &#x1F3C3;</button>
                </div>
</form>