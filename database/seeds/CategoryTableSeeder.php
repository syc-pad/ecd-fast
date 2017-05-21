<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = "Informatique";
        $category->save();
        
        $category = new Category();
        $category->name = "Assurance";
        $category->save();
        
        $category = new Category();
        $category->name = "Industrie";
        $category->save();
    }
}
