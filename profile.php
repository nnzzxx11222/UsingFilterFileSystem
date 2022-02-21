<?php

session_start();

$username = "ahmed";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my file</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="style.css">
    <link re="stylesheet" href="all.css">
    <script src="all.js"></script>
</head>

<body>
    <header>
        <h1>My Files</h1>
    </header>

    <main>
        <?php
        $direfile = scandir(__dir__ . "/users/ahmed");

        foreach ($direfile as $file) {
            $exten = isset(pathinfo($file)['extension'])?pathinfo($file)['extension'] :"";
            if ($file == '.' || $file == '..') {
                continue;
            } elseif ($exten == "png" || $exten == "jpg" || $exten == "jpeg" || $exten == "gif") {
                $img = 'users/ahmed/' . $file;
        ?>
                <div class='folder'>
                    <img src='<?= $img ?>'>
                    <p class='cooltip'>0 folders / 0 files</p>
                    <h1><?= $file ?></h1>
                </div>
            <?php
            } elseif ($exten == "php") { ?>
                <div style="font-size: 80px;" class='folder'>
                    <i class="fa-brands fa-php">
                    </i>
                    <p class='cooltip'>0 folders / 0 files</p>
                    <h1><?= $file ?></h1>
                </div>
            <?php
            } elseif ($exten == "html") { ?>
                <div style="font-size: 80px;" class='folder'>
                    <i class="fa-brands fa-html5">
                    </i>
                    <p class='cooltip'>0 folders / 0 files</p>
                    <h1><?= $file ?></h1>
                </div>
            <?php
            } elseif ($exten == "css") { ?>
                <div style="font-size: 80px;" class='folder'>
                <i class="fa-brands fa-css3"></i>
                    <p class='cooltip'>0 folders / 0 files</p>
                    <h1><?= $file ?></h1>
                </div>
        <?php
            }elseif($exten == ""){ ?>
                 <div style="font-size: 80px;" class='folder'>
                 <i class="fa-solid fa-folder"></i>
                    <p class='cooltip'>0 folders / 0 files</p>
                    <h1><?= $file ?></h1>
                </div>
                <?php
            } else {?>
             <div style="font-size: 80px;" class='folder'>
             <i class="fa-solid fa-file"></i>
                    <p class='cooltip'>0 folders / 0 files</p>
                    <h1><?= $file ?></h1>
                </div>
<?php
            }
        } ?>

    </main>

</body>

</html>