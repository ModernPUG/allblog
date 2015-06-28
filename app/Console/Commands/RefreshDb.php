<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshDb extends Command
{
    protected $name = 'refresh_db';

    protected $description = 'db 테이블을 모두 지운 후 마이그레이션 한다.';

    public function fire()
    {
        Artisan::call('clear_db');
        Artisan::call('migrate');
    }
}
