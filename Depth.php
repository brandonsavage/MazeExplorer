<?php

class Depth extends SearchAbstract
{
  public function exploreMaze()
  {
    $endPoint = $this->_recurseMaze();
    return $this->getPath($endPoint['last'], $endPoint['end']);
  }

  protected function _recurseMaze($node = null)
  {
    if(is_null($node)) {
      // Get the root node
      $node = $this->_maze->getRoot();
    }

    $children = $node->getChildren();
    foreach($children as $child)
    {
      $next = $this->_maze->traverseNodes($child);
      if($next == 0) {
        return array(
          'last' => $this->_maze->getParent($child),
          'end' => $child,
        );
      } else {

        $result = $this->_recurseMaze($next);
        if($result) {
         return $result;
        }
      }
      
    }
  }
}