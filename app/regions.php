<?php
include_once 'function.php';
global $conn;

if (!isset($_REQUEST['countries_id'])) {
    handle_error("Не вказане зображення для завантаження", "Не вказане зображення для завантаження");
}
$countries_id = $_REQUEST['countries_id'];
$query = sprintf("SELECT * FROM regions WHERE countries_id = %d", $countries_id);
$res = $conn->query($query);
($res) or handle_error("Трапився збій при отриманні інформації про країни від бази даних", $conn->connect_error);
//echo 'ok';

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

                        <?php
                        if ($res->num_rows) {
                            for ($i = 0; $i < $res->num_rows; ++$i) {
                                $res->data_seek($i);
                                $row = $res->fetch_array(MYSQLI_ASSOC);
                                $name = $row['name'];
                                $description = $row['description'];
                                $regions_id = $row['regions_id'];
                                $upload_time = $row['upload_time'];

//        $sub_query = sprintf("SELECT * FROM images WHERE regions_id = %d", $regions_id);
//        $result = $conn->query($sub_query);
//        ($result) or handle_error("Трапився збій при отриманні інформації про країни від бази даних", $conn->connect_error);

                                echo <<<_END
                       <div class="regions__block border border-success border-2">
                            <div class="regions__title text-muted">
                                <h2 contenteditable="false" data-edit="name">$name</h2>
                                <input type="hidden" name="region_id" value="$regions_id">
                            </div>
                            <div class="regions__description text-muted">
                                <p contenteditable="false" data-edit="description">
                                 $description
                                </p>
                                <input type="hidden" name="region_id" value="$regions_id">
                            </div>
                            <div class="regions__images">
                                <div class="row gy-4">
                                 </div>
                            </div>
                            <div class="regions__wrapper">
                                <div class="regions__navigation">
                                    <a href="#" class="link-success">Туристичні міста</a>
                                    <a href="#" class="link-success">Туристичні містечка</a>
                                </div>
                                <div class="regions__time text-muted">
                                    <span><small>Опубліковано: $upload_time</small></span>
                                    <span>&nbsp;</span>
<!--                                    <span><small data-edit="update_time">ред: 20:50 07.05.2021</small></span>-->
                                </div>
                            </div>
                        </div>
_END;
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>


<?php require_once 'footer.php'; ?>