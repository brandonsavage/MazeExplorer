<?php

class Maze
{
  protected $_items = array();

  public function addNode(Node $node)
  {
    if($node->isRoot()) {
      foreach($this->_items as $item)
      {
        if($item->isRoot()) {
          throw new Exception('Too many root nodes provided');
        }
      }
    } else {
      $parent = $node->parent;
      if(!isset($this->_items[$parent])) {
        throw new Exception('The parent specified has not yet been registered');
      }

      $this->_items[$parent]->addChild($node->id);
    }

    $this->_items[$node->id] = $node;
  }

  /**
   * If an ID is specified, it will return the node we seek. Otherrwise, it will
   * locate the root node.
   * @param <type> $id
   */
  public function traverseNodes($id = null)
  {
    if(is_null($id)) {
      $rootNode = null;
      foreach($this->_items as $item) {
        if($item->isRoot()) {
          $rootNode = $item;
          break;
        }
      }

      if(is_null($rootNode)) {
        throw new Exception('No root node found');
      }

      return $rootNode;
    }

    if(!isset($this->_items[$id])) {
      return 0; // Effectively exit 0; if we return 0, it means we've reached an exit point.
    }

    return $this->_items[$id];
  }

  public function getRoot()
  {
    foreach($this->_items as $item)
    {
      if($item->isRoot()) {
        return $item;
      }
    }

    throw new Exception('No root node found');
  }

  public function getParent($child)
  {
    foreach($this->_items as $item)
    {
      if(in_array($child, $item->children)) {
        return $item;
      }
    }

    throw new Exception('That parent was not found');
  }
}