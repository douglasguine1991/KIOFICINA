<div class="ak-height-125 ak-height-lg-80"></div>
<div class="d-flex justify-content-center">
    <div class="sticky-content container">
        <div class="content style_2">
            <div class="service">

                <?php foreach ($servicos as $servico): ?>

                    <div class="service-card" data-aos="fade-left">
                        <a href="services-single.html" class="card-img">
                      
                      <img src="<?php
                                        $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/kioficina/public/uploads/" . $servico['foto_galeria'];
                                        if ($servico['foto_galeria'] != "") {
                                            if (file_exists($caminhoArquivo)) {

                                                echo ("http://localhost/kioficina/public/uploads/" . htmlspecialchars($servico['foto_galeria'], ENT_QUOTES, 'UTF-8'));
                                            } else {

                                                echo ("http://localhost/kioficina/public/uploads/galeria/sem-foto-servico.png");
                                            }
                                        } else {

                                            echo ("http://localhost/kioficina/public/uploads/galeria/sem-foto-servico.png");
                                        }


                                        ?>" class="ak-bg" alt="...">

                        </a>
                        <div class="card-info">
                            <a href="services-single.html" class="card-title"><?php echo htmlspecialchars($servico['nome_servico'], ENT_QUOTES, 'UTF-8'); ?></a>
                            <p class="card-desp"><?php echo htmlspecialchars($servico['descricao_servico'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <a href="<?php echo "servico/detalhe/" . htmlspecialchars($servico['nome_servico'],ENT_QUOTES,'UTF-8'); ?>" class="more-btn">VIEW MORE</a>
                        </div>
                    </div>

                <?php endforeach ?>

            </div>
        </div>
        <div class="sidebar width-none">
            <div class="services-content">
                <div class="ak-section-heading ak-style-1">
                    <div class="background-text" data-aos="fade-right" data-aos-duration="1000">Services</div>
                    <h2 class="ak-section-title">Dedicated<br> Services</h2>
                    <p class="ak-section-subtitle">Lorem Ipsum is simply dummy text of the printing and
                        typesetting
                        industry. Lorem Ipsum has been the industry's stan. Lorem Ipsum is simply dummy text of
                        the
                        printing and typesetting industry. Lorem Ipsum.</p>
                </div>
                <div class="ak-height-50 ak-height-lg-10"></div>
                <a href="" class="more-btn">VIEW All SERVICES</a>
            </div>
        </div>
    </div>
</div>
<div class="scroll-end-point"></div>