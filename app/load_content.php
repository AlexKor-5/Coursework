<?php
require_once 'function.php';
global $conn;

global $location_id, $radio_btn_type, $real_location_id;
if (isset($_POST['name']) &&
    isset($_POST['radio_btn']) &&
    (isset($_POST['select_countries']) or isset($_POST['select_regions']))
) {
    $name = $_POST['name'];
    $radio_btn = $_POST['radio_btn'];
    $description = $_POST['description'];

    if (isset($_POST['select_countries'])) {
        $location_id = $_POST['select_countries'];
        if ($radio_btn == 'regions') {
            $radio_btn_type = $radio_btn;
            $query = "INSERT INTO " . $radio_btn . "(name, description, countries_id, upload_time) "
                . "VALUES('$name','$description','$location_id',NOW())";
            $result = $conn->query($query);
            ($result) or handle_error('Error in inserting data in load_content.php', $conn->connect_error);

            $sub_query = "SELECT regions_id FROM regions WHERE name = '$name'";
            $sub_result = $conn->query($query);
            ($sub_result) or handle_error('Error in select id in load_content.php', $conn->connect_error);
//           Вибрати Id регіона,міста чи містечка і передати його при вставці фотографій за допомогою змінної $real_location_id


//            if ($sub_result->num_rows) {
//                $row = $sub_result->fetch_array(MYSQLI_ASSOC);
//                $region_id = $row['regions_id'];
//                $real_location_id = $region_id;
//                echo '@@@ = ' . $real_location_id . '<br>';
//            }
        }

    }

    if (isset($_POST['select_regions'])) {
        $location_id = $_POST['select_regions'];
        if ($radio_btn == 'cities') {
            $radio_btn_type = $radio_btn;
            $query = "INSERT INTO " . $radio_btn . "(name, description, regions_id, upload_time) "
                . "VALUES('$name','$description','$location_id',NOW())";
            $result = $conn->query($query);
            ($result) or handle_error('Error in inserting data in load_content.php', $conn->connect_error);
        }
        $location_id = $_POST['select_regions'];
        if ($radio_btn == 'towns') {
            $radio_btn_type = $radio_btn;
            $query = "INSERT INTO " . $radio_btn . "(name, description, regions_id, upload_time) "
                . "VALUES('$name','$description','$location_id',NOW())";
            $result = $conn->query($query);
            ($result) or handle_error('Error in inserting data in load_content.php', $conn->connect_error);
        }
    }

}
global $middle_value;
if ($_FILES['images']['name'][0] == '') {
    $middle_value = 0;
} else {
    $middle_value = count($_FILES['images']['name']);
}
$end_value = $middle_value;

echo 'end value = ' . $end_value . '<br>';

global $truly;
$truly = FALSE;

for ($i = 0; $i < $end_value; ++$i) {
    if ($_FILES['images']['size'][$i] !== 0 && $_FILES['images']['error'][$i] == 0) {
        $truly = TRUE;
    } else {
        $truly = FALSE;
        return;
    }
}
echo 'truly = ' . $truly . '<br>';
if ($truly) {
    $images = $_FILES['images'];
    $images_data = [];
    $images_name = [];
    $images_mime = [];
    $images_size = [];
    for ($i = 0; $i < $end_value; ++$i) {
        $images_data[$i] = file_get_contents($images['tmp_name'][$i]);
        $images_name[$i] = $images['name'][$i];
        $images_mime[$i] = $images['type'][$i];
        $images_size[$i] = $images['size'][$i];
    }

//    for ($i = 0; $i < $end_value; ++$i) {
//        $stmt = $conn->prepare("INSERT INTO images(name, mime_type, file_size, data_blob, " . $radio_btn_type . "_id) " . "VALUES (?,?,?,?,?)");
//        $stmt->bind_param('ssisi', $images_name[$i], $images_mime[$i], $images_size[$i], $images_data[$i], $real_location_id);
//        if (!$stmt->execute()) {
//            handle_error('INSERT image Error', 'INSERT image Error system_error');
//        }
//     }
    echo 'image-send: ' . $radio_btn_type . '_id  ' . 'location_id=' . $location_id . '  ' . 'real_loc = ' . $real_location_id . '<br>';

//    $image_data = file_get_contents($images['tmp_name']);
}


function gather_data_for_select($set = 'countries')
{
    global $conn;
    $all_countries = [];
    $query = "SELECT name, " . $set . "_id FROM " . $set;
    $result = $conn->query($query);
    ($result) or handle_error("It is not possible to select " . $set, $conn->connect_error);
    if ($result->num_rows) {
        for ($i = 0; $i < $result->num_rows; ++$i) {
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQLI_ASSOC);

            $name = $row['name'];
            $location_id = $row[$set . '_id'];
            $object_data = array(
                'name' => "$name",
                $set . '_id' => "$location_id"
            );
            array_push($all_countries, $object_data);
        }
    }
    return $all_countries;

}

$all_countries = gather_data_for_select();
$all_regions = gather_data_for_select('regions');


echo print_r($_POST) . "<br>";
echo print_r($_FILES) . "<br>";
?>
<?php require_once 'header.php'; ?>
    <main>
        <div class="container my-container">
            <div class="regions">
                <div class="countries__title text-muted text-center">
                    <h1>Сторінка завантаження контенту</h1>
                </div>
                <div class="row gy-4">
                    <div class="col-12">

                        <div class="regions__block border border-success border-2">
                            <form action="load_content.php" method="post" class="row g-3 needs-validation"
                                  enctype="multipart/form-data">
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Назва</label>
                                    <input type="text" name="name" class="form-control" id="validationCustom01" value=""
                                           required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="description"
                                                  placeholder="Leave a comment here" id="floatingTextarea2"
                                                  style="height: 300px"></textarea>
                                        <label for="floatingTextarea2">Опис</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileMultiple" class="form-label">Виберіть зображення</label>
                                    <input class="form-control" type="file" id="formFileMultiple" name="images[]"
                                           multiple>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input" data-radio type="radio" name="radio_btn"
                                           value="regions"
                                           id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Регіон
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" data-radio type="radio" name="radio_btn"
                                           value="cities"
                                           id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Місто
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" data-radio type="radio" name="radio_btn"
                                           value="towns"
                                           id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Містечко
                                    </label>
                                </div>

                                <select class="form-select form-select-lg mb-3" name="select_countries"
                                        data-select="countries"
                                        aria-label=".form-select-lg example">
                                    <?php for ($i = 0; $i < count($all_countries); ++$i) { ?>
                                        <option value="<?php echo $all_countries[$i]['countries_id']; ?>"><?php echo $all_countries[$i]['name']; ?></option>
                                    <?php } ?>
                                </select>

                                <select class="form-select form-select-lg mb-3 display-none"
                                        data-select="regions"
                                        aria-label=".form-select-lg example">
                                    <!--                                    add name="select_regions"-->
                                    <?php for ($i = 0; $i < count($all_regions); ++$i) { ?>
                                        <option value="<?php echo $all_regions[$i]['regions_id']; ?>"><?php echo $all_regions[$i]['name']; ?></option>
                                    <?php } ?>
                                </select>

                                <div class="col-12">
                                    <button class="btn btn-success" type="submit">Зберегти</button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>

<?php require_once 'footer.php'; ?>