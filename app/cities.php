<?php
//require_once 'function.php';
//global $conn;
//
//if (!isset($_REQUEST['regions_id'])) {
//    handle_error("region_id is not defined", "region_id is not defined");
//}
//$regions_id = $_REQUEST['regions_id'];
//
//$query = sprintf("SELECT * FROM cities WHERE regions_id = %d", $regions_id);
//$res = $conn->query($query);
//($res) or handle_error("error has just happened", $conn->connect_error);
////echo 'ok';
//
//$table = "images_id";
//global $all_regions;
//$all_regions = [];
//
//
//if ($res->num_rows) {
//    for ($i = 0; $i < $res->num_rows; ++$i) {
//        $res->data_seek($i);
//        $row = $res->fetch_array(MYSQLI_ASSOC);
//        $name = $row['name'];
//        $description = $row['description'];
//        $cities_id = $row['cities_id'];
//        $upload_time = $row['upload_time'];
//        $update_time = $row['update_time'];
//
//        $content_array = array(
//            'name' => "$name",
//            'description' => "$description",
//            'cities_id' => "$cities_id",
//            'upload_time' => "$upload_time",
//            'update_time' => "$update_time"
//        );
//
//        array_push($all_regions, $content_array);
//    }
//}
//for ($i = 0; $i < count($all_regions); ++$i) {
//    $sub_query = sprintf("SELECT images_id FROM images WHERE cities_id = %d", $all_regions[$i]['cities_id']);
//    $result = $conn->query($sub_query);
//    ($result) or handle_error("error has just happened - 2", $conn->connect_error);
//    $set_of_images = [];
//    $set_of_src = [];
//    $set_of_image_id = [];
//    if ($result->num_rows) {
//        for ($y = 0; $y < $result->num_rows; ++$y) {
//            $result->data_seek($y);
//            $row = $result->fetch_array(MYSQLI_ASSOC);
//            $image_id = $row['images_id'];
//            $html_out = "<img src='show_image.php?image_id=$image_id&table=$table' alt='error'>";
//            $html_out_src = "show_image.php?image_id=$image_id&table=$table";
//            array_push($set_of_images, $html_out);
//            array_push($set_of_src, $html_out_src);
//            array_push($set_of_image_id, $image_id);
//        }
//    }
//    $all_regions[$i]['images_set'] = $set_of_images;
//    $all_regions[$i]['images_src'] = $set_of_src;
//    $all_regions[$i]['images_id'] = $set_of_image_id;
//}

require_once 'all_content_vis.php';
$all_regions = gather_data('regions_id', 'regions_id', 'cities');

?>
<?php require_once 'header.php'; ?>
    <main>
        <div class="container my-container">
            <div class="regions">
                <div class="countries__title text-muted text-center">
                    <h1>Міста вибраного вами регіону</h1>
                </div>
                <div class="row gy-4">
                    <div class="col-12">
                        <?php echo visualization_html($all_regions, 'cities'); ?>

                        <!--                        --><?php //for ($i = count($all_regions) - 1; $i >= 0; --$i) { ?>
                        <!---->
                        <!--                            <div class="regions__block border border-success border-2">-->
                        <!--                                <div class="regions__title text-muted">-->
                        <!--                                    <h2 contenteditable="false"-->
                        <!--                                        data-edit="name">-->
                        <?php //echo $all_regions[$i]['name']; ?><!--</h2>-->
                        <!--                                    <input type="hidden" name="cities_id"-->
                        <!--                                           value="-->
                        <?php //echo $all_regions[$i]['cities_id']; ?><!--">-->
                        <!--                                </div>-->
                        <!--                                <div class="regions__description text-muted">-->
                        <!--                                    <p contenteditable="false" data-edit="description">-->
                        <!--                                        --><?php //echo $all_regions[$i]['description']; ?>
                        <!--                                    </p>-->
                        <!--                                    <input type="hidden" name="cities_id"-->
                        <!--                                           value="-->
                        <?php //echo $all_regions[$i]['cities_id']; ?><!--">-->
                        <!--                                </div>-->
                        <!--                                <div class="regions__images">-->
                        <!--                                    <div class="row gy-4">-->
                        <!--                                        --><?php //if (count($all_regions[$i]['images_set']) !== 0) {
                        //                                            for ($y = 0; $y < count($all_regions[$i]['images_set']); ++$y) {
                        //                                                ?>
                        <!--                                                <div class="col-12 col-md-6 col-lg-4 regions__relative">-->
                        <!--                                                    <form method="post" enctype="multipart/form-data"-->
                        <!--                                                          class="regions__download-form display-none">-->
                        <!--                                                        <input type="file" name="image_upload"-->
                        <!--                                                               accept=".jpg, .jpeg, .png, .gif" data-edit="image">-->
                        <!--                                                    </form>-->
                        <!--                                                    <a href="-->
                        <?php //echo $all_regions[$i]['images_src'][$y]; ?><!--"-->
                        <!--                                                       class="regions__item border border-success border-2">-->
                        <!--                                                        --><?php //echo $all_regions[$i]['images_set'][$y]; ?>
                        <!--                                                        <input type="hidden" name="image_id"-->
                        <!--                                                               value="-->
                        <?php //echo $all_regions[$i]['images_id'][$y]; ?><!--">-->
                        <!--                                                        <input type="hidden" name="region_id"-->
                        <!--                                                               value="-->
                        <?php //echo $all_regions[$i]['cities_id']; ?><!--">-->
                        <!--                                                    </a>-->
                        <!--                                                </div>-->
                        <!--                                            --><?php //}
                        //                                        } ?>
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                                <div class="regions__wrapper">-->
                        <!--                                    <div class="regions__navigation">-->
                        <!--                                    </div>-->
                        <!--                                    <div class="regions__time text-muted">-->
                        <!--                                        --><?php //if ($all_regions[$i]['upload_time'] !== '') { ?>
                        <!--                                            <span><small>Опубліковано: -->
                        <?php //echo $all_regions[$i]['upload_time']; ?><!--</small></span>-->
                        <!--                                        --><?php //} ?>
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        --><?php //}; ?>


                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require_once 'footer.php'; ?>