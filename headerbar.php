<?php
/**
 * Copyright since 2025 Jeremy Dobberman
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade to newer
 * versions in the future. If you wish to customize it for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    Jeremy Dobberman <yellowyankee@proton.me>
 * @copyright Since 2025 Jeremy Dobberman
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

class Headerbar extends Module
{
    public function __construct()
    {
        $this->name = 'headerbar';
        $this->tab = 'front_office_features';
        $this->version = '1.1.0';
        $this->author = 'Jeremy Dobberman';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '9.0.0',
            'max' => '9.99.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('Headerimage', [], 'Modules.Headerbar.Admin');
        $this->description = $this->trans('Full width header image.', [], 'Modules.Headerbar.Admin');

        $this->confirmUninstall = $this->trans('Are you sure you want to uninstall?', [], 'Modules.Headerbar.Admin');

        if (!Configuration::get('HEADERBAR_NAME')) {
            $this->warning = $this->trans('No name provided.', [], 'Modules.Headerbar.Admin');
        }
    }

    public function isUsingNewTranslationSystem(): bool
    {
        return true;
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        return
            parent::install()
            && $this->registerHook('displayWrapperTop')
            && $this->registerHook('actionFrontControllerSetMedia')
            && Configuration::updateValue('HEADERBAR_NAME', 'Headerimage');
    }

    public function uninstall()
    {
        return
            parent::uninstall()
            && $this->unregisterHook('displayWrapperTop')
            && $this->unregisterHook('actionFrontControllerSetMedia')
            && Configuration::deleteByName('HEADERBAR_NAME');
    }

    public function getContent()
    {
        $route = $this->get('router')->generate('headerimage_conf_form');
        Tools::redirectAdmin($route);
    }

    public function hookDisplayWrapperTop()
    {
        $this->context->smarty->assign([
            'headerbar_name' => Configuration::get('HEADERBAR_NAME'),
            'headerbar_index_title' => Configuration::get('HEADERBAR_INDEX_TITLE'),
            'headerbar_index_subtitle' => Configuration::get('HEADERBAR_INDEX_SUBTITLE'),
            'headerbar_index_image' => Configuration::get('HEADERBAR_INDEX_IMAGE'),
            'headerbar_about_title' => Configuration::get('HEADERBAR_ABOUT_TITLE'),
            'headerbar_about_subtitle' => Configuration::get('HEADERBAR_ABOUT_SUBTITLE'),
            'headerbar_about_image' => Configuration::get('HEADERBAR_ABOUT_IMAGE'),
        ]);

        return $this->display(__FILE__, 'headerbar.tpl');
    }

    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerStylesheet(
            'headerbar-style',
            'modules/' . $this->name . '/views/css/headerbar.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );
    }
}
