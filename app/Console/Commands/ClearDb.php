<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Schema;

class ClearDb extends Command
{
    protected $name = 'clear_db';

    protected $description = 'db 테이블을 모두 지운다.';

    public function fire()
    {
        $tables = DB::select('SHOW TABLES');

        foreach($tables as $table)
        {
            $key = key($table);
            Schema::drop($table->$key);
        }
    }
}
