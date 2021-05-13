<?php require_once 'header.php'; ?>

<main>
    <div class="container my-container">
        <div class="regions">
            <div class="countries__title text-muted text-center">
                <h1>Регіони вибраної вами країни</h1>
            </div>
            <div class="row gy-4">
                <div class="col-12">

                    <div class="regions__block border border-success border-2">
                        <div class="regions__title text-muted">
                            <h2 contenteditable="false" data-edit="name">Північна Дакота</h2>
                            <input type="hidden" name="region_id" value="1111">
                        </div>
                        <div class="regions__description text-muted">
                            <p contenteditable="false" data-edit="description">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Autem consequuntur earum eos
                                maxime nobis quaerat quo repellendus sapiente sed totam? A aliquam culpa dolore ducimus,
                                eos error esse et ex excepturi expedita facilis fuga, fugiat harum labore laboriosam
                                maxime mollitia natus nisi nobis non praesentium quas repellat repellendus reprehenderit
                                similique sint suscipit totam veritatis vero voluptas! Eius hic labore temporibus vero.
                                Consequuntur libero pariatur quia. Eaque illum incidunt magni maiores minima, omnis quis
                                repellendus reprehenderit, repudiandae similique temporibus unde? Accusamus at atque
                                doloremque facilis modi obcaecati optio ratione, rem tenetur unde voluptas voluptatibus?
                                Accusantium animi eum, harum modi odit sit?</p>
                            <input type="hidden" name="region_id" value="1111">
                        </div>
                        <div class="regions__images">
                            <div class="row gy-4">
                                <div class="col-12 col-md-6 col-lg-4 regions__relative">
                                    <form method="post" enctype="multipart/form-data"
                                          class="regions__download-form display-none">
                                        <input type="file" name="image_upload"
                                               accept=".jpg, .jpeg, .png, .gif" data-edit="image">
                                    </form>
                                    <a href="#1" class="regions__item border border-success border-2"
                                       data-edit="link-block">
                                        <img src="images/Tests_images/1280x720.png" alt="error">
                                        <input type="hidden" name="image_id" value="1111i">
                                        <input type="hidden" name="region_id" value="1111">
                                    </a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 regions__relative">
                                    <form method="post" enctype="multipart/form-data"
                                          class="regions__download-form display-none">
                                        <input type="file" name="image_upload"
                                               accept=".jpg, .jpeg, .png, .gif" data-edit="image">
                                    </form>
                                    <a href="#2" class="regions__item border border-success border-2"
                                       data-edit="link-block">
                                        <img src="images/Tests_images/1280x720.png" alt="error">
                                        <input type="hidden" name="image_id" value="1111i">
                                        <input type="hidden" name="region_id" value="1111">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="regions__wrapper">
                            <div class="regions__navigation">
                                <a href="#" class="link-success">Туристичні міста</a>
                                <a href="#" class="link-success">Туристичні містечка</a>
                            </div>
                            <div class="regions__time text-muted">
                                <span><small>Опубліковано: 20:50 07.05.2021</small></span>
                                <span>&nbsp;</span>
                                <span><small data-edit="update_time">ред: 20:50 07.05.2021</small></span>
                            </div>
                        </div>
                    </div>

                    <div class="regions__block border border-success border-2">
                        <div class="regions__title text-muted">
                            <h2 contenteditable="false" data-edit="name">Каліфорнія</h2>
                            <input type="hidden" name="region_id" value="2222">
                        </div>
                        <div class="regions__description text-muted">
                            <p contenteditable="false" data-edit="description">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Autem consequuntur earum eos
                                maxime nobis quaerat quo repellendus sapiente sed totam? A aliquam culpa dolore ducimus,
                                eos error esse et ex excepturi expedita facilis fuga, fugiat harum labore laboriosam
                                maxime mollitia natus nisi nobis non praesentium quas repellat repellendus reprehenderit
                                similique sint suscipit totam veritatis vero voluptas! Eius hic labore temporibus vero.
                                Consequuntur libero pariatur quia. Eaque illum incidunt magni maiores minima, omnis quis
                                repellendus reprehenderit, repudiandae similique temporibus unde? Accusamus at atque
                                doloremque facilis modi obcaecati optio ratione, rem tenetur unde voluptas voluptatibus?
                                Accusantium animi eum, harum modi odit sit?</p>
                            <input type="hidden" name="region_id" value="2222">
                        </div>
                        <div class="regions__images">
                            <div class="row gy-4">
                                <div class="col-12 col-md-6 col-lg-4 regions__relative">
                                    <form method="post" enctype="multipart/form-data"
                                          class="regions__download-form display-none">
                                        <input type="file" name="image_upload"
                                               accept=".jpg, .jpeg, .png, .gif" data-edit="image">
                                    </form>
                                    <a href="#1" class="regions__item border border-success border-2"
                                       data-edit="link-block">
                                        <img src="images/Tests_images/1280x720.png" alt="error">
                                        <input type="hidden" name="image_id" value="2222i">
                                        <input type="hidden" name="region_id" value="2222">
                                    </a>
                                </div>

                                <div class="col-12 col-md-6 col-lg-4 regions__relative">
                                    <form method="post" enctype="multipart/form-data"
                                          class="regions__download-form display-none">
                                        <input type="file" name="image_upload"
                                               accept=".jpg, .jpeg, .png, .gif" data-edit="image">
                                    </form>
                                    <a href="#2" class="regions__item border border-success border-2"
                                       data-edit="link-block">
                                        <img src="images/Tests_images/1280x720.png" alt="error">
                                        <input type="hidden" name="image_id" value="2222i">
                                        <input type="hidden" name="region_id" value="2222">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="regions__wrapper">
                            <div class="regions__navigation">
                                <a href="#" class="link-success">Туристичні міста</a>
                                <a href="#" class="link-success">Туристичні містечка</a>
                            </div>
                            <div class="regions__time text-muted">
                                <span><small>Опубліковано: 20:50 07.05.2021</small></span>
                                <span>&nbsp;</span>
                                <span><small data-edit="update_time">ред: 20:50 07.05.2021</small></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once 'footer.php'; ?>