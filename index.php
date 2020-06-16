<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorateur de fichiers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // go to "home" directory
    $url = getcwd() . DIRECTORY_SEPARATOR . "home";
    chdir($url);
    $url = json_encode($url);
    ?>

    <header class="container">
        <nav class=" elevation">
            <ul id="breadcrumb" class="flex"></ul>
        </nav>
    </header>
    
    <main>
        <section id="listFiles" class="container"></section>
    </main>

    <script src="script.js"></script>
    <script>
        setSessionUrl(<?=$url?>);
        breadcrumbUpdate(sessionStorage.getItem("url"));
        filesListUpdate(sessionStorage.getItem("url"));
    </script>
</body>
</html>