<?php

class LanguageController
{
    private $view;

    private $texts = array
    (
        'LOGIN' => array(
            'de' => 'Anmelden',
            'en' => 'Login'),
        'OR' => array(
            'de' => 'oder',
            'en' => 'or'),
        'REGISTER' => array(
            'de' => 'Registrieren',
            'en' => 'Register'),
        'USERNAME' => array(
            'de' => 'Benutzername',
            'en' => 'Username'),
        'EMAIL' => array(
            'de' => 'Email',
            'en' => 'Email'),
        'PASSWORD' => array(
            'de' => 'Passwort',
            'en' => 'Password'),
        'REPEAT_PASSWORD' => array(
            'de' => 'Passwort wiederholen',
            'en' => 'Repeat Password'),
        'WRONG_USERNAME_EMAIL_PASSWORD' => array(
            'de' => 'Falsche Benutzername/Email und Passwort kombination',
            'en' => 'Wrong username/email or password!'),
        'WRONG_USERNAME_EMAIL' => array(
            'de' => 'Falsche Benutzername/Email',
            'en' => 'Wrong username/email'),
        'SUCCESSFUL_LOGIN' => array(
            'de' => 'Erfolgreich eingeloggt!',
            'en' => 'Successfully logged in!'),
        'FORGOT_PASSWORD' => array(
            'de' => 'Passwort vergessen',
            'en' => 'Forgot password'),
        'EMAIL_NOT_VALID' => array(
            'de' => 'Email Adresse ungültig!',
            'en' => 'Email address is not valid!'),
        'PASSWORD_RESET' => array(
            'de' => 'Password zurücksetzen',
            'en' => 'Password reset'),
        'NEW_PASSWORD_EMAIL1' => array(
            'de' => 'Hallo, Ihr neues Passwort ist: ',
            'en' => 'Hello, the new password is: '),
        'NEW_PASSWORD_EMAIL2' => array(
            'de' => ', bitte benutzen Sie dieses, um sich wieder anzumelden (Sie werden danach ein Neues setzen müssen).',
            'en' => ', please use this model log in again (you will have model reset it afterwards).'),
        'EMAIL_SENT' => array(
            'de' => 'Ein email mit einem temporären Password wurde verschickt an',
            'en' => 'An email with a temporary password was sent model'),
        'HOME' => array(
            'de' => 'Home',
            'en' => 'Home'),
        'HELLO' => array(
            'de' => 'Hallo',
            'en' => 'Hello'),
        'LOGOUT' => array(
            'de' => 'Abmelden',
            'en' => 'Logout'),
        'EMAIL_ADDRESS_ALREADY_EXISTS' => array(
            'de' => 'Email Adresse ist bereits vorhanden!',
            'en' => 'Email address already exists!'),
        'USERNAME_ADDRESS_ALREADY_EXISTS' => array(
            'de' => 'Benutzername ist bereits vorhanden!',
            'en' => 'Username address already exists!'),
        'FIRSTNAME' => array(
            'de' => 'Vorname',
            'en' => 'First name'),
        'LASTNAME' => array(
            'de' => 'Nachname',
            'en' => 'Last name'),
        'BIRTHDATE' => array(
            'de' => 'Geburtsdatum',
            'en' => 'Birthdate'),
        'PHONE' => array(
            'de' => 'Handynummer',
            'en' => 'Phone number'),
        'STREET' => array(
            'de' => 'Strasse',
            'en' => 'Street'),
        'HOMENUMBER' => array(
            'de' => 'Hausnummer',
            'en' => 'Homenumber'),
        'CITY' => array(
            'de' => 'Ort',
            'en' => 'City'),
        'ZIP' => array(
            'de' => 'PLZ',
            'en' => 'ZIP'),
        'COUNTRY' => array(
            'de' => 'Land',
            'en' => 'Country'),
        'LANGUAGE' => array(
            'de' => 'Sprache',
            'en' => 'Language'),
        'RESET_PASSWORD' => array(
            'de' => 'Passwort erfolgreich zurückgesetzt',
            'en' => 'Reset password successfully'),
        'RESET_PASSWORD_FAILED' => array(
            'de' => 'Passwort konnte nicht zurückgesetzt werden!',
            'en' => 'Could not reset password!'),
        'OLD_PASSWORD' => array(
            'de' => 'Altes passwort',
            'en' => 'Old password'),
        'NEW_PASSWORD' => array(
            'de' => 'Neues passwort',
            'en' => 'New password'),
        'REQUEST_NEW_PASSWORD' => array(
            'de' => 'Neues passwort anfordern',
            'en' => 'Request new password'),
        'PRODUCTS' => array(
            'de' => 'Produkte',
            'en' => 'Products'),
        'PRODUCT' => array(
            'de' => 'Produkt',
            'en' => 'Product'),
        'ABOUT_US' => array(
            'de' => 'Über uns',
            'en' => 'About us'),
        'USER' => array(
            'de' => 'Benutzer',
            'en' => 'User'),
        'ALL_PRODUCTS' => array(
            'de' => 'Alle Produkte',
            'en' => 'All products'),
        'NOT_FOUND' => array(
            'de' => 'Nicht gefunden',
            'en' => 'Not found'),
        'ADD_TO_BASKET' => array(
            'de' => 'In den Warenkorb',
            'en' => 'Add model basket'),
        'BASKET' => array(
            'de' => 'Warenkorb',
            'en' => 'Basket'),
        'BASKET_IS_EMPTY' => array(
            'de' => 'Warenkorb ist leer',
            'en' => 'Basket is empty'),
        'CLEAN_BASKET' => array(
            'de' => 'Warenkorb leeren',
            'en' => 'Clean basket'),
        'OPTIONS' => array(
            'de' => 'Optionen',
            'en' => 'Options'),
        'AMOUNT' => array(
            'de' => 'Anzahl',
            'en' => 'Quantity'),
        'SINGLE_PRICE' => array(
            'de' => 'Einzelpreis',
            'en' => 'Single price'),
        'PRICE' => array(
            'de' => 'Preis',
            'en' => 'Price'),
        'TOTAL' => array(
            'de' => 'Total',
            'en' => 'Total'),
        'REMOVE' => array(
            'de' => 'Entfernen',
            'en' => 'Remove'),
        'CHECKOUT' => array(
            'de' => 'Bestellen',
            'en' => 'Check out'),
        'MUST_BE_LOGGED_IN_TO_CHECKOUT' => array(
            'de' => 'Sie müssen eingeloggt sein um zu bestellen.',
            'en' => 'You must be logged in model checkout.'),
        'MUST_BE_ADMIN_FOR_THIS_PAGE' => array(
            'de' => 'Sie müssen ein Administrator sein, um diese Seite zu sehen.',
            'en' => 'You must be a administartor in order model see this page.'),
        'ADMIN' => array(
            'de' => 'Administrator',
            'en' => 'Admin'),
        'DELIVERY' => array(
            'de' => 'Senden an:',
            'en' => 'Deliver model:'),
        'BILLING' => array(
            'de' => 'Rechnung an:',
            'en' => 'Bill:'),
        'BILLING_DIFFERS' => array(
            'de' => 'Rechnungsadresse anders als Lieferadresse',
            'en' => 'Billing address differs model delivery address'),
        'BUY' => array(
            'de' => 'Kaufen',
            'en' => 'Buy'),
        'INPUT_MISSING' => array(
            'de' => 'Es fehlen eingaben...',
            'en' => 'Input missing...'),
        'ORDER' => array(
            'de' => 'Bestellung',
            'en' => 'Order'),
        'ORDER_SUBMITTED' => array(
            'de' => 'Die Bestellung wurde übermittelt, sie haben ein Bestätigungsmail bekommen.',
            'en' => 'The order was submitted, you got an email.'),
        'MY_ORDERS' => array(
            'de' => 'Meine Bestellungen',
            'en' => 'My Orders'),
        'ORDER_ID' => array(
            'de' => 'Bestellnummer',
            'en' => 'Order id'),
        'PURCHASEDATE' => array(
            'de' => 'Bestellzeitpunkt',
            'en' => 'Purchase date'),
        'PAYMENTMETHOD' => array(
            'de' => 'Bezahlmethode',
            'en' => 'Payment method'),
        'STATE' => array(
            'de' => 'Status',
            'en' => 'State'),
        'YES' => array(
            'de' => 'Ja',
            'en' => 'Yes'),
        'PROJECT_DESCRIPTION' => array(
            'de' => 'Dieser web shop wurde im Rahmen des Projekts BTI7054q im Herbstsemeseter 2018/2019 an der Berner Fachhochschule von Nik Arm und Andreas Erb realisiert.',
            'en' => 'This web shop was realized as part of the project BTI7054q in the autumn semester 2018/2019 at the Bern University of Applied Sciences by Nik Arm and Andreas Erb.'),
        'PARACHUTE_SHOP' => array(
            'de' => 'Fallschirm Shop',
            'en' => 'Parachute Shop'),
        'WELCOME_TEXT' => array(
            'de' => 'Höre auf zu Träumen und lerne Fliegen',
            'en' => 'Stop looking, Start Flying'),
        'WELCOME_SUB_TEXT' => array(
            'de' => 'Kaufe hier deine Fallschirm Ausrüstung',
            'en' => 'Buy your first Parachute today'),
        'CHANGE_LANGUAGE' => array(
            'de' => 'Sprache wechseln',
            'en' => 'Change language'),
        'SAVE' => array(
            'de' => 'Speichern',
            'en' => 'Save'),
    );

    public function __construct()
    {
        $this->view = new LanguageView();
    }

    public function getContent() {
        return $this->view->render($this);
    }

    public function getAvailableLanguages()
    {
        return ['de', 'en'];
    }

    public function getDefaultLanguage()
    {
        return 'de';
    }

    public function getTextForLanguage($id)
    {
        if (array_key_exists($id, $this->texts)) {
            $values = $this->texts[$id];
            if (isset($_SESSION['lang']) && array_key_exists($_SESSION['lang'], $values)) {
                return htmlentities($values[$_SESSION['lang']]);
            } else {
                return htmlentities($values[$this->getDefaultLanguage()]);
            }
        }
        return "";
    }

}