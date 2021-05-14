<?php
require_once 'function.php';
global $conn, $name;
//echo var_dump($_POST);
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $query = "INSERT INTO countries VALUES(NULL, '$name', NOW())";
    $result = $conn->query($query);
    ($result) or handle_error('Помилка в запросі до бази', $conn->connect_error);
}

global $countries_id;
if (!$_FILES['error'] == 0) {
//    $image = $_FILES['image'];
//    $image_data = file_get_contents($image['tmp_name']);
//
//        $sub_query = "SELECT countries_id FROM countries WHERE name = '$name'";
//        $sub_res = $conn->query($sub_query);
//        ($sub_query) or handle_error('Помилка в запросі до бази 2', $conn->connect_error);
//        if ($sub_res->num_rows) {
//            $row = $sub_res->fetch_array(MYSQLI_ASSOC);
//            $countries_id = $row['countries_id'];
//            echo 'countries_id = ' . $countries_id . '<br>';
//        }


}

//$query = "INSERT INTO countries VALUES(NULL, $name, NOW())";

//echo $name;

?>

<?php require_once 'header.php'; ?>
    <main>
        <div class="container my-container">
            <div class="regions">
                <div class="countries__title text-muted text-center">
                    <h1>Сторінка завантаження країни</h1>
                </div>
                <div class="row gy-4">
                    <div class="col-12">

                        <div class="regions__block border border-success border-2">
                            <form action="load_country.php" method="post" enctype="multipart/form-data"
                                  class="row g-3 needs-validation" novalidate>
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Назва країни</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom01" value=""
                                           required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Виберіть зображення</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="15000000">
                                    <input class="form-control" type="file" name="image" id="formFile">
                                </div>
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