<div class="ak-height-125 ak-height-lg-80"></div>
<div class="container">
    <div class="ak-slider ak-trusted-client-slider">
        <h4 class="title">Trusted Client</h4>
        <div class="swiper-wrapper">

            <?php foreach ($marcas as $marca): ?>

                <div class="swiper-slide">

                    <div class="trusted-client">
                        <img src="<?php
                                    $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/kioficina/public/uploads/" . $marca['logo_marca'];
                                    if ($marca['logo_marca'] != "") {
                                        if (file_exists($caminhoArquivo)) {

                                            echo ("http://localhost/kioficina/public/uploads/" . htmlspecialchars($marca['logo_marca'], ENT_QUOTES, 'UTF-8'));
                                        } else {

                                            echo ("http://localhost/kioficina/public/uploads/logo/sem-foto-logo.jpg");
                                        }
                                    } else {

                                        echo ("http://localhost/kioficina/public/uploads/logo/sem-foto-logo.jpg");
                                    }


                                    ?>" alt="<?php echo htmlspecialchars($marca['alt_marca'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                </div>





            <?php endforeach ?>

        </div>
    </div>
</div>