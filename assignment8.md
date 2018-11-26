# Assignment 8
## 1 Cookies
We use cookies for storing the preferred language of the client, see [i18n.php](web/util/i18n.php)

## 2 Sessions
We store three things in the session:
- Preferred user language in $_SESSION['lang'], see [i18n.php](web/util/i18n.php)
- The user currently logged in $_SESSION['person'], see [loginState.php](web/loginState.php)
- The shopping cart of the user in $_SESSION['basket'], see [basketState.php](web/basketState.php)

## 3 Authentication
We have following pages related to authentication:
- [login.php](web/login.php)
- [logout.php](web/logout.php)
- [forgotPassword.php](web/forgotPassword.php)
- [resetPassword.php](web/resetPassword.php)
- [loginState.php](web/loginState.php)
- [user.php](web/user.php)