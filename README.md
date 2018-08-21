## Back-end Developer Test

### Devcenter Backend Developer Test I

### Laravel Twitter Bot: 

Pulls name and followers count based on filtered hashtag and stores it on google spreadsheet.

### Prerequisites
To run this project, your server must satisfy the following requirements
* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension

## How to install and run the project

### Clone and run composer install
1. From a terminal and within a directory of choice run git clone git url
```
git clone https://github.com/adewaleadeoye/laravel-twitter-bot.git
```
2. cd into laravel-twitter-bot and run composer install
```
laravel-twitter-bot> composer install
```
### Create a Twitter App
Go to https://developer.twitter.com/en/apply/user and setup a twitter app. Once you've created your application, click on the Keys and access tokens tab to retrieve your consumer_key, consumer_secret, access_token and access_token_secret. We will need them later

### Enable Google Drive API and Create new Spreadsheet
#### Enable the Google drive API by following the steps below
![Enable Google Drive API](https://s3.amazonaws.com/com.twilio.prod.twilio-docs/original_images/google-developer-console.gif)
- Go to the Google APIs Console. https://console.developers.google.com/
- Create a new project.
- Click Enable API. Search for and enable the Google Drive API.
- Create credentials for a Web Server to access Application Data.
- Name the service account and grant it a Project Role of Editor. Copy the generated email address somewhere.   it will be needed later
- Download the JSON file.
- Copy the JSON file to the project's root directory
#### Create spreadsheet
- Create a google spreadsheet. Go to https://docs.google.com/spreadsheets
- Rename Spreadsheet
- Click on share and give edit permission to the service account email you copied earlier.

### Set Environment variables
- Open .env file at the root of your project. If it doesn't exist, make a copy of .env.example and rename as .env
- Set up the following variables.
```
TWITTER_CONSUMER_KEY=twitter consumer key
TWITTER_CONSUMER_SECRET=twitter consumer secret
TWITTER_ACCESS_TOKEN=twitter access token
TWITTER_ACCESS_TOKEN_SECRET=twitter access token secret

GOOGLE_APPLICATION_CREDENTIALS=name of downloaded json file 
GOOGLE_SPREADSHEET_FILENAME=name of spreadsheet you created

Ensure QUEUE_DRIVER=sync
```
After completing the setup,
```
Run php artisan twitter:stream from the terminal and type in an hashtag at the prompt
```




