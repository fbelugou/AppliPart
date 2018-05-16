<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Entreprise;
use App\Interlocuteur;
use App\Action;
use App\Groupe;
use App\Contact;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Entreprise::class, 50)->create();
        factory(Interlocuteur::class, 60)->create();
        factory(Action::class, 100)->create();
        factory(Groupe::class, 20)->create();
        factory(Contact::class, 80)->create();
        factory(Groupe::class, 20)->create();
        DB::table('filieres')->insert(['metier' => 'Developpement']);
        DB::table('filieres')->insert(['metier' => 'Production / Exploitation / Maintenance']);
        DB::table('filieres')->insert(['metier' => 'Système / Réseau / Donnés']);
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

        //--------------------------------------------------------------------------
        //Lien Entreprises Interlocuteurs via Contacts

        $c=1;
        for ($n=1; $n<61 ; $n++) {
            $nb =rand(1,2);
            for ($p=1; $p<=$nb ; $p++) {
                DB::table('contacts')->where('id', $c)->update(['entreprise_id' => rand(1,50),'interlocuteur_id' => $n]);
                $c++;
            }
            $c++;
            if($c>80){
              break;
            }
        }

        //--------------------------------------------------------------------------
        //Lien Entreprises Groupes

        for ($m=1; $m < 51 ; $m++) {
            if(rand(0,1)){
              DB::table('entreprises')->where('id', $m)->update(['groupe_id' => rand(1,20),'siegeSocial'=> rand(0,1)]);
            }
        }

        //--------------------------------------------------------------------------
        //Lien Entreprises Actions avec libelle actions

        for ($k=1;$k<101;$k++){
            $num=rand(1,13);
            switch ($num) {
              case 1:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Stage','entreprise_id' => rand(1,50)]);
                break;
              case 2:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Alternance','entreprise_id' => rand(1,50)]);
                break;
              case 3:
                DB::table('actions')->where('id', $k)->update(['nature' => 'JobDating','entreprise_id' => rand(1,50)]);
                break;
              case 4:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Visite d\'entreprise','entreprise_id' => rand(1,50)]);
                break;
              case 5:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Taxe d\'apprentissage','entreprise_id' => rand(1,50)]);
                break;
              case 6:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Jury d\'examen','entreprise_id' => rand(1,50)]);
                break;
              case 7:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Parrainage','entreprise_id' => rand(1,50)]);
                break;
              case 8:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Intervention technique','entreprise_id' => rand(1,50)]);
                break;
              case 9:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Formation stagiaire','entreprise_id' => rand(1,50)]);
                break;
              case 10:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Formation formateur','entreprise_id' => rand(1,50)]);
                break;
              case 11:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Embauche','entreprise_id' => rand(1,50)]);
                break;
              case 12:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Don de materiel','entreprise_id' => rand(1,50)]);
                break;
              case 13:
                DB::table('actions')->where('id', $k)->update(['nature' => 'Autres','entreprise_id' => rand(1,50)]);
                break;
            }
        }

        //--------------------------------------------------------------------------
        //Lien Entreprises Filieres

        for ($i = 1; $i < 51; $i++) {
            $number = rand(1, 3);
            for ($j = 1; $j <= $number; $j++) {
                DB::table('entreprises_filieres')->insert([
                    'entreprise_id' => $i,
                    'filiere_id' => rand(1,4)
                ]);
            }
        }

        //--------------------------------------------------------------------------
        //Lien Entreprises Activités

        for ($w = 1; $w < 51; $w++) {
            $number = rand(1, 2);
            for ($x = 1; $x <= $number; $x++) {
                DB::table('entreprises_activites')->insert([
                    'entreprise_id' => $w,
                    'activite_id' => rand(1,9)
                ]);
            }
        }
    }
}
