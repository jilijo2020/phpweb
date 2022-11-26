<?php
class Node
{
    public $key;
    public $val;
    public $right;
    public $left;
    public $N;
    public function __construct($key, $val, $N)
    {
        $this->key = $key;
        $this->val = $val;
        $this->N = $N;
    }
}
class BSTree
{
    private $root;
    public function __construct(Node $node)
    {
        $this->root = $node;
    }
    public function __get($name)
    {
        return $this->$name;
    }
    private function size(?Node $x): int
    {
        if ($x == null) {
            return 0;
        } else {
            return $x->N;
        }
    }
    public function get(?Node $x, $key)
    {
        if ($x == null) {
            return null;
        }
        $cmp = strcmp($key, $x->key);
        if ($cmp < 0) {
            return $this->get($x->left, $key);
        } elseif ($cmp > 0) {
            return $this->get($x->right, $key);
        } else {
            return $x->val;
        }
    }

    public function put(?Node $x, $key, $val): Node
    {
        if ($x == null) {
            return new Node($key, $val, 1);
        }

        $cmp = strcmp($key, $x->key);
        if ($cmp < 0) {
            $x->left = $this->put($x->left, $key, $val);
        } elseif ($cmp > 0) {
            $x->right = $this->put($x->right, $key, $val);
        } else {
            $x->val = $val;
        }

        $x->N = $this->size($x->left) + $this->size($x->right) + 1;
        return $x;
    }
}
$node = new Node('S', 8, 0);
$bst = new BSTree($node);
$bst->put($bst->root, 'X', 1);
$bst->put($bst->root, 'E', 6);
// $node3 = $bst->put($node1, 'R', 3);
$bst->put($bst->root, 'R', 3);
// $node5 = $bst->put($node3, 'H', 2);
$bst->put($bst->root, 'H', 2);
// $node6 = $bst->put($node5, 'M', 3);
$bst->put($bst->root, 'M', 3);
// $node4 = $bst->put($node1, 'A', 2);
$bst->put($bst->root, 'A', 2);
// $node7 = $bst->put($node4, 'C', 1);
$bst->put($bst->root, 'C', 1);
// var_dump($bst->get($bst->root, 'A'));
var_dump($bst);
