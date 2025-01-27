<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            [
                'name' => 'ADMIN',
                'login' => 'admin',
                'email' => null,
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'tel' => null,
                'magasin_id' => 1,
                'service_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'JOB OPTIQUE PLATEAU',
                'login' => 'joboptique',
                'email' => null,
                'password' => password_hash('joboptique', PASSWORD_BCRYPT),
                'tel' => 0101010101,
                'magasin_id' => 1,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marcory 1',
                'login' => 'marcory1',
                'email' => null,
                'password' => password_hash('marcory1', PASSWORD_BCRYPT),
                'tel' => 0101010101,
                'magasin_id' => 2,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marcory 2',
                'login' => 'marcory2',
                'email' => null,
                'password' => password_hash('marcory2', PASSWORD_BCRYPT),
                'tel' => 01010101,
                'magasin_id' => 2,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Plateau 1',
                'login' => 'plateau1',
                'email' => null,
                'password' => password_hash('plateau1', PASSWORD_BCRYPT),
                'tel' => 01010101,
                'magasin_id' => 1,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Plateau 2',
                'login' => 'plateau2',
                'email' => null,
                'password' => password_hash('plateau2', PASSWORD_BCRYPT),
                'tel' => 01010101,
                'magasin_id' => 1,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yopougon 1',
                'login' => 'yopougon1',
                'email' => null,
                'password' => password_hash('yopougon1', PASSWORD_BCRYPT),
                'tel' => 0101010101,
                'magasin_id' => 3,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yopougon 2',
                'login' => 'yopougon2',
                'email' => null,
                'password' => password_hash('yopougon2', PASSWORD_BCRYPT),
                'tel' => 01010101,
                'magasin_id' => 3,
                'service_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
