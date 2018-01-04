<?php

namespace app\modules\catalog\components;

use paulzi\adjacencyList\AdjacencyListBehavior as BaseAdjacencyListBehavior;

class AdjacencyListBehavior extends BaseAdjacencyListBehavior
{

    protected function insertNearInternal($forward)
    {
        $this->checkNode(false);
        $this->owner->setAttribute($this->parentAttribute, $this->node->getAttribute($this->parentAttribute));
        if ($this->sortable !== false) {
            if ($forward) {
                $this->behavior->moveAfter($this->node);
            } else {
                $this->behavior->moveBefore($this->node);
            }
        }
    }

}