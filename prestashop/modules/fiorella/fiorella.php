<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Fiorella extends Module
{
    public function __construct()
    {
        $this->name = 'fiorella';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Matthieu Mota';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Fiorella');
        $this->description = $this->l('An example module.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('leftColumn') &&
            $this->registerHook('actionFrontControllerSetMedia');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function hookLeftColumn()
    {
        $this->context->smarty->assign([
            'user' => 'Fiorella',
            'link' => $this->context->link->getModuleLink('fiorella', 'display'),
        ]);

        return $this->display(__FILE__, 'fiorella.tpl');
    }

    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerStylesheet(
            'fiorella-css',
            'modules/' . $this->name . '/views/css/fiorella.css'
        );

        $this->context->controller->registerJavascript(
            'fiorella-js',
            'modules/' . $this->name . '/views/js/fiorella.js'
        );
    }
}
