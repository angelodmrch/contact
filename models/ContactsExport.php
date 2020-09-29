<?php namespace Dmrch\Contact\Models;

use Backend\Models\ExportModel;
use ApplicationException;

class ContactsExport extends ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        $Contacts = Contacts::all();
        $Contacts->each(function($Contact) use ($columns) {
            $Contact->addVisible($columns);
        });
        return $Contacts->toArray();
    }
}