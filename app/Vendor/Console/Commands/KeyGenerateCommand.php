<?php

namespace App\Vendor\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;

class KeyGenerateCommand extends Command
{
    protected $name = 'key:generate';

    protected $signature = 'key:generate {--show : Display the key and do not modify the file}';

    protected $description = 'Set the application key';

    public function handle()
    {
        $key = $this->generateRandomKey();

        if($this->option('show')) {
            $this->comment($key);
            exit();
        }
        $this->updateFile($key);
        $this->info("Application key [$key] set successfully.");
    }

    private function updateFile(string $key): void
    {
        $path = base_path('.env');
        if(!file_exists($path)) {
            return;
        }

        $dir_separator = PHP_EOL;
        preg_match("/(APP_KEY=)(\s|.*){$dir_separator}/", file_get_contents($path), $matches);
        if(isset($matches[2]) && $matches[2] != '') {
            return;
        }

        file_put_contents(
            $path,
            preg_replace("/(APP_KEY=)(\s|.*){$dir_separator}/", "APP_KEY={$key}{$dir_separator}", file_get_contents($path))
        );
    }

    protected function generateRandomKey(): string
    {
        return 'base64:' . base64_encode(Str::random(32));
    }
}