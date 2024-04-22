<?php
namespace App\Model;


class DatabaseTablesColumnModel extends BaseModel
{
    protected $tableName = 'td_database_tables_column';
    protected $fields = 'id, table_id, column_name, column_type, data_type, numeric_precision, character_maximum_length, numeric_scale, is_nullable, column_default, extra, column_key, column_comment, create_time, update_time';


}