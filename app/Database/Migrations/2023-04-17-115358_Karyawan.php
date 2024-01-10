<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_karyawan'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'jenis_kelamin'       => [
                'type'              => 'ENUM',
                'constraint'        => "'pria','wanita'",
            ],
            'no_telp' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'tanggal_lahir' => [
                'type'           => 'DATE'
            ],
            'alamat' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id_karyawan');
        $this->forge->createTable('karyawan'); 
    }

    public function down()
    {
        $this->forge->dropTable('karyawan');
    }
}
