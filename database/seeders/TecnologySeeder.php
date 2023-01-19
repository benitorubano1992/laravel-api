<?php

namespace Database\Seeders;

use App\Models\Tecnology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TecnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tecnologies = ['vue', 'javascript', 'laravel', 'php', 'react', 'figma', 'social'];
        foreach ($tecnologies as $name) {
            $newTecno = new Tecnology();
            $newTecno->name = $name;
            $newTecno->slug = Str::slug($name, '-');
            $newTecno->save();
        }
    }
}
