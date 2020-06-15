<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorateur de fichiers</title>
</head>
<body>
    <?php
    require_once("php/functions.php");
    // go to "home" directory
    chdir(getcwd() . DIRECTORY_SEPARATOR . "home");
    ?>
    <header>
        <nav>
            <ul id="breadcrumb">
                <?php
                //print "home" breadcrumb
                breadcrumb(getcwd());
                ?>
            </ul>
        </nav>
    </header>
    
    <?php
    // print content of home folder
    $content = scandir(getcwd());
    $items = [];
    foreach($content as $item ){
        if($item !== "." && $item !== ".."){
            array_push($items, ["name"=>$item, "isFolder"=>is_dir($item)]);
        }
    }
    printItems(json_encode($items));
    ?>
</body>
</html>