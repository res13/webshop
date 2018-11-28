<?php

abstract class Controller
{
    protected $view;

    protected $title;

    protected $languageController;

    protected $navigationController;

    public function __construct(View $view, $title)
    {
        $this->view = $view;
        $this->title = $title;
        $this->languageController = new LanguageController();
        $this->navigationController = new NavigationController($this->languageController);
    }

    public function getTitle() {
        return $this->languageController->getTextForLanguage($this->title);
    }

    public function getContent()
    {
        $result = $this->navigationController->getContent();
        $result .= $this->view->render($this->languageController);
        return $result;
    }

    public function performHead()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_POST['lang']) && in_array($_POST['lang'], $this->languageController->getAvailableLanguages())) {
            $_SESSION['lang'] = $_POST['lang'];
            if (isset($_SESSION['person'])) {
                $_SESSION['person']->lang = $_POST['lang'];
                Person::setLanguageOfPerson($_SESSION['person']->id, $_POST['lang']);
                setcookie("lang", $_POST['lang'], 0, "", "parachute.webshop.ch", false, false);
            }
        } else if (!isset($_SESSION['lang'])) {
            if (isset($_COOKIE['lang'])) {
                $lang = $_COOKIE['lang'];
            } else {
                $lang = getDefaultLanguage();
            }
            if (isset($_SESSION['person'])) {
                $lang = Person::getLanguageOfPerson($_SESSION['person']->id);
                $_SESSION['person']->lang = $lang;
            }
            $_SESSION['lang'] = $lang;
            setcookie("lang", $lang, 0, "", "parachute.webshop.ch", false, false);
        }
    }

}