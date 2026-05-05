<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Deal;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    public function run(): void
    {
       $user = User::factory()->create([
            'name' => 'Vitalii',
            'email' => 'vitalii@web.com',
            'password' => bcrypt('Vitalii'),
        ]);

        \App\Models\Contact::factory(100)
            ->state([
                'user_id' => $user->id
            ])
            ->create()
            ->each(function ($contact) {
                \App\Models\Deal::factory(rand(1, 5))
                    ->state([
                        'contact_id' => $contact->id,
                    ])
                    ->create();
            });
    }
}
