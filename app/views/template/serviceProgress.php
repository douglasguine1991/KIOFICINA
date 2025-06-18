<div class="ak-height-125 ak-height-lg-80"></div>
<section class="container">
    <div class="row  row-cols-1 row-cols-xl-3 g-4 ">

        

        
        <?php foreach ($servicos as $servico): ?>

            <div class="service-progress-card" data-aos="fade-up" data-aos-delay="100">
            <div class="progress-item">
                <h4 class="ak-stroke-number color-white">02</h4>
                <div class="ak-border-width"></div>
            </div>
            <div class="service-item">
                <div class="heartbeat-icon">
                    <a href="">
                        <span class="ak-heartbeat-btn"><img src="assets/img/car-repair.svg" alt="..."></span>
                    </a>
                </div>
                <div class="service-info">
                    <h4 class="title"><?php echo htmlspecialchars($servico['nome_servico'], ENT_QUOTES, 'UTF-8'); ?></h4>
                    <p class="desp"><?php echo htmlspecialchars($servico['descricao_servico'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
        </div>

        <?php endforeach ?>








    </div>
</section>