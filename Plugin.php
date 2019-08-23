<?php

namespace Kanboard\Plugin\Taglist;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $tagmodel = $this->tagModel;
        $this->template->hook->attachCallable('template:app:filters-helper:after', 'taglist:tagfilter', function($array) use ($tagmodel) {
            return ['taglist' => $tagmodel->getAssignableList($array['id'])];
        });      
    }
    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
    }
    public function getPluginName()
    {
        return 'Taglist';
    }
    public function getPluginDescription()
    {
        return t('Taglist filter dropdown');
    }
    public function getPluginAuthor()
    {
        return 'BlueTeck';
    }
    public function getPluginVersion()
    {
        return '1.0.0';
    }
    public function getPluginHomepage()
    {
        return 'https://github.com/BlueTeck/kanboard_plugin_taglist';
    }
    public function getCompatibleVersion()
    {
        return '>=1.2.10';
    }
}