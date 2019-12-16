# PHP-Twitter-Scraper
Use this tool to fetch the Twitter Front-end. You can get Tweet and Profile Details without the Twitter API simply. It was created out of frustration because we had looked for a lot of means to use a twitter scraper with no avail finding a very good one. Now, this particular API is good enough to get the job done.

## Limitations/Shortcomings
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
```
indlude('twitter_scraper.php');

```
