<?php include('view/components/headerDashboard.php') ?>
<?php include('view/components/sidebarDashboard.php') ?>

 <div id="content">
 <div class="contentContenerCreate">
                <div class="contentContenerHeader" id="contentContenerHeaderId"> Create article: </div>
                <div id="contentCreateWrapper">
                    <form method="POST" action="index2.php?action=addArticle">
                        <div class="form-group">
                            <label for="titleInput">Title:</label>
                            <input name="title" type="text" class="form-control" id="titleInput"
                                placeholder="Enter title">
                        </div>
                        </br>
                        <div class="form-group">
                            <label for="imgInput">Image link(url):</label>
                            <input name="img" type="text" class="form-control" id="imgInput" placeholder="Enter url ">
                        </div>
                        </br>
                        <div class="form-group">
                            <label for="imgInput">Category:</label>
                            <select name="category" class="form-control" id="selectInput" aria-label="Default select example">
                                <option selected>Select a category</option>
                                <option value="technology">Technology</option>
                                <option value="sport">Sport</option>
                                <option value="news">News </option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        </br>
                        <div class="form-group">
                            <label for="text">Text:</label>
                            <textarea name="text" class="form-control" id="text" rows="16"></textarea>
                        </div>
                        <div id="formSubmitWrapper">
                            <button type="submit" class="btn btn-secondary">Add</button>
                        </div>
                        <?=$text?>
                    </form>
                    
                </div>
    </div>
    <?php include('view/components/footerDashboard.php') ?>