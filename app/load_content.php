<?php
require_once 'function.php';
global $conn, $name;
echo print_r($_POST) . "<br>";
echo print_r($_FILES) . "<br>";

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

$all_countries = gather_data_for_select('countries');
$all_regions = gather_data_for_select('regions');


//$query = "SELECT name, countries_id FROM countries";
//$result = $conn->query($query);
//($result) or handle_error("It is not possible to select countries", $conn->connect_error);
//if ($result->num_rows) {
//    for ($i = 0; $i < $result->num_rows; ++$i) {
//        $result->data_seek($i);
//        $row = $result->fetch_array(MYSQLI_ASSOC);
//
//        $name = $row['name'];
//        $country_id = $row['countries_id'];
//        $object_data = array(
//            'name' => "$name",
//            'country_id' => "$country_id"
//        );
//        array_push($all_countries, $object_data);
//    }
//}
//echo print_r($all_countries) . "<br>";


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