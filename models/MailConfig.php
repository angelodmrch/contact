<?php namespace Dmrch\Contact\Models;

use Model;

/**
 * MailConfig Model
 */
class MailConfig extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'dmrch_contact_mail_configs';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}