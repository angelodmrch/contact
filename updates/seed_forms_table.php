<?php namespace Dmrch\Contact\Updates;

use Seeder;
use Dmrch\Contact\Models\Form as FormsModel;

class SeedFormsTable extends Seeder
{
    public function run()
    {
        $user = FormsModel::create([
            'name'  => 'Contact',
            'code'  => 'contact',
            'fields'  => '[{"label":"Name","name":"name","type":"text","placeholder":"","partial":"","validation":[{"rule":"required","message":"This field is required"}],"columns":"6","options":[]},{"label":"E-mail","name":"email","type":"email","placeholder":"","partial":"","validation":[{"rule":"required","message":"This field is required"},{"rule":"email","message":"Must be an valid email"}],"columns":"6","options":[]},{"label":"Message","name":"message","type":"textarea","placeholder":"","partial":"","validation":[{"rule":"required","message":"This field is required"}],"columns":"12","options":[]}]',
            'success_message'  => '<p>Message sent successfully!</p>',
            'error_message'  => '<p>Something went wrong!</p>',
        ]);
    }
}