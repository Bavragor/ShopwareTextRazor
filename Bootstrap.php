<?php

use Shopware\Models\Config\Form;
use Shopware\ShopwareTextRazor\Service\TextRazor;

class Shopware_Plugins_Frontend_ShopwareTextRazor_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * @return array
     */
    public function getInfo()
    {
        return [
            'version' => $this->getVersion(),
            'author' => 'Kevin Mauel <kevin.mauel2@gmail.com>',
            'label' => $this->getLabel(),
            'source' => 'Community',
            'description' => "",
            'license' => 'MIT',
            'copyright' => 'Copyright © ' . date('Y') . ', Kevin Mauel'
        ];
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return 'Live stock checking';
    }

    /**
     * Register the autoloader
     */
    public function afterInit()
    {
        require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

        $this->get('loader')->registerNamespace('
            Shopware\ShopwareTextRazor', __DIR__ . DIRECTORY_SEPARATOR . 'Component/'
        );
    }

    /**
     * Installs the plugin
     *
     * @return bool
     */
    public function install()
    {
        $this->createForm($this->Form());

        $this->initContainerServices();

        return [
            'success' => true
        ];
    }

    public function initContainerServices()
    {
        $this->subscribeEvent(
            'Enlight_Bootstrap_InitResource_shopware.service.text_razor',
            'onInitTextRazorService'
        );
    }

    public function onInitTextRazorService()
    {
        return new TextRazor(
            $this->config->get('text-razor-token')
        );
    }

    public function createForm(Form $form)
    {
        $form->setElement('text', 'text-razor-token', [
            'label' => 'API Token for TextRazor',
            'required' => true,
        ]);
    }

    public function enable()
    {
        return [
            'success' => true,
        ];
    }

    public function disable()
    {
        return [
            'success' => true
        ];
    }

    public function getCapabilities()
    {
        return [
            'install' => true,
            'update' => true,
            'enable' => true,
            'secureUninstall' => true
        ];
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        $this->secureUninstall();

        return [
            'success' => true
        ];
    }

    /**
     * @return bool
     */
    public function secureUninstall()
    {
        return true;
    }
}
