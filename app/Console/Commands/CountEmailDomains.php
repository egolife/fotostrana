<?php

namespace FotoStrana\Console\Commands;

use DB;
use Illuminate\Console\Command;

class CountEmailDomains extends Command
{
    const CHUNK_SIZE = 100000;

    protected $domainUsages = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domains:count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Outputs in console all email domains in use with amount of users for each';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $total_entries = DB::table('users2')->count();
        DB::table('users2')->chunk(self::CHUNK_SIZE, function ($users) use ($total_entries){
            static $chunks_counter = 0;
            $chunks_counter++;

            foreach ($users as $user) {
                $user_domains = $this->getDomainsFromUser($user);
                $this->incrementDomainUsages($user_domains);
            }

            $processed = $chunks_counter * self::CHUNK_SIZE;
            $this->info($processed . ' entries processed, ' . ($total_entries - $processed) . ' remain');
        });

        $this->domainUsages = array_sort($this->domainUsages, function($item){
            return $item;
        });

        $this->info('Domains usage:');
        foreach ($this->domainUsages as $domain => $usages) {
            $this->info('Domain: ' . $domain . ' - ' . $usages . ' usages');
        }
    }

    /**
     * Извлекаем массив почтовых доменов из строки данных пользователя
     *
     * @param $user
     * @return array
     */
    private function getDomainsFromUser($user)
    {
        $domains = [];
        $emails = explode(',', $user->email);

        foreach ($emails as $email) {
            if (!$email) {
                continue;
            }
            $domains [] = substr(stristr($email, '@'), 1);
        }

        return array_unique($domains);
    }

    /**
     * Увеличиваем счетчик использования доменов, добавляем новые
     *
     * @param array $domains
     */
    private function incrementDomainUsages(array $domains)
    {
        foreach ($domains as $domain) {
            if (!array_key_exists($domain, $this->domainUsages)) {
                $this->domainUsages[$domain] = 0;
            }

            $this->domainUsages[$domain]++;
        }
    }
}
