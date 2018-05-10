<?php

use Illuminate\Database\Seeder;
use App\Phrase;
use App\Language;

class PhrasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Phrase::create([
            'text' => 'I love you',
            'language_id' => (Language::where('languageCode', 'en')->first())->id,
        ]);

        Phrase::create([
            'text' => 'Eu te amo',
            'language_id' => (Language::where('languageCode', 'pt')->first())->id,
        ]);
    }
}
