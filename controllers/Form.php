<?php namespace Dmrch\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Form Back-end Controller
 */
class Form extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Dmrch.Contact', 'contacts', 'form');
    }
}
