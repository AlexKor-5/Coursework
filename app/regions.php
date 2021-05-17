<?php
require_once 'function.php';
global $conn;

if (!isset($_REQUEST['countries_id'])) {
    handle_error("Image is not defined", "Image is not defined");
}
$countries_id = $_REQUEST['countries_id'];

$query = sprintf("SELECT * FROM regions WHERE countries_id = %d", $countries_id);
$res = $conn->query($query);
($res) or handle_error("error has just happened", $conn->connect_error);
//echo 'ok';

$table = "images_id";
global $all_regions;
$all_regions = [];


if ($res->num_rows) {
    for ($i = 0; $i < $res->num_rows; ++$i) {
        $res->data_seek($i);
        $row = $res->fetch_array(MYSQLI_ASSOC);
        $name = $row['name'];
        $description = $row['description'];
        $regions_id = $row['regions_id'];
        $upload_time = $row['upload_time'];
        $update_time = $row['update_time'];

        $content_array = array(
            'name' => "$name",
            'description' => "$description",
            'regions_id' => "$regions_id",
            'upload_time' => "$upload_time",
            'update_time' => "$update_time"
        );

        array_push($all_regions, $content_array);
    }
}
for ($i = 0; $i < count($all_regions); ++$i) {
    $sub_query = sprintf("SELECT images_id FROM images WHERE regions_id = %d", $all_regions[$i]['regions_id']);
    $result = $conn->query($sub_query);
    ($result) or handle_error("error has just happened - 2", $conn->connect_error);
    $set_of_images = [];
    if ($result->num_rows) {
        for ($y = 0; $y < $result->num_rows; ++$y) {
            $result->data_seek($y);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $image_id = $row['images_id'];
            $html_out = "<img src='show_image.php?image_id=$image_id&table=$table' alt='error'>";
            array_push($set_of_images, $html_out);
        }
    }
    $all_regions[$i]['images_set'] = $set_of_images;
}
//$temp_var = $all_regions[0]['images_set'][1];
//echo var_dump($temp_var);


?>
<?php require_once 'header.php'; ?>
    <main>
        <div class="container my-container">
            <div class="regions">
                <div class="countries__title text-muted text-center">
                    <h1>Регіони вибраної вами країни</h1>
                </div>
                <div class="row gy-4">
                    <div class="col-12">
                        <?php for ($i = 0; $i < count($all_regions); ++$i) { ?>

                            <div class="regions__block border border-success border-2">
                                <div class="regions__title text-muted">
                                    <h2 contenteditable="false"
                                        data-edit="name"><?php echo $all_regions[$i]['name']; ?></h2>
                                    <input type="hidden" name="region_id" value="$regions_id">
                                </div>
                                <div class="regions__description text-muted">
                                    <p contenteditable="false" data-edit="description">
                                        <?php echo $all_regions[$i]['description']; ?>
                                    </p>
                                    <input type="hidden" name="region_id" value="$regions_id">
                                </div>
                                <div class="regions__images">
                                    <div class="row gy-4">
                                        <?php if (count($all_regions[$i]['images_set']) !== 0) {
                                            for ($y = 0; $y < count($all_regions[$y]['images_set']); ++$y) {
                                                ?>
                                                <div class="col-12 col-md-6 col-lg-4 regions__relative">
                                                    <form method="post" enctype="multipart/form-data"
                                                          class="regions__download-form display-none">
                                                        <input type="file" name="image_upload"
                                                               accept=".jpg, .jpeg, .png, .gif" data-edit="image">
                                                    </form>
                                                    <a href="#" class="regions__item border border-success border-2">
                                                        <?php echo $all_regions[$i]['images_set'][$y]; ?>
                                                        <input type="hidden" name="image_id" value="3765674353">
                                                        <input type="hidden" name="region_id" value="376574353">
                                                    </a>
                                                </div>
                                            <?php };
                                        }; ?>
                                    </div>
                                </div>
                                <div class="regions__wrapper">
                                    <div class="regions__navigation">
                                        <a href="#" class="link-success">Туристичні міста</a>
                                        <a href="#" class="link-success">Туристичні містечка</a>
                                    </div>
                                    <div class="regions__time text-muted">
                                        <span><small>Опубліковано: <?php echo $all_regions[$i]['upload_time']; ?></small></span>
                                    </div>
                                </div>
                            </div>
                        <?php }; ?>

                    </div>
                </div>
            </div>
        </div>
    </main>


<?php require_once 'footer.php'; ?>