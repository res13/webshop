<?php

class LoginController extends Controller
{
    public function __construct()
    {
        $loginView = new LoginView();
        parent::__construct($loginView, "LOGIN");
    }

    public function getContent()
    {
        $errorMessage = null;
        if (isset($_POST['usernameOrEmail']) && isset($_POST['password'])) {
            $usernameOrEmail = UtilityController::validateInput($_POST['usernameOrEmail']);
            $password = UtilityController::validateInput($_POST['password']);
            $person = UserController::authenticate($usernameOrEmail, $password);
            if ($person != null) {
                if ($person->resetpassword > 0) {
                    UtilityController::redirect('index.php?site=resetPassword');
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
                        BasketController::addToBasketOrIncrease($personId, $productId, $productQuantity, $optionArray);
                        $_SESSION['basket'] = BasketController::getBasket($personId);
                    }
                }
            } else {
                $errorMessage = $this->languageController->getTextForLanguage("WRONG_USERNAME_EMAIL_PASSWORD");
            }
        }
        if (isset($_SESSION['person'])) {
            UtilityController::redirect("index.php?site=productList");
        }
        $result = $this->navigationController->getContent();
        $result .= $this->view->render($this->languageController, $errorMessage);
        return $result;
    }

}