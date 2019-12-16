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
?>
