<?php

class Feed
{
    public static function fetchFeaturedImage($url, $f_id) {
        $url = explode('posts', $url);
        $url = $url[0] .'media/' . $f_id;
        $content = file_get_contents($url);
        $f_image = json_decode($content, true);

        $f_link = explode('uploads', $f_image['guid']['rendered']);
        $website_url = explode('wp-json', $url);
        $f_link = $website_url[0] . 'uploads' . $f_link[1];

        return '<img style="width:300px; height:300px;" src="'.$f_link.'" alt="'.$f_image['title']['rendered'].'"/>';
    }

    public static function getDataAsJSON($feed_url) {
        $content   = file_get_contents($feed_url);
        $result    = json_decode($content, true);
        $result    = array_slice($result, 0 , 10);

        foreach ($result as $post) {
            $date = date('Y/m/d', strtotime($post['date']));
            $posts = implode(' ', array_slice(explode(' ', $post['content']['rendered']), 0, 50));

            if ($post['featured_media'] !== 0) {
                $featured_image = 'Featured Image: '. self::fetchFeaturedImage($feed_url, $post['featured_media']);
            } else {
               echo "No featured image exists!";
            }

            echo "{<br>";
            echo ''. $featured_image .'<br>
            <br>Date: '. $date .'<br>
        <br><a href=' . json_encode($post['link'], JSON_UNESCAPED_SLASHES) .'> '. json_encode($post['title']['rendered'], JSON_PRETTY_PRINT) .'</a><br>
               <br>Content:' . $posts .'';
            echo "<br>}<br><br>";
        }
    }

    public static function getRSSAsJSON($feed_url) {
        $content = file_get_contents($feed_url);
        $x = simplexml_load_string($content, null, LIBXML_NOCDATA);

        foreach($x->channel->item as $entry) {
            $date = date('Y/m/d', strtotime((string)$entry->pubDate));

            echo "{<br><br>";
            echo "Date: ";
            print_r($date);
            echo "<br> Title: ";
            print_r((string)$entry->title);
            echo "<br> Content: ";
            print_r((string)$entry->description);
            echo "<br><br>}<br><br>";
        }
    }

    public static function getData($feed_url) {
        $content = file_get_contents($feed_url);
        $result  = json_decode($content, true);
        $result  = array_slice($result, 0 , 10);

        foreach ($result as $posts) {
            $content = $posts['content']['rendered'];
            $title   = $posts['title']['rendered'];
            echo "<li>Title: ";
            $post = print_r($title);
            echo "<p>Content: </p>";
            $post .= print_r($content);
            echo "</li>";
        }
    }

    public static function getRSSData($feed_url) {
        $content = file_get_contents($feed_url);
        $x = simplexml_load_string($content, null, LIBXML_NOCDATA);

        foreach($x->channel->item as $entry) {
            echo "<li>Title: ";
            $y = print_r((string)$entry->title);
            echo "<p>Content: </p>";
            $y .= print_r((string)$entry->description);
            echo "</li></br>";
        }
    }
}
