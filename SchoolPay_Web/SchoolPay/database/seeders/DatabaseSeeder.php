<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Account;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Discipline;
use App\Models\Payment;
use App\Models\PaymentConfig;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        for($i=0; $i<10; $i++){
            $start = 2015 + $i;
            $end = $start + 1;
            AcademicYear::factory()->create([
                'period' => "$start - $end"
            ]);
        }

        Bank::factory()->create([
            'name' => 'MTN-MoMo',
        ]);

        $schoolCat = Category::factory()->create(['name' => 'school']);
        $studentCat = Category::factory()->create(['name' => 'student']);

        $enspd_user = User::factory()->create([
            'username' => 'ENSPD',
            'name' => 'Ecole Nationale Supérieure Polytechnique de Douala',
            'email' => 'enspd@udo.com',
            'category_id' => $schoolCat->id
        ]);

        $enspd = School::factory()->create([
            'user_id' => $enspd_user->id
        ]);

        $account = Account::factory()->create([
            'school_id' => $enspd->id,
        ]);

        $enspd->update([
            'account_id' => $account->id
        ]);

        Discipline::factory(10)->create([
            'school_id' => $enspd->id,
        ]);

        $git = Discipline::factory()->create([
            'school_id' => $enspd->id,
            'name' => 'Genie Logiciel',
            'slug' => \Str::slug('Genie Logiciel'),
        ]);

        Student::factory()->create([
            'registerNumber' => '21G00804',
            'phoneNumber' => '656656507',
            'user_id' => User::factory()->create([
                'name' => 'NDE TSAPI STEVE-ROLAND',
                'email' => 'sterdevs@gmail.com',
                'username' => 'SterDevs',
                'category_id' => $studentCat->id]
            )->id,
            'discipline_id' => $git->id
        ]);

        for($i=0; $i<300; $i++){
            Student::factory()->create([
                'user_id' => User::factory()->create(['category_id' => $studentCat->id])->id,
                'discipline_id' => Discipline::all()->random()->id
            ]);
        }

        PaymentConfig::factory(30)->create();

        Payment::factory(500)->create();
    }
}
