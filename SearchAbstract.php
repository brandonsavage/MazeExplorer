<?php

abstract class SearchAbstract
{
  /**
   *
   * @var Maze
   */
  protected $_maze;

  public function __construct(Maze $maze)
  {
    $this->_maze = $maze;
  }

  public function getPath($node, $child)
  {
    $array = array($child);
    while(!$node->isRoot()) {
      $array[] = $node->id;
      $node = $this->_maze->traverseNodes($node->parent);
    }

    $array[] = $node->id;
    return array_reverse($array);
  }

  abstract public function exploreMaze();
}