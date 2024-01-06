
                                <form method="post" action="addQuizAction.php" enctype="multipart/form-data" id="quizForm" >
                                    <div class="form-group">
                                        <label for="quiz_title">Quiz title 🧛‍♂️</label>
                                        <input type="text" class="form-control" id="quiz_title" placeholder="Enter Quiz Title" name="quiz_title" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description 📝 (Max 150 characters)</label>
                                        <textarea class="form-control" rows="3" maxlength="150" placeholder="Enter Description..." id="description" name="description" oninput="countCharacters()"></textarea>
                                        <p id="charCount">150 characters left</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="number_questions">Number Of Questions 🤔</label>
                                        <input type="number" class="form-control" id="number_questions" min="1" name="number_questions" value="1">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">Quiz Cover Image 🎨</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="quiz_cover" accept="image/*">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                
                                <!-- /.card-body -->

                                    <div class="card-footer ">
                                        <div  class="btn btn-primary col-12 custom-btn" name="add" onclick="submitForm()">🏃‍♂️ Lets Keep Going 🏃‍♂️</div>
                                    </div>
                                </form>
 