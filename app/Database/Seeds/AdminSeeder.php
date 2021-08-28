<?php namespace App\Database\Seeds;
 
class AdminSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'group_id'  => 3,
            'user_id'      => 50,
        ];
        $this->db->table('auth_groups_users')->insert($data);
    }
} 