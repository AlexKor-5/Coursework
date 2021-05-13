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
                        <form action="#" method="post" class="row g-3 needs-validation" novalidate>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Назва країни</label>
                                <input type="text" class="form-control" id="validationCustom01" value="" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Виберіть зображення</label>
                                <input class="form-control" type="file" id="formFile">
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