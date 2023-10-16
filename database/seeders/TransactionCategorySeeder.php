<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionCategory;
class TransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactioncategory = [
            ['name' => 'cash'],
            ['name' => 'cheque'],
            ['name' => 'Online Payment'],
        ];

        TransactionCategory::insert($transactioncategory);
    }
}
