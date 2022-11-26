<?php
namespace myframe;

use Exception;

class Model
{
    protected $db; // 数据库连接对象
    protected $table = '';  // 表名
    protected $options;  // 配置项
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->initTable();
        $this->resetOption();
    }
    /**
     * 重置配置项
     */
    protected function resetOption()
    {
        $this->options = [
            'where' => '',// WHERE子句
            'order' => '',// ORDER BY子句
            'limit' => '',// LIMIT子句
            'data' => [],// WHERE中的数据部分
        ];
    }
    /**
     * 初始化表名
     */
    protected function initTable()
    {
        if ($this->table === '') {
            $this->table = strtolower(basename(get_class($this)));
            $this->table = $this->db->getConfig('prefix') . $this->table;
        }
    }
    /**
     * 拼接SQL语句
     */
    protected function buildSelect(array $field = [])
    {
        $field = empty($field) ? '*' : ('`' . implode('`,`', $field) . '`');
        $table = $this->table;
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        return "SELECT $field FROM `$table` $where $order $limit";
    }
    /**
     * 获取/查询多条数据
     */
    public function get(array $field = [])
    {
        $sql = $this->buildSelect($field);
        $data = $this->db->fetchAll($sql, $this->options['data']);
        $this->resetOption();
        return $data;
    }
    /**
     * 查询单条数据
     */
    public function first(array $field = [])
    {
        if (!$this->options['limit']) {
            $this->limit(1);
        }
        $sql = $this->buildSelect($field);
        $data = $this->db->fetchRow($sql, $this->options['data']);
        $this->resetOption();
        return $data;
    }
    /**
     * 查询某个字段的值
     */
    public function value($field)
    {
        $res = $this->first([$field]);
        return $res ? $res[$field] : null;
    }
    /**
     * 拼接WHERE子句
     */
    protected function buildWhere($field, $op, $value, $join = 'AND')
    {
        if (is_array($field)) {
            foreach ($field as $k => $v) {
                $this->buildWhere($k, $op, $v, $join);
            }
            return;
        } elseif (is_null($value)) {
            $value = $op;
            $op = '=';
        }
        if (empty($this->options['where'])) {
            $join = 'WHERE ';
        }
        $this->options['where'] .= "$join `$field` $op ?";
        $this->options['data'][] = $value;
    }
    /**
     * WHERE子句，使用AND连接多个条件
     */
    public function where($field, $op = '=', $value = null)
    {
        $this->buildWhere($field, $op, $value, 'AND');
        return $this;
    }
    /**
     * WHERE子句，使用OR连接多个条件
     */
    public function orWhere($field, $op = '=', $value = null)
    {
        $this->buildWhere($field, $op, $value, 'OR');
        return $this;
    }
    /**
     * 排序
     */
    public function orderBy($field, $sort = 'ASC')
    {
        $this->options['order'] = "ORDER BY `$field` $sort";
        return $this;
    }
    /**
     * 限量
     */
    public function limit($offset, $limit = '')
    {
        if ($limit) {
            $limit = ", $limit";
        }
        $this->options['limit'] = 'LIMIT ' . $offset . $limit;
        return $this;
    }
    /**
     * 拼接插入数据的sql
     */
    protected function buildInsert(array $field = [], $count = 1)
    {
        // 根据字段个数，生成指定的"?"占位符
        $value = array_fill(0, count($field), '?');
        // 将值拼接成"(?,?)"的形式
        $value = '(' . implode(',', $value) . ')';
        // 根据插入的条数$count,将值拼接成"(?,?),(?,?)"的形式
        $value = implode(',', array_fill(0, $count, $value));
        $field = '`' . implode('`,`', $field) . '`';
        $table = $this->table;
        return "INSERT INTO `$table` ($field) VALUES $value";
    }
    /**
     * 执行插入数据的方法
     */
    public function insert(array $data = [])
    {
        if (isset($data[0]) && is_array($data[0])) {
            // 一次新增多条数据
            $sql = $this->buildInsert(array_keys($data[0]), count($data));
            // 将二维数组转为一维数组
            $data = array_reduce($data, function ($carry, $item) {
                return array_merge($carry, array_values($item));
            }, []);
        } else {
            $sql = $this->buildInsert(array_keys($data));
            $data = array_values($data);
        }
        $res = $this->db->execute($sql, $data);
        $this->resetOption();
        return $res;
    }
    /**
     * 插入并返回最后插入的ID
     */
    public function insertGetId(array $data = [])
    {
        $this->insert($data);
        return $this->db->lastInsertId();
    }
    /**
     * 拼接修改的sql语句
     * UPDATE `student` SET `mobile`=?,`email`=? WHERE `id` = ? ORDER BY `id` DESC LIMIT 1;
     */
    protected function buildUpdate(array $fields = [])
    {
        $field = implode(',', array_map(function ($v) {
            return " `$v`=?";
        }, $fields));
        $table = $this->table;
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        return "UPDATE `$table` SET $field $where $order $limit";
    }
    /**
     * 执行修改
     */
    public function update(array $data = [])
    {
        if (empty($this->options['where'])) {
            throw new Exeption('update()缺少WHERE 条件。');
        }
        $sql = $this->buildUpdate(array_keys($data));
        // 将要修改的数据和WHERE中的数据合并
        $data = array_merge(array_values($data), $this->options['data']);
        $res = $this->db->execute($sql, $data);
        $this->resetOption();
        return $res;
    }
    /**
     * 拼接删除数据的sql语句
     */
    protected function buildDelete()
    {
        $table = $this->table;
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        return "DELETE FROM `$table` $where $order $limit";
    }
    /**
     * 执行删除
     */
    public function delete()
    {
        if (empty($this->options['where'])) {
            throw new Exeption('delete()缺少WHERE 条件。');
        }
        $sql = $this->buildDelete();
        $res = $this->db->execute($sql, $this->options['data']);
        $this->resetOption();
        return $res;
    }
    public function count()
    {
        $table = $this->table;
        $where = $this->options['where'];
        $sql = "SELECT COUNT(*) AS c FROM $table $where";
        $res = $this->db->fetchRow($sql, $this->options['data']);
        $this->resetOption();
        return $res ? $res['c'] : null;
    }
    public function increment($field, $add = 1)
    {
        $table = $this->table;
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        $sql = "UPDATE `$table` SET `$field`=`$field`+$add $where $order $limit";
        $res = $this->db->execute($sql, $this->options['data']);
        $this->resetOption();
        return $res;
    }
}
