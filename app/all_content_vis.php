<?php
require_once 'function.php';
global $conn;

function gather_data($request_address = 'countries_id', $str_place_id = 'countries_id', $set = 'regions')
{
    global $conn;
    if (!isset($_REQUEST[$request_address])) {
        handle_error("$request_address is not defined", "$request_address is not defined");
    }
    $place_id = $_REQUEST[$request_address];
    $query = sprintf("SELECT * FROM " . "$set" . " WHERE " . "$str_place_id" . " = %d", $place_id);
    $res = $conn->query($query);
    ($res) or handle_error("error has just happened", $conn->connect_error);

    $table = "images_id";
    global $all_regions;
    $all_regions = [];

    if ($res->num_rows) {
        for ($i = 0; $i < $res->num_rows; ++$i) {
            $res->data_seek($i);
            $row = $res->fetch_array(MYSQLI_ASSOC);
            $name = $row['name'];
            $description = $row['description'];
            $place_id = $row[$set . '_id'];
            $upload_time = $row['upload_time'];
            $update_time = $row['update_time'];

            $content_array = array(
                'name' => "$name",
                'description' => "$description",
                $set . '_id' => "$place_id",
                'upload_time' => "$upload_time",
                'update_time' => "$update_time"
            );
            array_push($all_regions, $content_array);
        }
    }

    for ($i = 0; $i < count($all_regions); ++$i) {
        $sub_query = sprintf("SELECT images_id FROM images WHERE " . "$set" . "_id = %d", $all_regions[$i][$set . '_id']);
        $result = $conn->query($sub_query);
        ($result) or handle_error("Error has just happened in getting images", $conn->connect_error);
        $set_of_images = [];
        $set_of_src = [];
        $set_of_image_id = [];
        if ($result->num_rows) {
            for ($y = 0; $y < $result->num_rows; ++$y) {
                $result->data_seek($y);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $image_id = $row['images_id'];
                $html_out = "<img src='show_image.php?image_id=$image_id&table=$table' alt='error'>";
                $html_out_src = "show_image.php?image_id=$image_id&table=$table";
                array_push($set_of_images, $html_out);
                array_push($set_of_src, $html_out_src);
                array_push($set_of_image_id, $image_id);
            }
        }
        $all_regions[$i]['images_set'] = $set_of_images;
        $all_regions[$i]['images_src'] = $set_of_src;
        $all_regions[$i]['images_id'] = $set_of_image_id;
    }
    return $all_regions;
}

function hidden_input($content, $setter)
{
    return "<input type='hidden' name='" . $setter . "' value='" . $content . "'>";
}

?>

<?php function visualization_html($all_regions, $set = 'regions')
{ ?>
    <?php for ($i = count($all_regions) - 1; $i >= 0; --$i) { ?>

    <div class="regions__block border border-success border-2">
        <div class="regions__title text-muted">
            <h2 contenteditable="false"
                data-edit="name"><?php echo $all_regions[$i]['name']; ?></h2>
            <?php echo hidden_input($all_regions[$i][$set . '_id'], $set) ?>

        </div>
        <div class="regions__description text-muted">
            <p contenteditable="false" data-edit="description">
                <?php echo $all_regions[$i]['description']; ?>
            </p>
            <?php echo hidden_input($all_regions[$i][$set . '_id'], $set) ?>
        </div>
        <div class="regions__images">
            <div class="row gy-4">
                <?php if (count($all_regions[$i]['images_set']) !== 0) {
                    for ($y = 0; $y < count($all_regions[$i]['images_set']); ++$y) {
                        ?>
                        <div class="col-12 col-md-6 col-lg-4 regions__relative">
                            <form method="post" enctype="multipart/form-data"
                                  class="regions__download-form display-none">
                                <input type="file" name="image_upload"
                                       accept=".jpg, .jpeg, .png, .gif" data-edit="image">
                                <input type="hidden" name="image_id"
                                       value="<?php echo $all_regions[$i]['images_id'][$y]; ?>">
                                <input type="hidden" name="<?php echo $set; ?>"
                                       value="<?php echo $all_regions[$i][$set . '_id']; ?>">
                            </form>
                            <a href="<?php echo $all_regions[$i]['images_src'][$y]; ?>"
                               class="regions__item border border-success border-2">
                                <?php echo $all_regions[$i]['images_set'][$y]; ?>
                            </a>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
        <div class="regions__wrapper">
            <div class="regions__navigation">
                <?php if ($set == 'regions') { ?>
                    <a href="<?php echo "cities.php?regions_id=" . $all_regions[$i]['regions_id']; ?>"
                       class="link-success">Туристичні міста</a>
                    <a href="<?php echo "towns.php?regions_id=" . $all_regions[$i]['regions_id']; ?>"
                       class="link-success">Туристичні містечка</a>
                <?php } ?>
            </div>
            <div class="regions__time text-muted">
                <?php if ($all_regions[$i]['upload_time'] !== '') { ?>
                    <span><small>Опубліковано: <?php echo $all_regions[$i]['upload_time']; ?></small></span>
                <?php } ?>
            </div>
        </div>
    </div>
<?php }; ?>

<?php } ?>



