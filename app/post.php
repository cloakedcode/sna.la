<?php

class Post extends AN_Model
{
        static $posts = array();
        private static $tags = array();

	static function posts()
	{
		$posts = array();

		if (is_dir('./posts'))
		{
			foreach (glob('posts/*.html') as $p)
			{
				$posts[] = self::_post(basename($p));
			}
		}

		return array_reverse($posts);
	}

	static function postWithId($id)
	{
		if (is_dir('./posts') && file_exists("./posts/{$id}.html"))
		{
			return self::_post($id.'.html');
		}

		return null;
	}
        
        static function tags()
        {
            $path = './cache/post_tags';
            if (empty(self::$tags) && file_exists($path))
            {
                self::$tags = unserialize(file_get_contents($path));
            }

            if (empty(self::$tags['posts']))
            {
                self::$tags['posts'] = array();
            }
            $files = glob('./posts/*.html');
            if (count(self::$tags['posts']) < count($files))
            {
                foreach ($files as $f)
                {
                    $f = basename($f);
                    if (in_array($f, self::$tags['posts']) === FALSE)
                    {
                        $post = self::_post($f);
                        if (empty($post->tags) === FALSE)
                        {
                            foreach ($post->tags as $t)
                            {
                                self::$tags['post_tags'][$t][] = $post->id;
                            }
                        }
                        self::$tags['posts'][] = $f;
                    }
                }
                file_put_contents($path, serialize(self::$tags));
            }

            return self::$tags['post_tags'];
        }

        static function postsWithTag($tag)
        {
            $posts = array();

            $tags = self::tags();
            if (isset($tags[$tag]))
            {
                foreach ($tags[$tag] as $p)
                {
                    $posts[] = self::_post($p);
                }
            }

            return array_reverse($posts);
        }

	static function _post($filename)
	{
		$matches = array();
		if (preg_match('/([0-9]{4}-[0-9]{2}-[0-9]{2})-([A-Z|a-z|0-9|\-]*?)\.html$/', $filename, $matches))
		{
                        $file_contents = explode("\n\n", file_get_contents("./posts/{$filename}"), 2);
                        $data = array(
                                        'id' => $matches[1].'-'.$matches[2].'.html',
                                        'date' => strtotime($matches[1]),
                                        'body' => $file_contents[1],
                                    );

                        $tags = explode("\n", $file_contents[0]);

                        foreach ($tags as $key => $value)
                        {
                                 $split = preg_split('/: ?/', $value, 2);

                                 if ($split[0] == 'tags')
                                 {
                                    $split[1] = preg_split('/, ?/', $split[1]);
                                 }

                                 $data[$split[0]] = $split[1];
                        }

			return new self($data);
		}

		return null;
	}

	function body()
	{
		include_once('markdown/markdown.php');

		return Markdown($this->body);
	}

	function date()
	{
		return date('F j, Y', $this->date);
	}

        function url()
        {
            return '/'.preg_replace('/-/', '/', $this->id, 3);
        }

        function previousPost()
        {
            if (isset($this->prev) == FALSE)
            {
                $posts = $this->_loadPosts();
                $index = array_search($this->id, $posts) - 1;
                
                $this->prev = ($index >= 0 && $index < count($posts)) ? self::_post($posts[$index], FALSE) : FALSE;
            }

            return $this->prev;
        }

        function nextPost()
        {
            if (isset($this->next) == FALSE)
            {
                $posts = $this->_loadPosts();
                $index = array_search($this->id, $posts) + 1;
                
                $this->next = ($index < count($posts)) ? self::_post($posts[$index], FALSE) : FALSE;
            }

            return $this->next;
        }

        private function _loadPosts()
        {
            if (empty(self::$posts))
            {
                foreach (glob('posts/*.html') as $p)
                {
                    self::$posts[] = basename($p);
                }
            }

            return self::$posts;
        }
}

?>
