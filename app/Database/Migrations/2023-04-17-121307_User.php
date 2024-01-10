<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'iduser'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'password'       => [
                'type'              => 'VARCHAR',
                'constraint'        => '20',
            ]
        ]);
        $this->forge->addPrimaryKey('iduser');
        $this->forge->createTable('User'); 
    }

    public function down()
    {
        $this->forge->dropTable('User');
    }
}
