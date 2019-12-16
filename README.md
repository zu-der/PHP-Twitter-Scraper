# PHP-Twitter-Scraper
Use this tool to fetch the Twitter Front-end. You can get Tweet and Profile Details without the Twitter API simply. It was created out of frustration 😒😒 because we had looked for a lot of means to use a twitter scraper with no avail finding a very good one. Now, this particular API is good enough to get the job done.

## Limitations/Shortcomings 😢
For now, the API is limited to the most recent thirteen (13) tweets made by the given user account.

## Usage
To use this API, just include the twitter_scraper.php file into your script and call necessary Classes and Methods. The API can get the profile of a user. The details include.

- Profile Photo
- Name
- Username
- Followers
- Following
- Likes

It also can get the details of tweets, such as;
- Likes
- Comments
- Text
- Retweets

Simply, include the Script into your own project by;
```php
<?php
include('twitter_scraper.php');
?>
```
## Samples
###### Profile (Code only)
```php
<?php
  $profile = new Profile("EOttoho");
  $profile->getFollowers();
  $profile->getName();
  $profile->getLikes();
  #Above code is self-explanatory enough
?>
```
###### Profile (UI)
```php
<?php
  $profile = new UIProfile("EOttoho");
  $profile->render();
?>
```

###### Tweets (Code Only)
To use the code only, the following can be done;
```php
<?php
  $tweets = new Tweets("V_Z_Okhormhe");
  $tweets->getFirst();
  $tweets->getLast();
  $tweets->getAll();
  #For the getFirst() and getLast() Methods, you could make use of the keys to reference as follows;
  
  $tweets["id"];
  $tweets["text"];
  
  #Whereas, for getAll() Method, a multi-dimensional array is returned in which you could iterate through the array and get the keys as below;
  foreach ($tweets as $tweet) {
    echo $tweet["id"]; //Returns ID
    echo $tweet["text"]; //Returns Text
  }
?>
```
###### Tweets (UI)
To use the UI, you can implement the following;
```php
<?php
  $tweets = new UITweets("");
  $tweets->getFirst();
  $tweets->getLast();
  $tweets->getAll();
?>
```
The methods above are self-explanatory. Remember that for getAll, it returns all the possible tweets (13).

# Contributors
## Edinyanga Ottoho
Edinyanga Ottoho is a Full-Stack software developer with over 3 years of experience. Stacks are HTML, CSS, Core PHP, Python/Django, EcmaScript 4/6, React Native/NodeJS A huge reason why the API is alive.
You can view my profile via this link (https://www.github.com/EdinyangaOttoho)

<img src="https://avatars3.githubusercontent.com/u/45470783?s=460&v=4" style="width:300px;height:330px">

## Victory Okhormhe
Victory Okhormhe is a Front-End developer with over 2 years of experience. Stacks are HTML, CSS, BootStrap, Semantic UI, Python/Data Science. Profile is accessible via: (https://www.github.com/victoryokhormhe).

<img src="https://avatars0.githubusercontent.com/u/41402418?s=460&v=4" style="width:300px;height:330px">
