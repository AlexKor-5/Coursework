<?php
require_once 'function.php';
global $error_message, $system_error_message;
if (isset($_REQUEST['error_message'])) {
    $error_message = $_REQUEST['error_message'];
}
if (!isset($_REQUEST['system_error_message'])) {
    $system_error_message = $_REQUEST['system_error_message'];
} else {
    $system_error_message = "Сообщения о системных ошибках отсутствуют.";
}


?>
<?php require_once 'header.php'; ?>
<main>
    <div class="container my-container">
        <div class="countries">
            <div class="countries__title text-muted text-center">
                <h1>Помилка!</h1><br>
                <h3><?php echo $error_message; ?></h3><br>
                <h3><?php echo $system_error_message; ?></h3>
            </div>
        </div>
    </div>
</main>
<?php require_once 'footer.php'; ?>
