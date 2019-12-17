# PHP-Twitter-Scraper
Use this tool to fetch the Twitter Front-end. You can get Tweet and Profile Details without the Twitter API simply. It was created out of frustration 😒😒 because we had looked for a lot of means to use a twitter scraper with no avail finding a very good one. Now, this particular API is good enough to get the job done.

## Limitations/Shortcomings 😢
For now, the API is limited to the most recent thirteen (13) tweets made by the given user account.

## Usage
To use this API, just include the twitter_scraper.php file into your script and call necessary Classes and Methods. Check examples too for further knowledge of usage.

The API can get the profile of a user. The details include;
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
  $tweets = new UITweets("V_Z_Okhormhe");
  $tweets->getFirst();
  $tweets->getLast();
  $tweets->getAll();
?>
```
The methods above are self-explanatory. Remember that for getAll, it returns all the possible tweets (13).

###### Search
The search class is used to fetch the most recent/trending 14 search results and display the results on the user's page. It accepts two arguments only. Search(string, category). **NOTE:** Photos not inclusive. To use this class, simply implement the following;
```php
<?php
  $search = new Search('Edinyanga Ottoho', 'tweets');
  \\OR
  $search = new Search('Edinyanga Ottoho', 'videos');
  #Returns the tweets results matching Edinyanga Ottoho.
?>
```
###### Trends
The trends class is used to fetch a maximum of ten (10) trends from a particular location. It uses one parameter which is the location (must be countries) to get trends from. **SOME** locations are restricted! Sorry if they do not yield good results or throw errors. Usage pattern;
```php
  $trends = new Trends('Nigeria');
```
It has three methods that **MUST** be called;
```php
   getAll(); //First All (An array)
   getFirst(); //Fetch the First trend from the provided location
   getLast(); //Fetches the Last (10th or less) trend from the given location
```
The following is a list of supported locations;
- Algeria
- Argentina
- Australia
- Austria
- Bahrain
- Belarus
- Belgium
- Brazil
- Canada
- Chile
- Colombia
- Denmark
- Dominican Republic
- Ecuador
- Egypt
- France
- Germany
- Ghana
- Greece
- Guatemala
- India
- Indonesia
- Ireland
- Israel
- Italy
- Japan
- Jordan
- Kenya
- Korea
- Kuwait
- Latvia
- Lebanon
- Malaysia
- Mexico
- Netherlands
- New Zealand
- Nigeria
- Norway
- Oman
- Pakistan
- Panama
- Peru
- Philippines
- Poland
- Portugal
- Puerto Rico
- Qatar
- Russia
- Saudi Arabia
- Singapore
- South Africa
- Spain
- Sweden
- Switzerland
- Thailand
- Turkey
- Ukraine
- United Arab Emirates
- United Kingdom
- United States
- Venezuela
- Vietnam

# Contributors
## Edinyanga Ottoho
Edinyanga Ottoho is a Full-Stack software developer with over 3 years of experience. Stacks are HTML, CSS, Core PHP, Python/Django, EcmaScript 4/6, React Native/NodeJS. A huge reason why the API is alive.
You can view my profile via this link (https://www.github.com/EdinyangaOttoho)

<img src="https://avatars3.githubusercontent.com/u/45470783?s=460&v=4" style="width:300px;height:330px">

## Victory Okhormhe
Victory Okhormhe is a Front-End developer with over 2 years of experience. Stacks are HTML, CSS, BootStrap, Semantic UI, ES4, Elm, Python (Data Science ). Profile is accessible via: (https://www.github.com/victoryokhormhe).

<img src="https://avatars0.githubusercontent.com/u/41402418?s=460&v=4" style="width:300px;height:330px">

# Requirements
The following are required/recommended for effective functioning of this API. Else, some errors may come along;
- CURL PHP Extension Installed and Enabled.
- PHP Version >= 7.2.0
- A Poor server/internet Connectivity is a con

# Issues/Fixes
Contact us via +2348117093601 or +2348078920574 On WhatsApp or create an issue
