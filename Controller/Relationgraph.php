<?php

namespace Kanboard\Plugin\Relationgraph\Controller;

use Kanboard\Controller\Base;

class Relationgraph extends Base
{
    public function show()
    {
        $task = $this->getTask();

        $graph = $this->createGraph($task);

        $this->response->html(
            $this->helper->layout->task(
                'relationgraph:task/show',
                [
                    'title' => $task['title'],
                    'task' => $task,
                    'graph' => $graph
                ]
            )
        );
    }

    /**
     * @param $task
     * @return array
     * @throws \Exception
     */
    protected function createGraph($task)
    {
        $graph = [];
        $graph['tasks'] = [];
        $graph['edges'] = [];

        $this->traverseGraph($graph, $task);

        $graphData = [
            'nodes' => $graph['tasks'],
            'edges' => $graph['edges']
        ];

        return $graphData;
    }

    protected function traverseGraph(&$graph, $task)
    {
        if (!isset($graph['tasks'][$task['id']])) {
            $graph['tasks'][$task['id']] = [
                'id' => $task['id'],
                'title' => $task['title'],
                'active' => $task['is_active'],
                'project' => $task['project_name'],
                'score'=> $task['score'],
                'assignee' => $task['assignee_username']
            ];
        }

        foreach ($this->taskLink->getAllGroupedByLabel($task['id']) as $type => $links) {
            foreach ($links as $link) {
                if (!isset($graph['edges'][$task['id']][$link['task_id']]) &&
                    !isset($graph['edges'][$link['task_id']][$task['id']])) {
                    $graph['edges'][$task['id']][$link['task_id']] = $type;

                    $this->traverseGraph(
                        $graph,
                        $this->taskFinder->getDetails($link['task_id'])
                    );
                }
            }
        }
    }
}