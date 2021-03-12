<?php namespace Dmrch\Contact;

use Backend;
use System\Classes\PluginBase;
use Dmrch\Contact\Models\MailConfig;
use Validator;

/**
 * Contact Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'dmrch.contact::lang.plugin.name',
            'description' => 'dmrch.contact::lang.plugin.description',
            'author'      => 'Angelo Demarchi',
            'icon'        => 'icon-commenting-o'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $config_site_key = MailConfig::get('site_key');
        $config_secret_key = MailConfig::get('secret_key');

        if ($config_site_key && $config_secret_key) {
            Validator::extend('recaptcha', function($attribute, $value, $parameters) use ($config) {
                $post_data = http_build_query(
                    array(
                        'secret' => $config_secret_key,
                        'response' => $value,
                        'remoteip' => $_SERVER['REMOTE_ADDR']
                    )
                );
                $opts = array('http' =>
                    array(
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $post_data
                    )
                );
                $context  = stream_context_create($opts);
                $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
                $result = json_decode($response);

                if (!$result->success) {
                    return false;
                } else {
                    return true;
                }
            });
        } else {
            return true;
        }  
    }

    public function registerMailTemplates()
    {
        return [
            'dmrch.contact::mail.contact'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Dmrch\Contact\Components\Newsletter' => 'newsletter',
            'Dmrch\Contact\Components\Form' => 'forms'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'dmrch.contact.access_contact' => [
                'tab'   => 'dmrch.contact::lang.base.contact',
                'label' => 'dmrch.contact::lang.base.contact'
            ],
            'dmrch.contact.access_newslleter' => [
                'tab'   => 'dmrch.contact::lang.base.contact',
                'label' => 'dmrch.contact::lang.base.newslleter'
            ],
            'dmrch.contact.access_config' => [
                'tab'   => 'dmrch.contact::lang.base.contact',
                'label' => 'dmrch.contact::lang.base.settings'
            ],
            'dmrch.contact.access_forms' => [
                'tab'   => 'dmrch.contact::lang.base.contact',
                'label' => 'dmrch.contact::lang.base.forms'
            ],
            'dmrch.contact.access_forms_edit' => [
                'tab'   => 'dmrch.contact::lang.base.contact',
                'label' => 'dmrch.contact::lang.base.forms_edit'
            ]
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [

            'contacts' => [
                'label'       => 'dmrch.contact::lang.base.contact',
                'url'         => Backend::url('dmrch/contact/contacts'),
                'icon'        => 'icon-commenting-o',
                'order'       => 500,
                'permissions' => ['dmrch.contact.*'],
                'sideMenu' => [
                    'contacts' => [
                        'label'       => 'dmrch.contact::lang.base.contact',
                        'icon'        => 'icon-commenting-o',
                        'url'         => Backend::url('dmrch/contact/contacts'),   
                        'permissions' => ['dmrch.contact.access_contact'], 
                    ], 
                    'newsletter' => [
                        'label'       => 'dmrch.contact::lang.base.newsletter',
                        'icon'        => 'icon-envelope',
                        'url'         => Backend::url('dmrch/contact/newsletter'),   
                        'permissions' => ['dmrch.contact.access_newslleter'],
                     ],
                    'forms' => [
                        'label'       => 'dmrch.contact::lang.base.forms',
                        'icon'        => 'icon-wpforms',
                        'url'         => Backend::url('dmrch/contact/form'),
                        'permissions' => ['dmrch.contact.access_forms'],
                    ], 
                    'mailconfig' => [
                        'label'       => 'dmrch.contact::lang.base.settings',
                        'icon'        => 'icon-cogs',
                        'url'         => Backend::url('system/settings/update/dmrch/contact/settings'), 
                        'permissions' => ['dmrch.contact.access_config'],   
                    ]
                ]
            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'dmrch.contact::lang.settings.label',
                'description' => 'dmrch.contact::lang.settings.description',
                'category'    => 'dmrch.contact::lang.settings.general',
                'icon'        => 'icon-cog',
                'class'       => 'Dmrch\Contact\Models\MailConfig',
                'order'       => 500,
                'permissions' => ['dmrch.contact.access_config'],   
            ]
        ];
    }

    public function registerReportWidgets()
    {
        return [
            'Dmrch\Contact\ReportWidgets\Contacts' => [
                'label'   => 'dmrch.contact::lang.plugin.name',
                'context' => 'dashboard',
                'permissions' => ['dmrch.contact.access_contact'], 
            ]
        ];
    }
}