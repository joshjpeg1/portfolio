<?php

$index = 0;
$works = json_decode(file_get_contents("./data/projects.json"));

function search($query) {
    global $index, $works;
    foreach ($works as $proj) {
        if($proj->url == $query) {
            return $proj;
        }
        $index += 1;
    }
    return null;
}

$project = search($_GET['project']);

if ($project == null) {
    header('Location: /404.html');
}

function widow_fix($text) {
    return $text;
}

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $project->title ?> | Josh Pensky</title>
        <meta content="text/html; charset=utf-8" http-equiv="content-type"/>
        <meta content="en-us" http-equiv="Content-Language"/>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0" />
        <meta name="google" content="notranslate" />
        <meta name="google" content="nositelinkssearchbox" />
        <meta name="author" content="Joshua Pensky" />
        <link rel="author" href="../humans.txt" />
        <meta name="robots" content="index,nofollow" />
        <!-- Tags for Facebook and Twitter -->
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.joshuapensky.com/projects/josh-pensky" />
        <meta property="og:title" content="<?php echo $project->title ?> | Josh Pensky" />
        <meta property="og:description" content="I am Josh Pensky, a Boston-based designer and front-end developer passionate about designing and bulding exceptional user experiences." />
        <meta property="og:image" content="https://www.joshuapensky.com/img/sharing/facebook.png" />
        <meta name="twitter:image" content="https://www.joshuapensky.com/img/sharing/twitter.png" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="<?php echo $project->title ?> | Josh Pensky" />
        <meta name="twitter:description" content="I am Josh Pensky, a Boston-based designer and front-end developer passionate about designing and bulding exceptional user experiences." />
        <!-- Favicons -->
        <link rel="icon" type="image/png" sizes="96x96" href="../img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
        <link rel="stylesheet" type="text/css" href="../fonts/CocogoosePro-Regular.css">
        <link rel="stylesheet" type="text/css" href="../css/work.css">
        <script async type="text/javascript" src="../js/nav.js"></script>
        <script async type="text/javascript" src="../js/slideshow.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js"></script>
    </head>
    <body>
        <nav>
            <div class="nav__container">
                <a href="../index.html"><div id="logo"></div></a>
                <ul class="nav-bar">
                    <a href="../about.html" class="nav-bar__item">about</a>
                    <a href="../projects.html" class="nav-bar__item">projects</a>
                    <a href="../chat.html" class="nav-bar__item">let's chat</a>
                </ul>
            </div>
        </nav>
        <div class="master-container">
            <div class="container">
                <h1 id="title"><?php echo $project->title ?></h1>
                <div class="main">
                    <div class="info">
                        <div id="info__about">
                            <h4 class="info__subtitle">about</h4>
                            <p class="info__body"><?php echo widow_fix($project->desc_long); ?></p>
                        </div>
                        <div id="info__tools">
                            <h4 class="info__subtitle">tools</h4>
                            <ul class="info__list">
                                <?php foreach($project->tools as $tool) {
                                    echo "<li class='info__list__item'>{$tool}</li>";
                                } ?>
                            </ul>
                        </div>
                        <div id="info__year">
                            <h4 class="info__subtitle">year</h4>
                            <p class="info__body"><?php echo $project->date->year ?></p>
                        </div>
                    </div>
                    <div id="viewer" style="background-image: url('/<?php echo $project->img[0] ?>');"></div>
                </div>
                <div class="slide-container">
                    <div class="slide-container__indicator slide-container__indicator--left slide-container__indicator--hidden"></div>
                    <ul class="slide-list">
                        <div id="selector"></div>
                        <?php
                            $first = true;
                            foreach ($project->img as $thumb) {
                                $class = $first ? ' slide__item--selected' : '';
                                echo "<li class='slide__item {$class}' style='background-image: url(/{$thumb})' onclick='selectItem(this);'></li>";
                                $first = false;
                            }
                        ?>
                    </ul>
                    <div class="slide-container__indicator slide-container__indicator--right slide-container__indicator--hidden"></div>
                </div>
                <div class="directions">
                    <?php
                    function advance($direction, $proj_dir) {
                        if (isset($proj_dir)) {
                            return
                            "<a href='/projects/{$proj_dir->url}'>
                                <div id='{$direction}'>
                                    <h4 class='direction__dir'>{$direction}</h4>
                                    <p class='direction__title'>{$proj_dir->title}</p>
                                </div>
                            </a>";
                        }
                    }

                    echo advance('previous', $works[$index - 1]);
                    echo advance('next', $works[$index + 1]);
                     ?>
                </div>
            </div>
        </div>
        <footer>
            <div class="footer__copy">&copy; 2017 Joshua Pensky</div>
            <div class="footer__links">
                <a href="https://github.com/joshjpeg1" target="_blank" rel="noreferrer noopener"><img id="github" src="../img/github.png" /></a>
                <a href="https://www.linkedin.com/in/joshuapensky/" target="_blank" rel="noreferrer noopener"><img id="linkedin" src="../img/linkedin.png" /></a>
            </div>
        </footer>
        <script>
            WebFont.load({
                google: {
                    families: ['Roboto:400,500']
                }
            });
        </script>
    </body>
</html>