<!DOCTYPE html>
<html>
    <head>
        <title>MVC Pattern</title>
        <link rel="stylesheet" type="text/css" 
            href="<?= COMMON_URL; ?>Assets/css/style.css" 
        />
        <script type="text/javascript" src="<?= COMMON_URL; ?>Assets/js/script.js"></script>
    </head>
    <body>
        <a href="<?= COMMON_URL; ?>home">Home</a>
        <a href="<?= COMMON_URL; ?>gallery">Gallery</a>
        <h1>My First Heading</h1>
        <hr />
        <?php $this->loadTemplateView($sViewName, $aData); ?>

    </body>
</html>