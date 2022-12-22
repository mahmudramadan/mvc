<main role="main">
    <div class="container">
        <div class="row">
            <h1 style="margin: auto;text-align: center">All News</h1>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <!-- Button to Open the Modal -->
                <a type="button" id="open_modal_btn" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    add news
                </a>
            </div>
            <hr>
            <br>
            <div class="col-lg-12" id="form-result">
            </div>
            <br>
            <div class="col-lg-12">

                <table class="table table-border table-hover">
                    <thead>
                    <tr>
                        <th>serial</th>
                        <th>title</th>
                        <th>author</th>
                        <th>status</th>
                        <th>created at</th>
                        <th>operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($data)) {
                        if (count($data['news']) > 0) {
                            foreach ($data['news'] as $key => $newsItem) {
                                ?>
                                <tr id="line_<?= $newsItem->id ?>">
                                    <td><?= ++$key ?></td>
                                    <td class="news-title"><?= $newsItem->title; ?></td>
                                    <td class="news-author"><?= $newsItem->author_name; ?></td>
                                    <td class="news-active"><?= $newsItem->active == 1 ? "<span style='color:green'>Active</span>" : "<span style='color:red'>Un Active</span>"; ?></td>
                                    <td><?= $newsItem->created_at; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary edit-btn"
                                                data-new-id="<?= $newsItem->id ?>">Edit
                                        </button>
                                        <button type="button" class="btn btn-danger delete-btn"
                                                data-new-id="<?= $newsItem->id ?>">delete
                                        </button>
                                    </td>
                                </tr>
                            <?php }
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>

    </div> <!-- /container -->


    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add News Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="was-validated" id="news-form">
                        <div class="row">

                            <div class="col-lg-4 form-group">
                                <label for="uname">News Title:</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter username"
                                       name="title"
                                       required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="uname">Active Status:</label>
                                <select class="form-control" id="active" placeholder="Enter status" name="active"
                                        required>
                                    <option value="1">Active</option>
                                    <option value="0">Un Active</option>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="uname">Author:</label>
                                <select class="form-control" id="author_id" placeholder="Enter Author" name="author_id"
                                        required>
                                    <?php
                                    if (count($data['authors']) > 0) {
                                        foreach ($data['authors'] as $auther) {
                                            echo "<option value='" . $auther->id . "'>" . $auther->name . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="uname">News Description:</label>
                            <textarea type="text" class="form-control" id="description" placeholder="Enter description"
                                      name="description"
                                      required></textarea>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <div id="form-news-result">

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>
