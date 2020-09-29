<?php namespace Dmrch\Contact;

use Backend;
use System\Classes\PluginBase;
//use Dmrch\Contact\Models\MailConfig;
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
            'name'        => 'Contact',
            'description' => 'Plugin para Contacts e Newsletter',
            'author'      => 'Angelo Demarchi',
            'icon'        => 'icon-envelope'
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
        /*$config_site_key = MailConfig::get('site_key');
        $config_secret_key = MailConfig::get('secret_key');

        if ($config_site_key && $config_secret_key) {
            Validator::extend('recaptcha', function($attribute, $value, $parameters) {
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
        }    */    
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
                'tab'   => 'Contact',
                'label' => 'Contact'
            ],
            'dmrch.contact.access_newslleter' => [
                'tab'   => 'Contact',
                'label' => 'Newsletter'
            ],
            'dmrch.contact.access_config' => [
                'tab'   => 'Contact',
                'label' => 'Configurações'
            ],
            'dmrch.contact.access_forms' => [
                'tab'   => 'Contact',
                'label' => 'Forms'
            ],
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
                'label'       => 'Contact',
                'url'         => Backend::url('dmrch/contact/contacts'),
                'icon'        => 'icon-envelope',
                'order'       => 500,
                'permissions' => ['dmrch.contact.*'],
                'sideMenu' => [
                    'contacts' => [
                        'label'       => 'Contact',
                        'icon'        => 'icon-envelope',
                        'url'         => Backend::url('dmrch/contact/contacts'),   
                        'permissions' => ['dmrch.contact.access_contact'], 
                    ], 
                    'newsletter' => [
                        'label'       => 'Newsletter',
                        'icon'        => 'icon-envelope',
                        'url'         => Backend::url('dmrch/contact/newsletter'),   
                        'permissions' => ['dmrch.contact.access_newslleter'],
                     ],
                    'forms' => [
                        'label'       => 'Forms',
                        'icon'        => 'icon-wpforms',
                        'url'         => Backend::url('dmrch/contact/form'),
                        'permissions' => ['dmrch.contact.access_contact'],
                    ], 
                    'mailconfig' => [
                        'label'       => 'Configurações',
                        'icon'        => 'icon-cogs',
                        'url'         => Backend::url('system/settings/update/dmrch/contact/settings'), 
                        'permissions' => ['dmrch.contact.access_config'],   
                    ]
                ]
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Contact',
                'description' => 'Manage Contact settings.',
                'category'    => 'Contact',
                'icon'        => 'icon-cog',
                'class'       => 'Dmrch\Contact\Models\MailConfig',
                'order'       => 500,
                'permissions' => ['dmrch.contact.access_config'],   
            ]
        ];
    }
}