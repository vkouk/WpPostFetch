<?php

class Feed
{
    public static function getRawData($feed_url) {
        $content   = file_get_contents($feed_url);
        $result    = json_decode($content, true);
        //title, url, image, content(100 words)

        foreach ($result as $posts) {
            echo "<li>";
            echo "<pre>";
            echo 'Date: '. json_encode($posts['date']) .' 
 <a href=' . json_encode($posts['link'], JSON_UNESCAPED_SLASHES) .'> '. json_encode($posts['title'], JSON_PRETTY_PRINT) .'</a>';
            echo "</li>";
        }
    }

    public static function getPosts($feed_url) {
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

    public static function getRSSFeed($feed_url) {

        $content = file_get_contents($feed_url);
        $x = simplexml_load_string($content, null, LIBXML_NOCDATA);
        $y = '';

        foreach($x->channel->item as $entry) {

            echo "<li>Title: ";
            $y = print_r((string)$entry->title);
            echo "<p>Content: </p>";
            $y .= print_r((string)$entry->description);
            echo "</li></br>";
        }
    }
}
