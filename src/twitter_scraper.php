<?php
    class Tweets {
        public $username;
        public $tweetinfo = array();
        public $tweetcount = 0;
        function __construct($username) {
            try {
                $this->username = $username;
                $url = "https://twitter.com/". $this->username;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                preg_match_all('/data-tweet-stat-count="[0-9]+"/', $result, $matches);
                preg_match_all('/data-tweet-id="[0-9]+"/', $result, $id);
                preg_match_all('/<p.+TweetTextSize.+<\/p>/', $result, $text);
                $tweetinfo = array();
                $comments = "0";
                $retweets = "0";
                $likes = "0";
                $r = 0;
                $idcnt = -1;
                $temp = array();
                for ($i = 0; $i < count($matches[0]); $i++) {
                    $str = str_replace('data-tweet-stat-count="','', $matches[0][$i]); 
                    $str = str_replace('"','', $str);
                    $r++;
                    $comments = "";
                    $retweets = "";
                    $likes = "";
                    if ($r == 1) {
                        $temp[0] = $str;
                    }
                    if ($r == 2) {
                        $temp[1] = $str;
                    }
                    if ($r == 3) {
                        $temp[2] = $str;
                        $idcnt++;
                        $tweetid = str_replace('data-tweet-id="', '', $id[0][$idcnt]);
                        $tweetid = str_replace('"', '', $tweetid);
                        $tweet_text = "";
                        if ($idcnt < count($text[0])) {
                        	$this->tweetcount = $idcnt - 1;
                        	$tweet_text = str_replace('<p class="TweetTextSize TweetTextSize--normal js-tweet-text tweet-text" lang="und" data-aria-label-part="4">', '', $text[0][$idcnt]);
                        	$tweet_text = str_replace('<a', '<br/><a', $tweet_text);
                        }
                        array_push($this->tweetinfo, ["id" => intval($tweetid), "text" => $tweet_text, "comments" => intval($temp[0]), "retweets" => intval($temp[1]), "likes" => intval($temp[2])]);
                        $r = 0;
                    }
                }
                curl_close($ch);
            }
            catch (Exception $e) {
                echo "Error! Unable to Process Request!";
            }
        }
        public function getAll() {
            return $this->tweetinfo;
        }
        public function getFirst() {
            $arr = array();
            $arr = ["id" => $this->tweetinfo[0]["id"], "text" => $this->tweetinfo[0]["text"], "comments" => $this->tweetinfo[0]["comments"], "retweets" => $this->tweetinfo[0]["retweets"], "likes" => $this->tweetinfo[0]["likes"]];
            return $arr;
        }
        public function getLast() {
            $arr = array();
            $arr = ["id" => $this->tweetinfo[$this->tweetcount]["id"], "text" => $this->tweetinfo[$this->tweetcount]["text"], "comments" => $this->tweetinfo[$this->tweetcount]["comments"], "retweets" => $this->tweetinfo[$this->tweetcount]["retweets"], "likes" => $this->tweetinfo[$this->tweetcount]["likes"]];
            return $arr;
        }
    }
    class Profile {
        public $username;
        public $followers;
        public $photo;
        public $name;
        public $following;
        public $likes;
        function __construct($username) {
            try {
                $this->username = $username;
                $url = "https://twitter.com/". $this->username;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                preg_match_all('/\<span class="ProfileNav-value".+\>/', $result, $matches);
                $info = array();
                foreach ($matches[0] as $elem) {
                    $match = str_replace('<span class="ProfileNav-value" data-count="','', $elem);
                    $match = str_replace('" data-is-compact="false">', '', $match);
                    array_push($info, strip_tags($match));
                }
                $cnt = 0;
                $counter = 0;
                foreach ($info as $i) {
                    $cnt++;
                    $counter++;
                    if ($counter == 2) {
                        $this->following = str_replace(',', '', $i);
                    }
                    if ($counter == 3) {
                        $this->followers = str_replace(',', '', $i);
                    }
                    if ($counter == 4) {
                        $this->likes = str_replace(',', '', $i);
                    }
                }
                preg_match_all('/"https:\/\/pbs\.twimg\.com\/profile_images\/.+"/', $result, $profile);
                $photo = preg_replace('/"/','',$profile[0][0]);
                $this->photo = $photo;
                preg_match_all('/ProfileHeaderCard-nameLink.+\>.+\<\/a\>/', $result, $user);
                $userinfo = strip_tags($user[0][0]);
                $userinfo = str_replace('Verified account', '', $userinfo);
                $userinfo = str_replace('ProfileHeaderCard-nameLink u-textInheritColor js-nav">', '', $userinfo);
                $this->name = $userinfo;
                curl_close($ch);
            }
            catch (Exception $e) {
                echo "Error! Unable to Process Request!";
            }
        }
        public function getFollowing() {
            return strval($this->following);
        }
        public function getFollowers() {
            return strval($this->followers);
        }
        public function getLikes() {
            return strval($this->likes);
        }
        public function getPhoto() {
            return strval($this->photo);
        }
        public function getName() {
            return strval($this->name);
        }
        public function getUsername() {
            return strval($this->username);
        }
    }
    class UITweets {
    	public $profile;
    	public $tweets;
    	function __construct($username) {
    		$this->profile = new Profile($username);
    		$this->tweets = new Tweets($username);
    	}
    	function getAll() {
    		foreach ($this->tweets->getAll() as $item) { ?>
    			<blockquote class="twitter-tweet"><?php echo $item["text"]; ?>&mdash; <?php echo $this->profile->getName(); ?> (@<?php echo $this->profile->getUsername(); ?>) <a href="https://twitter.com/<?php echo $this->profile->getUsername(); ?>/status/<?php echo $item["id"]; ?>?ref_src=twsrc%5Etfw"></a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			<?php
    		}
    	}
    	function getFirst() { ?>
    		<blockquote class="twitter-tweet"><?php echo $this->tweets->getFirst()["text"]; ?>&mdash; <?php echo $this->profile->getName(); ?> (@<?php echo $this->profile->getUsername(); ?>) <a href="https://twitter.com/<?php echo $this->profile->getUsername(); ?>/status/<?php echo $this->tweets->getFirst()["id"]; ?>?ref_src=twsrc%5Etfw"></a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    	<?php
    	}
    	function getLast() { ?>
    		<blockquote class="twitter-tweet"><?php echo $this->tweets->getLast()["text"]; ?>&mdash; <?php echo $this->profile->getName(); ?> (@<?php echo $this->profile->getUsername(); ?>) <a href="https://twitter.com/<?php echo $this->profile->getUsername(); ?>/status/<?php echo $this->tweets->getLast()["id"]; ?>?ref_src=twsrc%5Etfw"></a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
		<?php
    	}
    }
    class UIProfile {
    	public $profile;
    	public $likes;
    	public $name;
    	public $username;
    	public $followers;
    	public $following;
    	public $photo;
    	function __construct($username) {
    		$this->profile = new Profile($username);
    		$this->name = $profile->getName();
    		$this->username = $profile->getUsername();
    		$this->likes = $profile->getLikes();
    		$this->followers = $profile->getFollowers();
    		$this->photo = $profile->getPhoto();
    		$this->following = $profile->getFollowing();
    	}
    	public function render() { ?>
			
	<?php
    	}
    }
?>
