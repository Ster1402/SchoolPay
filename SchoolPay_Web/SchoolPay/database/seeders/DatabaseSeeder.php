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
        AcademicYear::factory(5)->create();

        Bank::factory()->create();

        $schoolCat = Category::factory()->create(['name' => 'school']);
        $studentCat = Category::factory()->create(['name' => 'student']);

        $enspd_user = User::factory()->create([
            'username' => 'ENSPD',
            'name' => 'Ecole Nationale Superieur Polytechnique de Douala',
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

        Student::factory()->create([
            'user_id' => User::factory()->create([
                'name' => 'NDE TSAPI STEVE-ROLAND',
                'email' => 'sterdevs@gmail.com',
                'username' => 'SterDevs',
                'category_id' => $studentCat->id]
            )->id,
            'discipline_id' => Discipline::all()->random()->id
        ]);

        Student::factory(200)->create([
            'user_id' => User::factory()->create(['category_id' => $studentCat->id])->id,
            'discipline_id' => Discipline::all()->random()->id
        ]);

        PaymentConfig::factory(30)->create();

        Payment::factory(400)->create();
    }
}
