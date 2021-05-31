<?php
require_once 'function.php';
global $conn;

$json = file_get_contents('php://input');

$data = json_decode($json, true);
if (count($data['names']) !== 0) {
    set_Text_content($data['names']);

}
if (count($data['descriptions']) !== 0) {
    set_Text_content($data['descriptions'], "description");

}

function set_Text_content($info_array = [], $where = "name")
{
    global $conn;
    for ($i = 0; $i < count($info_array); ++$i) {
        if ($info_array[$i]['id'] !== '' or $info_array[$i]['type_id'] !== '') {
            $changed_content = $info_array[$i]['content'];
            $stmt = $conn->prepare("UPDATE " . $info_array[$i]['type_id'] . " SET " . $where . "= ? WHERE " .
                $info_array[$i]['type_id'] . "_id = ?");
            $stmt->bind_param('si', $changed_content, $info_array[$i]['id']);
            if (!$stmt->execute()) {
                handle_error('Error in inserting data in load_content.php', $stmt->error);
            }
        }
    }
}

if ($_FILES['data_blob']['size'] !== 0 && $_FILES['data_blob']['error'] == 0) {
    $image = $_FILES['data_blob'];
    global $image_data;
    if (!empty($image['tmp_name'])) {
        $image_data = file_get_contents($image['tmp_name']);
    }

    if (isset($_POST['id'])) {
        $image_id = $_POST['id'];
        set_Image_content($image, $image_data, $image_id);
    }
}

function set_Image_content($data, $blob_data, $image_id)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE images SET name = ?, mime_type = ?, file_size = ?, data_blob = ? " .
        "WHERE images_id = ?");
    $stmt->bind_param('ssisi', $data['name'], $data['type'], $data['size'],
        $blob_data, $image_id);
    if (!$stmt->execute()) {
        handle_error('Error in image updating', $stmt->errno);
    }
}
