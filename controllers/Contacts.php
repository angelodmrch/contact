<?php namespace Dmrch\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Dmrch\Contact\Models\Contacts as ModContact;
use Flash;

/**
 * Contact Back-end Controller
 */
class Contacts extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $importExportConfig = 'config_import_export.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Dmrch.Contact', 'contacts', 'contacts');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $postId) {
                if ((!$post = ModContact::find($postId)))
                    continue;

                $post->delete();
            }

            \Flash::success('Deletado com sucesso.');
        }

        return $this->listRefresh();
    }

    public function index_onChecked()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $postId) {
                if ((!$post = ModContact::find($postId)))
                    continue;

                $post->status = true;
                $post->save();
            }

            \Flash::success('Mensagens foram marcadas como lidas!');
        }

        return $this->listRefresh();
    }

    public function index_onUnchecked()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $postId) {
                if ((!$post = ModContact::find($postId)))
                    continue;

                $post->status = false;
                $post->save();
            }

            \Flash::success('Mensagens foram marcadas como lidas!');
        }

        return $this->listRefresh();
    }
}
