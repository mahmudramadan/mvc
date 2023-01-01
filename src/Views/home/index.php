<main role="main">
    <div class="container">
        <div class="row">
            <h1 style="margin: auto;text-align: center">All News</h1>
            <?php
            if (isset($data)) {
                if (count($data['news']) == 0) {
                    echo "<div class='alert alert-danger'>there is no News added yet</div>";
                } else {
                    foreach ($data['news'] as $key => $newsItem) {
                        ?>
                        <!-- Example row of columns -->
                        <div class="col-md-12 border" style="padding: 5px;margin: 5px">
                            <h2><?php echo $newsItem->title ?></h2>
                            <h3><?php echo $newsItem->author_name ?></h3>
                            <h5><?php echo $newsItem->created_at ?></h5>
                            <p><?php echo substr($newsItem->description, 0, 1000) ?> ....</p>
                        </div>
                        <hr>

                    <?php }
                }
            } ?>
        </div>
        <hr>
    </div> <!-- /container -->
</main>
