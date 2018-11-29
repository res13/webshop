<?php

class CheckoutController extends Controller
{
    public function __construct()
    {
        $checkoutView = new CheckoutView();
        parent::__construct($checkoutView, "CHECKOUT");
    }

    public function getContent()
    {
        if (
            isset($_POST['deliveryFirstname'])
            && isset($_POST['deliveryLastname'])
            && isset($_POST['deliveryStreet'])
            && isset($_POST['deliveryHomenumber'])
            && isset($_POST['deliveryCity'])
            && isset($_POST['deliveryZip'])
            && isset($_POST['deliveryCountry'])) {
            $basketId = $_SESSION['basket']->id;
            $deliveryFirstname = UtilityController::validateInput($_POST['deliveryFirstname']);
            $deliveryLastname = UtilityController::validateInput($_POST['deliveryLastname']);
            $deliveryStreet = UtilityController::validateInput($_POST['deliveryStreet']);
            $deliveryHomenumber = UtilityController::validateInput($_POST['deliveryHomenumber']);
            $deliveryCity = UtilityController::validateInput($_POST['deliveryCity']);
            $deliveryZip = UtilityController::validateInput($_POST['deliveryZip']);
            $deliveryCountry = UtilityController::validateInput($_POST['deliveryCountry']);
            if (isset($_POST['billingDiffersCB'])) {
                $billingDiffersCB = UtilityController::validateInput($_POST['billingDiffersCB']);
                if ($billingDiffersCB === 'billingDiffers') {
                    if (
                        isset($_POST['billingFirstname'])
                        && isset($_POST['billingLastname'])
                        && isset($_POST['billingStreet'])
                        && isset($_POST['billingHomenumber'])
                        && isset($_POST['billingCity'])
                        && isset($_POST['billingZip'])
                        && isset($_POST['billingCountry'])
                    ) {
                        $billingFirstname = UtilityController::validateInput($_POST['billingFirstname']);
                        $billingLastname = UtilityController::validateInput($_POST['billingLastname']);
                        $billingStreet = UtilityController::validateInput($_POST['billingStreet']);
                        $billingHomenumber = UtilityController::validateInput($_POST['billingHomenumber']);
                        $billingCity = UtilityController::validateInput($_POST['billingCity']);
                        $billingZip = UtilityController::validateInput($_POST['billingZip']);
                        $billingCountry = UtilityController::validateInput($_POST['billingCountry']);
                        Order::orderBasketBillingDiffers($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry, $billingFirstname, $billingLastname, $billingStreet, $billingHomenumber, $billingCity, $billingZip, $billingCountry);
                    } else {
                        UtilityController::alert($this->languageController->getTextForLanguage("INPUT_MISSING"));
                    }
                }
            } else {
                Order::orderBasket($basketId, $deliveryFirstname, $deliveryLastname, $deliveryStreet, $deliveryHomenumber, $deliveryCity, $deliveryZip, $deliveryCountry);
            }
            $subject = $this->languageController->$this->languageController->getTextForLanguage("ORDER") . " - " . $basketId;
            $message = "<html><body>
    <h2>" . $this->languageController->getTextForLanguage("DELIVERY") . "</h2>
    <p>" . $this->languageController->getTextForLanguage("ORDER_ID") . "=" . $basketId . "</p>
    <p>" . $this->languageController->getTextForLanguage("FIRSTNAME") . "=" . $deliveryFirstname . "</p>
    <p>" . $this->languageController->getTextForLanguage("LASTNAME") . "=" . $deliveryLastname . "</p>
    <p>" . $this->languageController->getTextForLanguage("STREET") . "=" . $deliveryStreet . "</p>
    <p>" . $this->languageController->getTextForLanguage("HOMENUMBER") . "=" . $deliveryHomenumber . "</p>
    <p>" . $this->languageController->getTextForLanguage("CITY") . "=" . $deliveryCity . "</p>
    <p>" . $this->languageController->getTextForLanguage("ZIP") . "=" . $deliveryZip . "</p>
    <p>" . $this->languageController->getTextForLanguage("COUNTRY") . "=" . $deliveryCountry . "</p>";
            if (isset($_POST['billingDiffersCB']) && UtilityController::validateInput($_POST['billingDiffersCB']) === 'billingDiffers') {
                $message .= "<h2>" . $this->languageController->getTextForLanguage("BILLING") . "</h2>
    <p>" . $this->languageController->getTextForLanguage("BILLING_DIFFERS") . "=" . $this->languageController->getTextForLanguage("YES") . "</p>
    <p>" . $this->languageController->getTextForLanguage("FIRSTNAME") . "=" . $billingFirstname . "</p>
    <p>" . $this->languageController->getTextForLanguage("LASTNAME") . "=" . $billingLastname . "</p>
    <p>" . $this->languageController->getTextForLanguage("STREET") . "=" . $billingStreet . "</p>
    <p>" . $this->languageController->getTextForLanguage("HOMENUMBER") . "=" . $billingHomenumber . "</p>
    <p>" . $this->languageController->getTextForLanguage("CITY") . "=" . $billingCity . "</p>
    <p>" . $this->languageController->getTextForLanguage("ZIP") . "=" . $billingZip . "</p>
    <p>" . $this->languageController->getTextForLanguage("COUNTRY") . "=" . $billingCountry . "</p>";
            }
            $message .= "</body></html>";
            $mailSent = UtilityController::sendMail($_SESSION['person']->email, $subject, $message) && UtilityController::sendMail(null, $subject, $message);
            unset($_SESSION['basket']);
        }
        $result = $this->navigationController->getContent();
        if (isset($mailSent) && $mailSent == true) {
            $result .= $this->view->renderOrderSubmitted($this->languageController);
        } else {
            if (isset($_SESSION['person'])) {
                $result .= $this->view->render($this->languageController);
            }
            else {
                $result .= $this->view->renderMustLogin($this->languageController);
            }
        }
        return $result;
    }
}