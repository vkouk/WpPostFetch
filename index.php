<?php include_once 'feed.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WpPostFetch</title>
</head>
<body>
<?php
    $url          =  'http://' . $_GET['url'];
    $version      =   get_meta_tags($url);
    $version      =   explode('-', $version['generator']);
    $version      =   explode(' ', $version[0]);
    $wpUrl        =  '';

    echo "If you would like to move on a newest version of service please click this " . '<a href="posts.php">link</a><br><br>';

    if (isset($_GET['url']) || empty($url)) {
        if ((float) $version[1] >= 4.4) {
            $wpUrl = $url . '/wp-json/wp/v2/posts';

            Feed::getDataAsJSON($wpUrl);
        }
        else if ((float) $version[1] < 4.4) {
            $wpUrl = $url . '/feed';

            Feed::getRSSAsJSON($wpUrl);
        }
    } else {
        echo "{<br> Message: No data found! <br>}";
    }
?>
</body>
</html>