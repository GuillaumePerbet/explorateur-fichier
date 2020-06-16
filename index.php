<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorateur de fichiers</title>
</head>
<body>
    <?php
    // go to "home" directory
    $url = getcwd() . DIRECTORY_SEPARATOR . "home";
    chdir($url);
    $url = json_encode($url);
    ?>

    <header>
        <nav>
            <ul id="breadcrumb"></ul>
        </nav>
    </header>
    
    <main>
        <section id="listFiles"></section>
    </main>

    <script src="script.js"></script>
    <script>
        setSessionUrl(<?=$url?>);
        breadcrumbUpdate(sessionStorage.getItem("url"));
        filesListUpdate(sessionStorage.getItem("url"));
    </script>
</body>
</html>