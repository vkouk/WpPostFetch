<?php

class Feed
{
    public static function getRawData($feed_url) {
        $content   = file_get_contents($feed_url);
        $result    = json_decode($content, true);
        $result    = array_slice($result, 0 , 10);

        if (!empty($result)) {
            foreach ($result as $posts) {
                $date = date('Y/m/d', strtotime($posts['date']));
                $post = implode(' ', array_slice(explode(' ', $posts['content']['rendered']), 0, 50));

                echo "<li>";
                echo "<pre>";
                echo '<h3>Date: '. $date .'</h3>
        <p><a href=' . json_encode($posts['link'], JSON_UNESCAPED_SLASHES) .'> '. json_encode($posts['title'], JSON_PRETTY_PRINT) .'</a></p>
               <h3>Content:</h3>' . $post .'';
                echo "</li>";
            }
        } else {
            echo "<li>No posts found.</li>";
        }
    }

    public static function getPosts($feed_url) {
        $content = file_get_contents($feed_url);
        $result  = json_decode($content, true);

        if (!empty($result)) {
            foreach ($result as $posts) {
                $content = $posts['content']['rendered'];
                $title   = $posts['title']['rendered'];
                echo "<li>Title: ";
                $post = print_r($title);
                echo "<p>Content: </p>";
                $post .= print_r($content);
                echo "</li>";
            }
        } else {
            echo "<li>No posts found.</li>";
        }
    }

    public static function getRSSFeed($feed_url) {
        $content = file_get_contents($feed_url);
        $x = simplexml_load_string($content, null, LIBXML_NOCDATA);

        if (!empty(x)) {
            foreach($x->channel->item as $entry) {
                echo "<li>Title: ";
                $y = print_r((string)$entry->title);
                echo "<p>Content: </p>";
                $y .= print_r((string)$entry->description);
                echo "</li></br>";
            }
        } else {
            echo "<li>No posts found.</li>";
        }
    }
}
