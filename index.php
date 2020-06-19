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
        <section id="sortSection"  class="container">
            <button class="button" id="sortBtn">Tri par Nom</button>
        </section>

        <section id="listFiles" class="container flex wrap"></section>

        <section id="createFiles" class="container flex flexend">
            <form id="createFolder" action="" class="flex column">
                <input type="text" name="folderName" placeholder="nom du dossier">
                <input class="button" type="submit" value="Créer un dossier">
            </form>

            <form id="createFile" action="" class="flex column">
                <input type="text" name="fileName" placeholder="nom du fichier">
                <input class="button" type="submit" value="Créer un fichier">
            </form>

            <button class="button" onclick="pasteFile()">Coller ici</button>
        </section>

    </main>

    <?php
    // go to "Home" directory
    $url = getcwd() . DIRECTORY_SEPARATOR . "Home";
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