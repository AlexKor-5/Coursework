<?php
include_once 'function.php';
global $conn;

try {
    if (!isset($_REQUEST['image_id']) && !isset($_REQUEST['table'])) {
        handle_error("Image is not defined", "Image is not defined");
    }
    $image_id = $_REQUEST['image_id'];
    $table = $_REQUEST['table'];

    $select_query = sprintf("SELECT * FROM images WHERE $table = %d", $image_id);
//    $select_query =  sprintf("SELECT * FROM images WHERE images_id = %d", $image_id);

    $result = $conn->query($select_query);
    ($result) or handle_error("Error has just happened", $conn->connect_error);


    global $mime_type, $file_size, $image_data;
    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $file_size = $row['file_size'];
        $mime_type = $row['mime_type'];
        $image_data = $row['data_blob']; // picture
    } else {
        handle_error("возникла проблема с поиском вашей " .
            "информации на нашей системе.",
            "Ошибка обнаружения Image in DataBase (show_image.php)");
    }

    header('Content-type: ' . $mime_type);
    header('Content-length: ' . $file_size);
    echo $image_data;

} catch (Exception $exc) {
    handle_error("при загрузке вашего изображения произошел сбой.",
        "Ошибка при загрузке изображения: " . $exc->getMessage());
}

//        $image_query = "SELECT data_blob FROM images WHERE countries_id=" . $row['countries_id'];
//        $image_result = $conn->query($image_query);
//        ($image_result) or handle_error("Трапився збій при отриманні зображення від бази даних", $conn->connect_error);
//        $image_row = $image_result->fetch_array(MYSQLI_ASSOC);
//        echo $image_row['data_blob'];

?>
