<?php namespace Dmrch\Contact\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Exception;
use Dmrch\Contact\Models\Contacts as ContactsModel;

/**
 * Contacts Report Widget
 */
class Contacts extends ReportWidgetBase
{
    /**
     * @var string The default alias to use for this widget
     */
    protected $defaultAlias = 'ContactsReportWidget';

    /**
     * Defines the widget's properties
     * @return array
     */
    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'backend::lang.dashboard.widget_title_label',
                'default'           => 'dmrch.contact::lang.plugin.name',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error',
            ],
        ];
    }
    
    /**
     * Adds widget specific asset files. Use $this->addJs() and $this->addCss()
     * to register new assets to include on the page.
     * @return void
     */
    protected function loadAssets()
    {
    }
    
    /**
     * Renders the widget's primary contents.
     * @return string HTML markup supplied by this widget.
     */
    public function render()
    {
        try {
            $this->prepareVars();

            $this->vars['count'] = ContactsModel::count();
            $this->vars['unread'] = ContactsModel::where('status',0)->count();
            $this->vars['list'] = ContactsModel::limit(10)->orderBy('created_at','desc')->get();

        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('contacts');
    }

    /**
     * Prepares the report widget view data
     */
    public function prepareVars()
    {
    }
}
