<?php
require_once 'all_content_vis.php';
$all_regions = gather_data('countries_id', 'countries_id', 'regions');
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
                    <?php echo visualization_html($all_regions); ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once 'footer.php'; ?>

