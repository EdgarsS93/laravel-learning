<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobListings = include database_path('seeders/data/job_listings.php');

        $testUserId = User::where('email', 'test@test.com')->value('id');

        $userIds = User::where('email', '!=', 'test@test/com')
            ->pluck('id')->toArray();

        foreach ($jobListings as $index => &$jobListing) {
            if($index < 2) {
                $jobListing['user_id'] = $testUserId;
            } else {
                $jobListing['user_id'] = $userIds[array_rand($userIds)];
            }

            $jobListing['created_at'] = now();
            $jobListing['updated_at'] = now();
        }
        unset($jobListing);

        DB::table('job_listings')->insert($jobListings);
        echo 'Jobs created successfully';
    }
}
