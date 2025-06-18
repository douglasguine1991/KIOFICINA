<div class="ak-height-190 ak-height-lg-80"></div>
<div class="container">
    <div class="team-contant">
        <div class="team-heading" data-aos="fade-right">
            <div class="ak-section-heading ak-style-1">
                <div class="background-text" data-aos="fade-right" data-aos-duration="1000">Team</div>
                <h2 class="ak-section-title">Our Team</h2>
                <p class="ak-section-subtitle">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's stan.</p>
            </div>
            <div class="ak-height-50 ak-height-lg-10"></div>
            <a href="team.html" class="more-btn">VIEW MORE</a>
        </div>
        <div class="teams" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="100"
            data-aos-offset="0">
            <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1 g-3 g-md-3">
               



                <?php foreach ($funcionarios as $funcionario): ?>



                    <div class="col">
                    <div class="team-card ak-bg" data-src="<?php
                                        $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/kioficina/public/uploads/" . $funcionario['foto_funcionario'];
                                        if ($funcionario['foto_funcionario'] != "") {
                                            if (file_exists($caminhoArquivo)) {

                                                echo ("http://localhost/kioficina/public/uploads/" . htmlspecialchars($funcionario['foto_funcionario'], ENT_QUOTES, 'UTF-8'));
                                            } else {

                                                echo ("http://localhost/kioficina/public/uploads/funcionario/sem-foto-funcionario.jpg");
                                            }
                                        } else {

                                            echo ("http://localhost/kioficina/public/uploads/funcionario/sem-foto-funcionario.jpg");
                                        }


                                        ?>">
                        <div class="team-style-1">
                            <div class="team-info">
                                <div class="team-title">
                                    <a href="team-single.html">
                                    <h4 class="title"><?php echo htmlspecialchars($funcionario['nome_funcionario'], ENT_QUOTES, 'UTF-8'); ?></a>
                                    <p class="desp"><?php echo htmlspecialchars($funcionario['cargo_funcionario'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                                <div class="team-info-social">
                                    <a href="https://www.facebook.com/" class="icon"><img
                                            src="assets/img/linkedinicon.svg" alt="..."></a>
                                    <a href="https://bd.linkedin.com/" class="icon"><img
                                            src="assets/img/facebookicon.svg" alt=""></a>
                                    <a href="https://www.instagram.com/" class="icon"><img
                                            src="assets/img/twittericon.svg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






                <?php endforeach ?>


              
            </div>
        </div>
    </div>
</div>