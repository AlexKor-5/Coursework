<?php
include_once 'function.php';
global $conn;

$query = "SELECT * FROM countries";
$res = $conn->query($query);
($res) or handle_error("Трапився збій при отриманні інформації про країни від бази даних", $conn->connect_error);
//echo var_dump($res->num_rows);
$table = 'countries_id';

//global $countries_id, $countries_name, $countries_upload_time;
?>
<?php require_once 'header.php'; ?>
<main>
    <div class="container my-container">
        <div class="countries">
            <div class="countries__title text-muted text-center">
                <h1>Оберіть країну для подорожі</h1>
            </div>
            <div class="row gy-4">
                <?php
                if ($res->num_rows) {
                    for ($i = 0; $i < $res->num_rows; ++$i) {
                        $res->data_seek($i);
                        $row = $res->fetch_array(MYSQLI_ASSOC);
                        $countries_name = $row['name'];
                        $countries_id = $row['countries_id'];
                        $countries_upload_time = $row['upload_time'];
                        $sub_query = "SELECT images_id FROM images WHERE countries_id = " . $countries_id;
                        $sub_res = $conn->query($sub_query);
                        global $image_id;
                        if ($sub_res->num_rows) {
                            $sub_row = $sub_res->fetch_array(MYSQLI_ASSOC);
                            $image_id = $sub_row['images_id'];
                        }

                        echo <<<_END
               <div class="col-12 col-md-6 col-lg-4 col-xxl-3 countries__relative">
                    <form method="post" enctype="multipart/form-data" class="countries__download-form display-none">
                        <input type="file" name="image_upload" accept=".jpg, .jpeg, .png, .gif" data-edit="image">
                        <input type="hidden" name="image_id" value="$image_id">
                          <input type="hidden" name="countries" value="$countries_id">
                    </form>
                    <a href="regions.php?countries_id=$countries_id" class="countries__box border border-success border-4" data-edit="link-block">
                        <img src="show_image.php?image_id=$countries_id&table=$table" alt="error">
                    
                        <div class="countries__name text-white">
                            <h2 contenteditable="false" data-edit="name">$countries_name</h2>
                            <input type="hidden" name="countries" value="$countries_id">
                        </div>
                        <div class="countries__upload-time text-white">
                            <p>
                                <small>$countries_upload_time</small>
                            </p>
                        </div>
                    </a>
                </div>
_END;
                    }
                }
                ?>

            </div>
        </div>
    </div>
</main>
<?php require_once 'footer.php'; ?>
