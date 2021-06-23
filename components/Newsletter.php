<?php namespace Dmrch\Contact\Components;

use Cms\Classes\ComponentBase;
use Dmrch\Contact\Models\Newsletter as ModelNewsletter;
use Validator;
use Lang;

class Newsletter extends ComponentBase
{

    public $news_errors;
    public $news_success = false;

    public function componentDetails()
    {
        return [
            'name'        => 'Newsletter Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onSubmit() 
    {        
        $rules = [
            'email'   => 'required|email'
        ];

        $messages = [
            'email.required' => Lang::get('dmrch.contact::lang.validation.required'),
            'email.email' => Lang::get('dmrch.contact::lang.validation.email')
        ];

        $validation = Validator::make(post(), $rules, $messages);    

        if ($validation->fails()) {
            $this->news_errors = $validation->errors();
        }else{
            try {

                $exists = ModelNewsletter::where('email', post('email'))->first();

                if (!$exists) {

                    $formSave = new ModelNewsletter();
                    $formSave->name = post('name');
                    $formSave->email = post('email');  
                    $formSave->save();     
                }        

                $this->news_success = true;
            } catch (Exception $e) {
                $this->news_errors = $e->getMessage();
            } 
        }
    }
}