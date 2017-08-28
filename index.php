<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WpPostFetch</title>
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
            <div class="col-6 l-post">
                <form name="form" action="" method="post">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon3">http://</span>
                        <input type="text" class="form-control" name="basic-url" id="basic-url" aria-describedby="basic-addon3">

                        <button type="submit" class="btn btn-outline-light">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 wp-posts">
                <h2>Recent posts</h2>
                <ul>
                    <?php
                        $url          =  'http://' . $_POST['basic-url'];
                        $url1         =  'http://demo.wp-api.org';
                        $endpoint     =  '/wp-json/wp/v2/posts';
                        $wpUrl        =  $url1 . $endpoint;
                        $data         =  file_get_contents($wpUrl);
                        $result       =  json_decode($data, true);

                        foreach ($result as $posts) {
                            $content = $posts['content']['rendered'];
                            $title   = $posts['title']['rendered'];
                            echo "<li>Title: ";
                            $post = print_r($title);
                            echo "<p>Content: ";
                            $post = print_r($content);

                        }

                        if (empty($data)) {
                            echo "<li><p>No posts found from $url1 .</p></li>";
                        } else {
                            echo $post;
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>