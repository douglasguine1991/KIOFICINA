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


    <div class="error-section ak-bg ak-center" data-src="assets/img/not-found-page-bg.png">
        <div class="error-content">
            <h1 class="error-title ak-stroke-number color-white">404</h1>
            <h2 class="erro-sub-title">Sorry! The Page isn't Found Here</h2>
            <p class="erro-desp">Fortunately, since it is mainly a client-side issue, it is relatively easy for website
                owners to fix the
                404 error. This article will explain the possible causes of error 404 and show four effective methods to
                resolve it.Fortunately, since it is mainly a client-side issue.</p>
            <div class="go-to-home">
                <a href="http://localhost/kioficina/public/home" class="common-btn">
                    BACK TO HOME
                </a>
            </div>
        </div>

    </div>

    <?php require_once('template/footer.php'); ?>


    <!-- Script -->
    <script src="http://localhost/kioficina/public/assets/js/plugins/jquery-3.7.1.min.js"></script>
    <script src="http://localhost/kioficina/public/assets/js/plugins/lightgallery.min.js"></script>
    <script src="http://localhost/kioficina/public/assets/js/plugins/simplePagination.min.js"></script>
    <script src="http://localhost/kioficina/public/assets/js/plugins/aos.js"></script>
    <script src="http://localhost/kioficina/public/assets/js/plugins/swiper.min.js"></script>
    <script src="http://localhost/kioficina/public/assets/js/plugins/SplitText.min.js"></script>
    <script src="http://localhost/kioficina/public/assets/js/main.js"></script>
</body>

</html>