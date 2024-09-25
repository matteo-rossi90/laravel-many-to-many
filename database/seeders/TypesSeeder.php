<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Functions\Helper;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "Sito Web Statico",
            "Single Page Application (SPA)",
            "RESTful API",
            "E-commerce",
            "Blog/CMS (Content Management System)",
            "Forum/Community",
            "Dashboard Analitico",
            "Sistema di Autenticazione",
            "Microservizi",
            "Real-time Applications",
            "Progressive Web App (PWA)",
            "Social Media Integration",
            "Server-Side Rendering (SSR)",
            "Testing e CI/CD",
            "Progetto Open Source"
        ];

        foreach($data as $type){
            $new_type = new Type();
            $new_type->name = $type;
            $new_type->slug = Helper::generateSlug($new_type->name, Type::class);
            $new_type->save();

        }
    }
}
