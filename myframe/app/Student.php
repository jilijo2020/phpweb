<?php
namespace App;      // 将命名空间放在App下

use myframe\Model;

class Student extends Model
{
    public function getTable()
    {
        return $this->table;
    }
}
