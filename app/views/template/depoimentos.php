<div class="ak-height-125 ak-height-lg-80"></div>
<div class="container">
    <div class="ak-testimonal-controll">
        <div class="testimonal-heading" data-aos="fade-right">
            <div class="ak-section-heading ak-style-1">
                <div class="background-text" data-aos="fade-right" data-aos-duration="1000">Testimonial</div>
                <h2 class="ak-section-title">SEE WHAT OUR Satisfied <br> Customer SAYS</h2>
            </div>
        </div>
        <div class="testimonal-controll" data-aos="fade-left">
            <button class="testimonal-prev button">
                <img src="assets/img/prev.svg" alt="..."><span> prev</span>
            </button>
            <button class="testimonal-next button">
                <span>next</span> <img src="assets/img/next.svg" alt="..">
            </button>
        </div>
    </div>
    <div class="ak-height-50 ak-height-lg-50"></div>
    <div class="ak-testimonal" data-aos="fade-up">
        <div class="ak-slider ak-slider-testimonal">
            <div class="swiper-wrapper">

                
                <?php foreach ($depoimentos as $depoimento): ?>

                    <div class="swiper-slide">
                    <div class="testimonal-info ak-style1">
                        <div class="slider-info">
                            <div class="d-flex justify-content-between align-items-end">
                                <div>
                                    <h5 class="name"><?php echo htmlspecialchars($depoimento['nome_cliente'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                    <p class="from">From <?php echo htmlspecialchars($depoimento['cidade_cliente'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="109" height="81"
                                        viewBox="0 0 109 81" fill="none">
                                        <g opacity="0.7" clip-path="url(#clip0_219_726)">
                                            <path
                                                d="M24.8606 80.2504C27.2135 76.6896 47.9194 44.6582 51.3233 31.1053C53.5194 22.3053 51.8096 15.5445 45.739 9.14449C36.0449 -1.09865 19.8567 -1.11431 11.0096 6.43079C1.59785 14.4622 -1.14726 29.8504 5.45666 39.2622C10.539 46.4935 15.2292 48.219 25.1586 51.4503C25.4253 56.5797 24.9861 77.0975 24.8606 80.2504Z"
                                                fill="#FF3D24" />
                                            <path
                                                d="M81.2214 80.2504C83.5743 76.6896 104.28 44.6582 107.668 31.1053C109.88 22.3053 108.155 15.5445 102.084 9.14449C92.4057 -1.09865 76.2175 -1.11431 67.3704 6.43079C57.9586 14.4622 55.1978 29.8504 61.8174 39.2622C66.8841 46.4935 71.5743 48.219 81.5194 51.4503C81.7861 56.5797 81.3312 77.0975 81.2214 80.2504Z"
                                                fill="#FF3D24" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_219_7263">
                                                <rect width="108.235" height="80" fill="white"
                                                    transform="translate(0.671997 0.966797)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="desp">“<?php echo htmlspecialchars($depoimento['descricao_depoimento'], ENT_QUOTES, 'UTF-8'); ?>”</h4>
                        </div>
                        <img src="<?php
                                        $caminhoArquivo = $_SERVER['DOCUMENT_ROOT'] . "/kioficina/public/uploads/" . $depoimento['foto_cliente'];
                                        if ($depoimento['foto_cliente'] != "") {
                                            if (file_exists($caminhoArquivo)) {

                                                echo ("http://localhost/kioficina/public/uploads/" . htmlspecialchars($depoimento['foto_cliente'], ENT_QUOTES, 'UTF-8'));
                                            } else {

                                                echo ("http://localhost/kioficina/public/uploads/cliente/sem-foto-cliente.jpg");
                                            }
                                        } else {

                                            echo ("http://localhost/kioficina/public/uploads/cliente/sem-foto-cliente.jpg");
                                        }


                                        ?>" alt="<?php echo htmlspecialchars($depoimento['alt_foto_cliente'], ENT_QUOTES, 'UTF-8'); ?>" class="testimaonial-slide-img">
                    </div>
                </div>


                 
                <?php endforeach ?>






            </div>
        </div>
        <div class="testimonal-img">
            <img src="assets/img/testimaonial-img-bg.png" alt="..." />
        </div>
    </div>
</div>