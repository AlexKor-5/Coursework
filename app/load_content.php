<?php require_once 'header.php'; ?>

<main>
    <div class="container my-container">
        <div class="regions">
            <div class="countries__title text-muted text-center">
                <h1>Сторінка завантаження контенту</h1>
            </div>
            <div class="row gy-4">
                <div class="col-12">

                    <div class="regions__block border border-success border-2">
                        <form action="#" method="post" class="row g-3 needs-validation" novalidate>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Назва</label>
                                <input type="text" name="name" class="form-control" id="validationCustom01" value="" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 300px"></textarea>
                                    <label for="floatingTextarea2">Опис</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Виберіть зображення</label>
                                <input class="form-control" type="file" id="formFileMultiple" name="images" multiple>
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio_btn" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Регіон
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio_btn" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Місто
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio_btn" id="flexRadioDefault3" checked>
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Містечко
                                </label>
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