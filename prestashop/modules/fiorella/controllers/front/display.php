<?php

class FiorellaDisplayModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        $sql = new DbQuery();
        $sql->select('COUNT(*)')->from('product');

        $this->context->smarty->assign([
            'user' => $this->context->customer->firstname,
            'number' => Db::getInstance()->getValue($sql)
        ]);

        $this->setTemplate('module:fiorella/views/templates/front/display.tpl');
    }
}
