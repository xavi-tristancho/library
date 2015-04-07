## Library

Create projects and add github repositories to remember them.

### Installation

root folder

```
$ npm install
```

```
$ composer install
```

public folder
```
$ bower install
```

Finally you will need to copy the .env.example file and create a .env file with your database connection configuration

### Github Configuration

In order to be able to read the github api you wil need to rename the file config/github.example.php to config.github.php and place the token.
You can generate a github token from your account settings -> applications -> Personal access tokens -> Generate a new token