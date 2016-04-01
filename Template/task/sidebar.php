<?php
    $routerController = $this->app->getRouterController();
    $routerPlugin = $this->app->getPluginName();

    $active = $routerController == 'relationgraph' && $routerPlugin == 'RelationGraph';
?>
<ul>
    <li class="<?= $active ? 'active' : '' ?>">
        <i class="fa fa-rotate-left fa-fw"></i>
        <?= $this->url->link(
            'Relation Graph',
            'relationgraph',
            'show',
            ['plugin' => 'relationgraph', 'task_id' => $task['id']]
        ) ?>
    </li>
</ul>

