<?php include_once 'feed.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WpPostFetch - Posts</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 l-post-header">
                <h3>Please type url of wordpress website you want to fetch posts.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 l-post">
                <form name="form" action="" method="get">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon3">http://</span>
                        <input type="text" class="form-control" name="basic-url" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $_GET['basic-url'] ?>">
                        <span class="input-group-addon" id="basic-addon3">Search:</span>
                        <input type="text" class="form-control" name="search" id="search" aria-describedby="basic-addon3" value="<?php echo $_GET['search'] ?>">

                        <input type="submit" class="btn btn-outline-light" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 wp-posts">
                <h2>Recent posts</h2>
                <ul>
                    <?php
                        $url          =  'http://' . $_GET['basic-url'];
                        $search       =   $_GET['search'];
                        $version      =   get_meta_tags($url);
                        $version      =   explode('-', $version['generator']);
                        $version      =   explode(' ', $version[0]);
                        $wpUrl        =  '';

                        if (isset($_GET['basic-url']) && !empty($_GET['basic-url'])) {
                            if ((float) $version[1] >= 4.4) {
                                $wpUrl = $url . '/wp-json/wp/v2/posts';

                                if (isset($search)) {
                                    $wpUrl .= '?search=' . strtolower($_GET['search']);
                                    Feed::getData($wpUrl);
                                } else {
                                    Feed::getData($wpUrl);
                                }
                            }
                            else if ((float) $version[1] < 4.4) {
                                $wpUrl = $url . '/feed';

                                Feed::getRSSData($wpUrl);
                            }
                        } else {
                            echo "No data found!";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>