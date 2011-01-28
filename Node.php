<?php

class Node
{
  public $id;
  public $parent;
  public $children = array();

  public function __construct($id, $parent = null, array $children = array())
  {
    $this->id = $id;
    $this->parent = $parent;
    $this->children = $children;
  }

  public function addChild($child)
  {
    $this->children[] = $child;
  }

  public function replaceChildren(array $children)
  {
    $this->children = $children;
  }

  public function getChildren()
  {
    return $this->children;
  }

  public function getParent()
  {
    return $this->parent;
  }

  public function isRoot()
  {
    if(empty($this->parent)) {
      return true;
    }

    return false;
  }
}