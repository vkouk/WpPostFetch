<?php

class Feed
{
    public static function getDataAsJSON($feed_url) {
        $content   = file_get_contents($feed_url);
        $result    = json_decode($content, true);
        $result    = array_slice($result, 0 , 10);

        foreach ($result as $post) {
            $date = date('Y/m/d', strtotime($post['date']));
            $posts = implode(' ', array_slice(explode(' ', $post['content']['rendered']), 0, 50));

            echo "{<br><br>";
            echo 'Date: '. $date .'<br>
        <br><a href=' . json_encode($post['link'], JSON_UNESCAPED_SLASHES) .'> '. json_encode($post['title']['rendered'], JSON_PRETTY_PRINT) .'</a>
               <br>Content:' . $posts .'';
            echo "}<br><br>";
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
