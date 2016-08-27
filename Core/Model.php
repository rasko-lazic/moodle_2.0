<?php

namespace FDF\Core;

abstract class Model
{
    /**
     * @var string $table Variable that holds table name
     */
    protected $table;

    /**
     * @var Container $app Variable that holds application container
     */
    protected $app;
    
    public function __construct()
    {
        $this->app = new Container();

        $this->table = strtolower(str_replace('FDF\Models\\', '', get_class($this)));
    }

    /**
     * Basic function fore generating SELECT queries
     *
     * @param string $field
     * @param string $selector
     * @param string $value
     * @return
     */
    public function select($field = null, $selector = null, $value = null)
    {
        $query = is_null($field) ? "SELECT * FROM `$this->table`" : "SELECT $field FROM `$this->table`";
        $query .= is_null($selector) ? "" : " WHERE `$selector` = '$value'";

        return $this->app->get('database')->fetchData($query);
    }

    /**
     * Function for generating INSERT queries
     *
     * @param $data
     * @return bool
     */
    public function create($data)
    {
        $fields = '';
        $values = '';
        if($this->validate($data)) {
            foreach ($data as $key => $value) {
                $fields .= "`$key`, ";
                $values .= is_null($value) ? "NULL, " : "'$value'";
            }
            $query = "INSERT INTO $this->table ($fields) VALUES ($values)";

            return $this->app->get('database')->runQuery($query);
        }

        return false;
    }

    public function customQuery($query)
    {
        return $this->app->get('database')->fetchData($query);
    }

    abstract public function validate($data);
}