<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Calendar Test</title>
        
        <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    </head>
    <body>
        <?php 
            include 'application/lib/Autoload.php'; 
            Autoload::lib();  //class autoloader

            $view = new View();
        ?>
        <section>
            <h1><?php echo $view->getDisplayMonth() . " " . $view->getYear(); ?></h1>

            <?php
             $view->index(); //call index model

             include 'application/partials/calview.php'; //include calendar layout partial
             include 'application/partials/calform.php'; //include form partial
            ?> 
        </section>
    </body>
</html>
