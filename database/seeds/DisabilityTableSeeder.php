<?php

use Illuminate\Database\Seeder;

class DisabilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disabilities')->insert([
            'id' => '1',
            'name' => "Alzheimer's/Dementia",
        ]);
        DB::table('disabilities')->insert([
            'id' => '2',
            'name' => "Autism/Asperger Syndrome",
        ]);
        DB::table('disabilities')->insert([
            'id' => '3',
            'name' => "Bipolar Disorder",
        ]);
        DB::table('disabilities')->insert([
            'id' => '4',
            'name' => "Cerebral Palsy",
        ]);
        DB::table('disabilities')->insert([
            'id' => '5',
            'name' => "Developerment Disability",
        ]);
        DB::table('disabilities')->insert([
            'id' => '6',
            'name' => "Diabetes",
        ]);
        DB::table('disabilities')->insert([
            'id' => '7',
            'name' => "Down Syndrome",
        ]);
        DB::table('disabilities')->insert([
            'id' => '8',
            'name' => "Emotional Distrubance",
        ]);
        DB::table('disabilities')->insert([
            'id' => '9',
            'name' => "Epilepsy",
        ]);
        DB::table('disabilities')->insert([
            'id' => '10',
            'name' => "Hearing Impairment",
        ]);
        DB::table('disabilities')->insert([
            'id' => '11',
            'name' => "Oppositional Defiant Disorder",
        ]);
        DB::table('disabilities')->insert([
            'id' => '12',
            'name' => "Schizophrenia",
        ]);
        DB::table('disabilities')->insert([
            'id' => '13',
            'name' => "Seizure Disorder",
        ]);
        DB::table('disabilities')->insert([
            'id' => '14',
            'name' => "Visual Impairment",
        ]);
        DB::table('disabilities')->insert([
            'id' => '15',
            'name' => "Post Stroke",
        ]);
        DB::table('disabilities')->insert([
            'id' => '16',
            'name' => "Parkinson's",
        ]);

    }
}