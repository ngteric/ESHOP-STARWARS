<?php namespace Models;

class Model
{
    use \DebugTrait;
    protected $pdo;
    protected $table;
    public $where;
    public $select;
    protected $order = "id";
    protected $orderDirection = "DESC";
    protected $limit = 10;

    public function __construct()
    {
        if(!class_exists('\Connect')) throw new \RuntimeException("class Connect doesn't exists !");
        $this->pdo = \Connect::$pdo;
    }

    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        $this->$method($value);
    }

    public function setTable($tableName)
    {
        $this->table = $tableName;
    }

    public function select($args = '*')
    {
        if ($args == '*') {
            $this->select = $args;
            return $this;
        }
        if (is_array($args)) {
            $this->select = implode(',', $args);
            return $this;
        }
    }

    public function where($field, $operator, $value)
    {

        if (!is_numeric($value)) {
            $value = $this->pdo->quote($value);
        }

        $operators = ['=', '>', '<', '!=', '<>', '>=', '<='];
        if (!in_array($operator, $operators)) {
            die(sprintf('invalid SQL operator, %s', $operator));
        }
        if (sizeof($this->where) == 0) {
            $this->where [] = $field . $operator . $value;
            return $this;
        } else {
            $this->where [] = "AND " . $field . $operator . $value;
            return $this;
        }
    }

    public function get()
    {
        $where = $this->buildWhere();
        $select = $this->select;
        $this->select = '';
        $this->where = [];

        $sql = sprintf("SELECT %s FROM %s WHERE %s ORDER BY %s %s LIMIT 0, %s",
            $select,
            $this->table,
            $where,
            $this->order,
            $this->orderDirection,
            $this->limit
        );

        $this->debug($sql);
        return $this->pdo->query($sql);
    }

    private function buildWhere()
    {
        if (empty($this->where)) {
            return $where = '1 = 1';
        } else {
            return $where = implode(' ', $this->where);
        }
        //clean
        $this->where = [];
    }

    public function count()
    {

        $where = $this->buildWhere();
        $sql = sprintf("SELECT count(*) FROM %s WHERE %s",
            $this->table,
            $where
        );
        $res = $this->pdo->query($sql);
        return $res->fetchColumn();
    }

    public function create($data)
    {
        foreach ($data as $key => $value) {
            $nameColumn[] = $key;
            $values[] = $this->pdo->quote($value);
        }
        $nameColumn = implode('`,`', $nameColumn);
        $values = implode(',', $values);

        $sql = sprintf("INSERT INTO %s (`%s`) VALUES (%s)",
            $this->table,
            $nameColumn,
            $values
        );
        $this->debug($sql);
        return $this->pdo->query($sql);
    }

    public function all($args = '*')
    {
        $stmt = $this->select($args)->get();

        if(!$stmt) return false;

        return $stmt->fetchAll();
    }

    public function find($id, $args = '*')
    {
        $stmt = $this->select($args)->where('id', '=', $id)->get();

        if(!$stmt) return false;

        return $stmt->fetch();
    }
}