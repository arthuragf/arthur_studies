<!DOCTYPE html>
<html>
    <head>
        <title>MVC Pattern</title>
    </head>
    <body>
        <a href="<?= COMMON_URL; ?>home">Home</a>
        <a href="<?= COMMON_URL; ?>gallery">Gallery</a>
        <h1>My First Heading</h1>
        <hr />
        <?php $this->loadTemplateView($sViewName, $aData); ?>

    </body>
</html>