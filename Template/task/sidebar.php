<?php
    $routerController = $this->app->getRouterController();
    $routerPlugin = $this->app->getPluginName();

    $active = $routerController == 'relationgraph' && $routerPlugin == 'RelationGraph';
?>
<li <?= $active ? 'class="active"' : '' ?>>
    <?= $this->url->link(
        'Relation Graph',
        'relationgraph',
        'show',
        ['plugin' => 'relationgraph', 'task_id' => $task['id']]
    ) ?>
</li>

