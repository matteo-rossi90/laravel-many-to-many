<?php

namespace App\Functions;

use Illuminate\Support\Str;


class Helper{

    //inserire la funzione per generare lo slug e renderla più automatizzata e generica
    public static function generateSlug($string, $model){

        $slug = Str::slug($string, '-');
        $original_slug = $slug;
        // se trovo uno slug esistente $exists non sarà null
        $exists = $model::where('slug', $slug)->first();
        // inizializzo un contatore
        $c = 1;
        // ciclo fino a quando exists non diventa null
        // questo ciclo partirà solo se lo slug è presnte
        while ($exists) {
            $slug = $original_slug . '-' . $c;
            $exists = $model::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }
}
