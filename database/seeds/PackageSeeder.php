<?php

use App\Model\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            [
                'name' => 'Basic',
                'slug' => 'basic',
                'price' => 2000
            ],
            [
                'name' => 'Model',
                'slug' => 'model',
                'price' => 3000
            ],
            [
                'name' => 'Complete',
                'slug' => 'complete',
                'price' => 4000
            ]
        ];

        foreach ($packages as $key => $package){
            Package::create([
                'name' => $package['name'],
                'slug' => $package['slug'],
                'price' => $package['price']
            ]);
        }
    }
}
