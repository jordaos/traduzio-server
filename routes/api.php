<?php

use Illuminate\Http\Request;
use App\Language;
use App\Phrase;

Route::get('languages', function() {
    return Language::all();
});

Route::prefix('phrases')->group(function () {
    Route::get('/', function() {
        return Phrase::all();
    });

    Route::get('/check-translation', function(Request $request) {
        $originLanguageCode = $request->input('originLanguage');
        $requiredLanguageCode = $request->input('requiredLanguage');
        $text = $request->input('text');

        $originPhrase = Phrase::where([
            ['text', $text], 
            ['language_id', Language::where('languageCode', $originLanguageCode)->first()->id]
        ])->first();

        $translatedPhrase = $originPhrase->translations()->where('language_id', Language::where('languageCode', $requiredLanguageCode)->first()->id)->first();
        if(is_null($translatedPhrase)) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }
        return $translatedPhrase;
    });

    Route::get('/{id}', function($id) {
        $phrase = Phrase::find($id);
        return $phrase;
    })->where('id', '[0-9]+');

    Route::post('/translate', function(Request $request) {
        $phrase = new Phrase();
        $phrase->fill($request->input('phrase'));
        $phrase->save();

        $idOriginalPhrase = $request->input('idOriginalPhrase');
        $originalPhrase = Phrase::find($idOriginalPhrase);
        
        foreach($originalPhrase->translations()->get() as $translationPhrase) {
            $phrase->translations()->attach($translationPhrase);
            $translationPhrase->translations()->attach($phrase);
        }

        $phrase->translations()->attach($originalPhrase);
        $originalPhrase->translations()->attach($phrase);

        //$originalPhrase->translations()->sync([$phrase->id => ['count' => 3]]);

        return $phrase;
    });

    Route::post('/classify', function(Request $request) {
        $phrase = Phrase::find($request->input('phrase')->id);
        $isCorrect = $request->input('isCorrect');
    });
});