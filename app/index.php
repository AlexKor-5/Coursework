<?php require_once 'header.php'; ?>
<main>
    <div class="container my-container">
        <div class="countries">
            <div class="countries__title text-muted text-center">
                <h1>Оберіть країну для подорожі</h1>
            </div>
            <div class="row gy-4">
                <div class="col-12 col-md-6 col-lg-4 col-xxl-3 countries__relative">
                    <form method="post" enctype="multipart/form-data" class="countries__download-form display-none">
                        <input type="file" name="image_upload" accept=".jpg, .jpeg, .png, .gif" data-edit="image">
                    </form>
                    <a href="#" class="countries__box border border-success border-4" data-edit="link-block">
                        <img src="images/Tests_images/1920x1080.jpg" alt="error">
                        <div class="countries__name text-white">
                            <h2 contenteditable="false" data-edit="name">США</h2>
                            <input type="hidden" name="image_id" value="3435366">
                            <input type="hidden" name="country_id" value="34353">
                        </div>
                        <div class="countries__upload-time text-white"><p><small>07.05.2021</small></p></div>
                    </a>
                </div>


                <div class="col-12 col-md-6 col-lg-4 col-xxl-3 countries__relative">
                    <form method="post" enctype="multipart/form-data" class="countries__download-form display-none">
                        <input type="file" name="image_upload" accept=".jpg, .jpeg, .png, .gif" data-edit="image">
                    </form>
                    <a href="#" class="countries__box border border-success border-4" data-edit="link-block">
                        <img src="images/Tests_images/1920x1080.jpg" alt="error">
                        <div class="countries__name text-white">
                            <h2 contenteditable="false" data-edit="name">США</h2>
                            <input type="hidden" name="image_id" value="3435366">
                            <input type="hidden" name="country_id" value="34353">
                        </div>
                        <div class="countries__upload-time text-white"><p><small>07.05.2021</small></p></div>
                    </a>
                </div>


            </div>
        </div>
    </div>
</main>
<?php require_once 'footer.php'; ?>
