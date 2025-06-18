<!DOCTYPE html>
<html class="no-js" lang="pt-br">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Douglas" content="Thememarch" />
    <!-- Favicon Icon -->
    <link rel="icon" href="http://localhost/kioficina/public/assets/img/favicon.svg" />
    <!-- Site Title -->
    <title><?php echo isset($titulo) ? $titulo : 'Kioficina '; ?></title>
    <link rel="stylesheet" href="http://localhost/kioficina/public/assets/css/plugins/lightgallery.min.css">
    <link rel="stylesheet" href="http://localhost/kioficina/public/assets/css/plugins/swiper.min.css">
    <link rel="stylesheet" href="http://localhost/kioficina/public/assets/css/plugins/aos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/kioficina/public/assets/css/style.css">
</head>

<body>

    <?php require_once('template/preloader.php'); ?>

    <?php require_once('template/topo.php'); ?>

    <?php require_once('template/banner.php'); ?>

    <?php require_once('template/serviceProgress.php'); ?>

    <?php require_once('template/mychose.php'); ?>

    <?php require_once('template/service.php'); ?>

    <?php require_once('template/video.php'); ?>

    <?php require_once('template/factCounter.php'); ?>

    <?php require_once('template/depoimentos.php'); ?>

    <?php require_once('template/marcas.php'); ?>

    <?php require_once('template/team.php'); ?>

    <?php require_once('template/pricing.php'); ?>

    <?php require_once('template/blog.php'); ?>

    <?php require_once('template/scrollUp.php'); ?>

    <?php require_once('template/videoPopup.php'); ?>


    <?php require_once('template/footer.php'); ?>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/lightgallery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/SplitText.min.js"></script>

    <script src="assets/js/main.js"></script>



    <?php if (isset($msg) && ($tipo_msg) == 'erro-tipo_usuario'): ?>
        <script>
            $(document).ready(() => {
                $('exampleModal').modal('show');

            })
        </script>
    <?php endif; ?>
</body>

</html>