<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Entreprise;
use App\Interlocuteur;
use App\Action;
use App\Groupe;
use App\Contact;

class OldDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filieres')->insert(['metier' => 'Developpement']);
        DB::table('filieres')->insert(['metier' => 'Production / Exploitation / Maintenance']);
        DB::table('filieres')->insert(['metier' => 'Système / Réseau / Données']);
        DB::table('filieres')->insert(['metier' => 'Assistance']);
        DB::table('activites')->insert(['libelle' => 'Assistance']);
        DB::table('activites')->insert(['libelle' => 'ESN/Conseil']);
        DB::table('activites')->insert(['libelle' => 'Fabricant']);
        DB::table('activites')->insert(['libelle' => 'Editeur Logiciel']);
        DB::table('activites')->insert(['libelle' => 'DataCenter']);
        DB::table('activites')->insert(['libelle' => 'Magasin / Réparateur']);
        DB::table('activites')->insert(['libelle' => 'Entreprise Publique/Collectivité Locale']);
        DB::table('activites')->insert(['libelle' => 'PME/PMI']);
        DB::table('activites')->insert(['libelle' => 'TPE']);
    }
}
