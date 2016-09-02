<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
  {

    // App\User::create(['first_name' => 'Bob', 'last_name' => 'Brown', 'email' => 'test@example.com', 'password' => 'password']);

    // App\User::create(['first_name' => 'Jane', 'last_name' => 'Doe', 'email' => 'test2@example.com', 'password' => 'password']);

    // App\User::create(['first_name' => 'Spongebob', 'last_name' => 'Squarepants', 'email' => 'test3@example.com', 'password' => 'password']);

    // App\User::create(['first_name' => 'Bilbo', 'last_name' => 'Baggins', 'email' => 'test4@example.com', 'password' => 'password']);

    // App\Group::create(['name' => 'The Shire', 'user_id' => 4]);

    // App\Membership::create(['user_id' => 1, 'group_id' => 1, 'role' => 'admin']);

    // App\Membership::create(['user_id' => 2, 'group_id' => 1, 'role' => 'member']);

    // App\Membership::create(['user_id' => 3, 'group_id' => 1, 'role' => 'member']);

    // App\Membership::create(['user_id' => 4, 'group_id' => 1, 'role' => 'member']);

    // App\Expense::create(['name' => 'Silver spoons', 'creator_id' => 1, 'lender_id' => 1]);

    App\ExpenseFraction::create(['expense_id' => 1, 'borrower_id' => 2, 'amount_owed_cents' => 1000]);

    App\ExpenseFraction::create(['expense_id' => 1, 'borrower_id' => 3, 'amount_owed_cents' => 1000]);

    App\ExpenseFraction::create(['expense_id' => 1, 'borrower_id' => 4, 'amount_owed_cents' => 1000]);
  }
}
