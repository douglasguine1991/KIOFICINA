<!DOCTYPE html>
<html class="no-js" lang="pt-br">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="Douglas" content="Thememarch" />
    <!-- Favicon Icon -->
    <link rel="icon" href="http://localhost/kioficina/public/assets/img/favicon.svg" />
    <!-- Site Title -->
    <title><?php echo isset($titulo) ? $titulo : 'Kioficina '; ?></title>
    <link rel="stylesheet" href="http://localhost/kioficina/public/assets/css/plugins/lightgallery.min.css">
    <link rel="stylesheet" href="http://localhost/kioficina/public/assets/css/plugins/swiper.min.css">
    <link rel="stylesheet" href="http://localhost/kioficina/public/assets/css/plugins/aos.css">
    <link rel="stylesheet" href="http://localhost/kioficina/public/assets/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/kioficina/public/assets/css/style.css">
</head>

<body>

    <?php require_once('template/preloader.php'); ?>

    <?php require_once('template/topo.php'); ?>



    <div class="ak-height-125 ak-height-lg-80"></div>
    <div class="container">
        <div class="d-md-flex justify-content-between align-items-center">


            <div class="common-page-title">

            
                <h3 class="page-title"><?php echo $detalhes['nome_servico'] ?></h3>
                <div class="d-flex gap-2 align-items-center">
                    <p>Home /</p>
                    <a href="/services.html">Services</a>
                </div>
            </div>

            
            <div class="pb-5 pb-md-0">
                <div class="next-prev-btn">
                    <button class="prev-btn button">
                        <img src="assets/img/prev.svg" alt="..."><span> prev</span>
                    </button>
                    <button class="next-btn button">
                        <span>next</span> <img src="assets/img/next.svg" alt="..">
                    </button>
                </div>
            </div>
        </div>
        <div class="primary-color-border"></div>
    </div>

    <?php require_once('template/content.php'); ?>


    <?php require_once('template/faq.php'); ?>

   


    <?php require_once('template/footer.php'); ?>


    <?php require_once('template/scrollUp.php'); ?>

    <?php require_once('template/videoPopup.php'); ?>

    <!-- Script -->
    <script src="assets/js/plugins/jquery-3.7.1.min.js"></script>
    <script src="assets/js/plugins/lightgallery.min.js"></script>
    <script src="assets/js/plugins/simplePagination.min.js"></script>
    <script src="assets/js/plugins/aos.js"></script>
    <script src="assets/js/plugins/swiper.min.js"></script>
    <script src="assets/js/plugins/SplitText.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>