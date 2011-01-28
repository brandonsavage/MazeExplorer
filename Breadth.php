<?php

class Breadth extends SearchAbstract
{

  public function exploreMaze()
  {
    $id = null;
    $lastNode = $this->_maze->getRoot();
    $childrenToExplore = $lastNode->getChildren();
    $endNode = null;
    $endChild = null;

    while(is_null($endNode) && !empty($childrenToExplore))
    {
      $newChildren = array();
      foreach($childrenToExplore as $child)
      {
        $childNode = $this->_maze->traverseNodes($child);        
        if($childNode == 0) {
          $endNode = $this->_maze->getParent($child);
          $endChild = $child;
        } else {
          $lastNode = $childNode;
          $newChildren = array_merge($newChildren, $childNode->getChildren());
        }
      }

      $childrenToExplore = $newChildren;
    }

    if(is_null($endNode)) {
      throw new Exception('No end node was located');
    }

    return $this->getPath($endNode, $endChild);
  }

}