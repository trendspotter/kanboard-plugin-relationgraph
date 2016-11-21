<?php

namespace Kanboard\Plugin\Relationgraph;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $this->route->addRoute('/plugin/relation_graph/:task_id', 'relationgraph', 'show', 'relationgraph');

        $this->template->hook->attach('template:task:sidebar:information', 'relationgraph:task/sidebar');
    }

    public function getPluginName()
    {
        return 'Relationgraph';
    }

    public function getPluginAuthor()
    {
        return 'Xavier Vidal <xavividal@gmail.com>';
    }

    public function getPluginVersion()
    {
        return '0.1.3';
    }

    public function getPluginDescription()
    {
        return t('Show relations between tasks using a graph');
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/xavividal/kanboard-plugin-relationgraph';
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }
}
