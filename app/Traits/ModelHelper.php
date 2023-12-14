<?php

namespace App\Traits;

use Exception;

trait ModelHelper
{
    protected $fillable = [];
    protected $columns = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public static function parseOrDefaultTimeStamp(self $model, $columnName)
    {
        if ($model->{$columnName} && !blank($model->{$columnName})) return $model->{$columnName};

        $type =  self::getColumnType($model, $columnName);

        if ($type == 'datetime') return "0000-00-00 00:00:00";

        if ($type == 'date') return "0000-00-00";
    }

    public static function getColumnType($model, $columnName)
    {
        $columns = $model->getConnection()->getSchemaBuilder()->getColumns($model->getTable());

        $columns = array_values(array_filter($columns, fn ($column) => $column['name'] == $columnName));

        if (!count($columns)) throw new Exception("Column is not present in the table.");

        return $columns[0]['type_name'];
    }
}
