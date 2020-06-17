<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorateur de fichiers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="container margin">
        <h1>Explorateur de fichiers</h1>
        <nav class=" elevation">
            <ul id="breadcrumb" class="flex"></ul>
        </nav>
    </header>
    
    <main>
        <section id="createFiles" class="container">
            <form id="createFolder" action="">
                <input type="text" name="folderName" value="Nouveau dossier">
                <input type="submit" value="Créer un dossier">
            </form>
            <form id="createFile" action="">
                <input type="text" name="fileName" value="Nouveau fichier">
                <input type="submit" value="Créer un fichier">
            </form>
        </section>
        
        <section id="listFiles" class="container"></section>
    </main>

    <?php
    // go to "home" directory
    $url = getcwd() . DIRECTORY_SEPARATOR . "home";
    chdir($url);
    $url = json_encode($url);
    ?>

    <script src="script.js"></script>
    <script>
        //fill index page on loading
        navigate(<?=$url?>);
    </script>
</body>
</html>