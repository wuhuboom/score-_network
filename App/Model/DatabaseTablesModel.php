<?php
namespace App\Model;


class DatabaseTablesModel extends BaseModel
{
    protected $tableName = 'td_database_tables';
    protected $fields = 'id,table_schema, table_name, table_comment, engine, version, row_format, table_rows, data_length, index_length, auto_increment, table_collation, create_time, update_time';

    //data_length
    protected function getDataLengthAttr($value, $data)
    {
        return empty($value) ? 0 : round($value/1024/1024,2);
    }
    //index_length
    protected function getIndexLengthAttr($value, $data)
    {
        return empty($value) ? 0 : round($value/1024/1024,2);
    }

}