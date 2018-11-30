# Assignment 8
## 1 Cookies
We use cookies for storing the preferred language of the client, see [i18n.php](src/util/i18n.php)

## 2 Sessions
We store three things in the session:
- Preferred user language in $_SESSION['lang'], see [i18n.php](src/util/i18n.php)
- The user currently logged in $_SESSION['person'], see [loginState.php](src/loginState.php)
- The shopping cart of the user in $_SESSION['basket'], see [basketState.php](src/basketState.php)

## 3 Authentication
We have following pages related to authentication:
- [login.php](src/login.php)
- [logout.php](src/logout.php)
- [forgotPassword.php](src/forgotPassword.php)
- [resetPassword.php](src/resetPassword.php)
- [loginState.php](src/loginState.php)
- [user.php](src/user.php)