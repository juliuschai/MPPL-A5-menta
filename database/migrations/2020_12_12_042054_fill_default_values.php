<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FillDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([]);
        DB::unprepared("INSERT INTO `users` (`id`, `name`, `email`, `phone_num`, `verified_at`, `verification_code`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
        (1, 'wasd', 'wasd@wasd.com', '123123', NULL, '914884', 'patient', '$2y$10\$ArTQlVaVB8L9APMlgWtq8uEGlYcBndlS5EBRWLYWfvKT1NMQn36fi', 'PPmDdKtRxx3QD8V0OX434QQvVQIE0JMRxHaQjSFa7ipqP9UmyYGJzbCuBSxt', '2020-12-09 10:05:59', '2020-12-09 10:17:25'),
        (2, 'wasd2', 'wasd2@wasd2.com', '12341234', '2020-12-11 07:48:20', '608667', 'therapist', '$2y$10\$Mh4lM/99vyhzwpuEbu8wVOG2Hfk1ztzG9JMg/igqB4XHIbBfwUWDm', 'H8gOo2sZ1QDzYLzeGNexwwbxlzVvPj5PGlqlbT84mG88DGUQv22tFSlwhO8s', '2020-12-10 05:33:47', '2020-12-11 07:48:20'),
        (3, 'wasd3', 'wasd3@wasd3.com', '123123', '2020-12-09 10:28:51', '545667', 'admin', '$2y$10\$eVsXD/5W/oMsa3UVhf3oceTVBNX7N8UXKOjNpkfNNmnc3D/FfHkBS', 'EkV3JYPckBp7FZQ9ITb3m6Wv9Gsx6nEaNNSuMKpjAzokUXjHAm94bUbAZB7f', '2020-12-09 10:28:33', '2020-12-09 10:28:51')");

        DB::table('therapists')->insert([
            'verified_at' => '2020-12-10 14:04:41',
            'user_id' => 2,
            'document_file' => 'document/kTKvRcPUceo4JLFElV9KDydPHJN65rYv4LOV0lrX.png',
            'created_at' => '2020-12-10 05:33:47',
            'updated_at' => '2020-12-10 05:33:47'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
