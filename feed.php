<?php

class Feed
{
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
