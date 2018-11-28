<?php

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct(new LoginView(), "LOGIN");
    }

    public function performHead() {
        if (isset($_POST['usernameOrEmail']) && isset($_POST['password'])) {
            $usernameOrEmail = UtilityController::validateInput($_POST['usernameOrEmail']);
            $password = UtilityController::validateInput($_POST['password']);
            $person = Person::authenticate($usernameOrEmail, $password);
            if ($person != null) {
                if ($person->__get('resetpassword') > 0) {
                    UtilityController::redirect('resetPassword.php');
                }
                $_SESSION['person'] = $person;
                if (isset($_SESSION['basket'])) {
                    $personId = $_SESSION['person']->__get('id');
                    $basketProducts = $_SESSION['basket']->__get('products');
                    foreach ($basketProducts as $basketProduct) {
                        $productId = $basketProduct->realProductId;
                        $productQuantity = $basketProduct->quantity;
                        $productOptions = $basketProduct->options;
                        $optionArray = array();
                        foreach ($productOptions as $productOption) {
                            $optionValueId = $productOption->optionValueId;
                            array_push($optionArray, $optionValueId);
                        }
                        Basket::addToBasketOrIncrease($personId, $productId, $productQuantity, $optionArray);
                        $_SESSION['basket'] = Basket::getBasket($personId);
                    }
                }
            } else {
                UtilityController::alert(getTextForLanguage("WRONG_USERNAME_EMAIL_PASSWORD"));
            }
        }
    }
}