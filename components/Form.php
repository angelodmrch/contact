<?php namespace Dmrch\Contact\Components;

use Cms\Classes\ComponentBase;
use Dmrch\Contact\Models\Form as ModelForm;
use Dmrch\Contact\Models\Contacts as ModelContact;
use Dmrch\Contact\Models\MailConfig as ModelConfig;
use System\Models\File as ModelFiles;
use Validator;
use Input;
use Mail;
use Redirect;
use Lang;

class Form extends ComponentBase
{

    public $errors;
    public $success = false;

    public function componentDetails()
    {
        return [
            'name'        => 'Form Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'code' => [
                'title' => 'Code',
                'type' => 'string'
            ],
        ];
    }

    public function onRun() {
        $this->addJs('https://www.google.com/recaptcha/api.js', [
            'defer' => true,
            'async' => true
        ]);
    }

    public function getForm($code) {
        return ModelForm::where('code', $code)->first();
    }

    public function getConfig($filed) {
        return ModelConfig::get($filed);
    }

    public function onSubmit() {

        $form = ModelForm::where('code', post('form_code'))->first();

        $rules = [
            'g-recaptcha-response' => 'recaptcha'
        ];

        $messages = [
            'g-recaptcha-response.recaptcha' => Lang::get('dmrch.contact::lang.validation.required'),
        ];

        foreach ($form->fields as $field) {
            if ($field['validation']) {

                $rules[$field['name']] = '';
                foreach ($field['validation'] as $rule) {
                    $rules[$field['name']] .= $rule['rule'].'|';
                    $messages[$field['name'].'.'.$rule['rule']] = $rule['message'];
                }
            }
        }

        $validation = Validator::make(Input::all(), $rules, $messages);    

        if ($validation->fails()) {
            $this->errors = $validation->errors();
        }else{
            try {

                $data = Input::all();                

                $message = '<p>';

                foreach ($form->fields as $value) {
                    if ($value['type'] !== 'file') {
                        $message .= '<b>'. $value['label'] .':</b><br>'.post($value['name']).'<br><br>';
                    }
                }

                $message .= '</p>';


                $data['message_html'] = $message;

                if ($form->save_on_db) {

                    $formSave = new ModelContact();
                    $formSave->form = post('form_name'); 
                    $formSave->email = post('email');  
                    $formSave->message = $message;
                    $formSave->status = 0;
                    $formSave->save();

                    foreach ($form->fields as $key => $value) {
                        if ( $value['type'] == 'file' && Input::file($value['name'])) {
                            $saveC = new ModelFiles;
                            $saveC->data = Input::file($value['name']);
                            $saveC->attachment_id = $formSave->id;
                            $saveC->attachment_type = 'Dmrch\Contact\Models\Contacts';
                            $saveC->field = 'files'; 
                            $saveC->save();
                        }
                    }
                    
                }

                if ($form->emails) {

                    $pathFiles = $formSave->files;
                    $emails = $form->emails; 

                    Mail::send('dmrch.contact::mail.contact', $data, function($mailsend) use($pathFiles, $data, $emails) {
                        $emails = explode(',', $emails);
                        $mailsend->to($emails[0]); 

                        if ($pathFiles) {
                            foreach ($pathFiles as $value) {
                                $mailsend->attach($value->getPath());  
                            }                                
                        }

                        if(count($emails) > 1){
                            for($i=1;$i<count($emails);$i++){
                                $mailsend->cc($emails[$i]);
                            }
                        }

                        // replay
                        if($data['email']){
                            $mailsend->replyTo($data['email']);
                        }

                    });

                }

                if ($form->redirect) {
                    return Redirect::to($form->redirect_to);
                }

                $this->success = true;
            } catch (Exception $e) {
                $this->errors = $e->getMessage();
            } 
        }
    }
}
