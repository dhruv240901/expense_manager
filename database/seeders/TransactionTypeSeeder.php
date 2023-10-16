<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionType;
class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactiontype = [
            ['name' => 'income'],
            ['name' => 'expense'],
            ['name' => 'transfer'],
        ];

        TransactionType::insert($transactiontype);
    }
}
