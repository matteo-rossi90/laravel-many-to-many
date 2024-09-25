<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 30; $i++) {

            //per ogni ciclo estrarre un progetto random
            $project = Project::inRandomOrder()->first();

            //estrarre l'id random della tecnologia

            $technology_id = Technology::inRandomOrder()->first();

            //inserire una nuova relazione

            $project->technologies()->attach($technology_id);
        }
    }
}
