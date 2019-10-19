<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $title ?></title>
        <link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700,800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="http://localhost:8888/projet4_OC/public/css/mystyle.css" type="text/css">
        <link rel="stylesheet" media="screen and (max-width: 768px)" href="http://localhost:8888/projet4_OC/public/css/mobilestyle.css">
        <script src='https://cdn.tiny.cloud/1/4fq6p6frhqgs06ikee1ufp208mud2qcakkfevk8gmyccy0yq/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '.mytextarea',
                invalid_elements : 'p,div,br',
                force_br_newlines : false,
                force_p_newlines : false,
                menubar: false,
                language: 'fr_FR',
                language_url : 'public/js/fr_FR.js'
            });
        </script>
</head>
<body>

<?php 

echo $content ?>
    
</body>
</html>