<?php 

declare(strict_types=1);

namespace Core;

use PDO;
use Core\Database;

defined('ROOT_PATH') or exit('Access Denied!');

trait SubModel
{
    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "id";
    public $errors = [];

    protected function getDb($setFetchClass = false)
    {
        $db = Database::getInstance();
        if ($setFetchClass) {
            $db->setClass(get_called_class());
            $db->setFetchType(PDO::FETCH_CLASS);
        }
        return $db;
    }

    public function sub_findAll()
    {
        $db = $this->getDb();

        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        return $db->query($query);
    }

    public function sub_where($data, $data_not = [])
    {
        $db = $this->getDb();

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        return $db->query($query, $data);
    }

    public function sub_first($data, $data_not = [])
    {
        $db = $this->getDb(true);
        
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $query .= " limit $this->limit offset $this->offset";
        $data = array_merge($data, $data_not);

        $result = $db->query($query, $data)->results();
        if ($result)
            return $result[0];

        return false;
    }

    public function sub_insert($data)
    {
        $db = $this->getDb();

        /** remove unwanted data **/
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {

                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);

        $query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
        $db->query($query, $data);

        return false;
    }

    public function sub_update($id, $data, $id_column = 'id')
    {
        $db = $this->getDb();

        /** remove unwanted data **/
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {

                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = trim($query, ", ");

        $query .= " where $id_column = :$id_column ";

        $data[$id_column] = $id;

        $db->query($query, $data);
        return false;

    }

    public function sub_delete($id, $id_column = 'id')
    {
        $db = $this->getDb();

        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column ";
        $db->query($query, $data);

        return false;

    }
}