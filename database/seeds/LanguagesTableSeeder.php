<?php

use Illuminate\Database\Seeder;

use App\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'language' => 'Português',
            'languageCode' => 'pt',
        ]);
        Language::create([
            'language' => 'English',
            'languageCode' => 'en',
        ]);
        Language::create([
            'language' => 'Español',
            'languageCode' => 'es',
        ]);
    }
}
