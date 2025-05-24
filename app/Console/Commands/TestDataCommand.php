<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestDataCommand extends Command
{
    protected $signature = 'madk';

    protected $description = 'Command description';

    public function handle(): int
    {
        $this->info('⏳ Обновление базы данных...');
        $this->call('migrate:refresh');

        $this->info('📦 Наполнение тестовыми данными...');
        $this->call('db:seed');

        $this->info('✅ Готово!');
        return Command::SUCCESS;
    }

}
