<!-- TEMP FOR DEBUG -->
<?php require_once("php/articler.php"); ?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>articler</title>
        <meta name="description" content="Articler article creator.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"> 

        <!-- Style Sheets -->
        <link rel="stylesheet" href="style/reset.css">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="style/articler.css">

        <!-- TODO: Favicons -->

        <!-- JavaScript -->
        <script src="js/jquery/jquery-3.5.1.min.js"></script>
        <script src="js/jquery/ui/jquery-ui.min.js"></script>
        <script src="js/common.js"></script>
    </head>

    <body>
        <!-- <?php print (new ArticlerError("TestError", "test message")); ?>
        <?php print (new IR("<p style=\"color:red\">data</p>", "remainder")); ?>
        <?php print "eof?: " . at_eof((new IR("<p style=\"colour:red\">data</p>", "remainder"))); ?>
        <?php print "eof?: " . at_eof((new IR("<p style=\"colour:red\">data</p>", ""))); ?> -->
        <?php
        $dummy_file = <<<EOT
        # Title Text &c. © Me
        para
        
        ## subtitle
        a
        long
        para!
        
        another para
        
        ### subsubtitle
        paraaaaaaaaa
        
        EOT;
        ?>
        <?php print parse($dummy_file) ?>
    </body>

</html>