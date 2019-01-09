<?php

class AdminController extends Controller
{
    public function __construct()
    {
        $adminView = new AdminView();
        parent::__construct($adminView, "ADMIN");
    }

    public function getContent()
    {
        $errorMessage = null;
        if (isset($_POST['productName']) && isset($_POST['brand']) && isset($_POST['category']) && isset($_POST['descriptionEn']) && isset($_POST['descriptionDe']) && isset($_POST['price'])) {
            $options = ProductController::getAllOptions($_SESSION['lang']);
            $optionError = null;
            foreach ($options as $option) {
                if (!isset($_POST[$option->optionId . '_option'])) {
                    $optionError = $this->languageController->getTextForLanguage("NOT_ALL_OPTIONS_SET");
                }
            }
            if ($optionError != null) {
                $errorMessage = $optionError;
            }
            else {
                $productName = UtilityController::validateInput($_POST['productName']);
                $brandId = UtilityController::validateInput($_POST['brand']);
                $categoryId = UtilityController::validateInput($_POST['category']);
                $descriptionEn = UtilityController::validateInput($_POST['descriptionEn']);
                $descriptionDe = UtilityController::validateInput($_POST['descriptionDe']);
                $price = UtilityController::validateInput($_POST['price']);
                $uploaddir = 'img/products/';
                $filename = date("YmdHis") .'.';
                $filename .= basename($_FILES['picture']['type']);
                $uploadfile = $_SESSION["uploads_base_url"] . "/" . $uploaddir . $filename;
                if (!move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
                    $errorMessage = $this->languageController->getTextForLanguage("FILE_UPLOAD_FAILED");
                }
                else {
                    $newProductId = ProductController::addProduct($productName, $brandId, $categoryId, $descriptionEn, $descriptionDe, $price, $uploaddir . $filename);
                    foreach ($options as $option) {
                        $optionValueIds = $_POST[$option->optionId . '_option'];
                        foreach ($optionValueIds as $optionValueId) {
                            ProductController::addProductOption($newProductId, $optionValueId);
                        }
                    }
                    UtilityController::redirect("product&id=".$newProductId);
                }
            }
        }
        else if (isset($_POST['productToRemove'])) {
            $productToRemove = UtilityController::validateInput($_POST['productToRemove']);
            ProductController::removeProduct($productToRemove);
        }
        $result = $this->navigationController->getContent();
        if (isset($_SESSION['person']) && $_SESSION['person']->role === 'admin') {
            $result .= $this->view->render($this->languageController, $errorMessage);
        } else {
            $result .= $this->view->renderNoRightsPage($this->languageController);
        }
        return $result;
    }
}