<?php

namespace Kanboard\Plugin\Taglist;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $tagmodel = $this->tagModel;
        $this->template->hook->attachCallable('template:app:filters-helper:after', 'taglist:tagfilter', function($array = array()) use ($tagmodel) {
            if(!empty($array) && $array['id'] >= 1){
                $project = $this->projectModel->getById($array['id']);
                return ['taglist' => $tagmodel->getAssignableList($array['id'], $project['enable_global_tags'])];
            } else {
                // get global tags
                return ['taglist' => $this->db->hashtable($tagmodel::TABLE)->eq('project_id', 0)->asc('name')->getAll('id', 'name')];
            }
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
        return '1.1.0';
    }
    public function getPluginHomepage()
    {
        return 'https://github.com/BlueTeck/kanboard_plugin_taglist';
    }
    public function getCompatibleVersion()
    {
        return '>1.2.13';
    }
}
