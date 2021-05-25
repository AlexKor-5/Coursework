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
if (count($data['images']) !== 0) {
    set_Image_content($data['images']);
}

function set_Text_content($info_array = [], $where = "name")
{
    global $conn;
    for ($i = 0; $i < count($info_array); ++$i) {
        if ($info_array[$i]['id'] !== '' or $info_array[$i]['type_id'] !== '') {
            $changed_content = $info_array[$i]['content'];
            $query = "UPDATE " . $info_array[$i]['type_id'] . " SET " . $where . " = " . "'$changed_content'" .
                " WHERE " . $info_array[$i]['type_id'] . "_id = " . $info_array[$i]['id'];
            $result = $conn->query($query);
            ($result) or handle_error('Error in data updating', $conn->connect_error);
        }
    }
}

function set_Image_content($data = [])
{
    global $conn;
    for ($i = 0; $i < count($data); ++$i) {
        if ($data[$i]['location_id'] !== '' or
            $data[$i]['type_id'] !== '' or
            $data[$i]['id'] !== '' or
            count($data[$i]['data_blob']) !== 0) {
            $changed_image = $data[$i]['data_blob'];

//            $query = "UPDATE images SET name = " . $data[$i]['file_name'] . ", mime_type = " . $data[$i]['file_type'] .
//                ", file_size = " . $data[$i]['file_size'] . ", data_blob = '$changed_image', WHERE images_id = " . $data[$i]['id'];
//            $result = $conn->query($query);
//            ($result) or handle_error('Error in image updating', $conn->connect_error);

            $stmt = $conn->prepare("UPDATE images SET name = ?, mime_type = ?, file_size = ?, data_blob = ? " .
                "WHERE images_id = ?");
            $stmt->bind_param('ssisi', $data[$i]['file_name'], $data[$i]['file_type'], $data[$i]['file_size'],
                $changed_image, $data[$i]['id']);

            if (!$stmt->execute()) {
                handle_error('Error in image updating', $stmt->errno);
            }


        }
    }
}

//echo 'type_id = ' . $info_array[$i]['type_id'] . '<br>' .
//    'id = ' . $info_array[$i]['id'] . '<br>' .
//    'content = ' . $info_array[$i]['content'] . '<br>';

echo print_r($data) . '<br>';
echo count($data['names']) . '<br>';
echo count($data['images']) . '<br>';