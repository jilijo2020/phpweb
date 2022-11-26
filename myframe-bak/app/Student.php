<?php
namespace App;

use myframe\Model;

class Student extends Model
{
    public function getTable()
	{
		return $this->table;
	}
}
