<?php

namespace Myth\Auth\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuthTables extends Migration
{
    public function up()
    {
        // Users
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'            => ['type' => 'varchar', 'constraint' => 255],
            'username'         => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'nama_lengkap'     => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'nomor_hp'         => ['type' => 'varchar', 'constraint' => 15, 'null' => false],
            'user_image'       => ['type' => 'varchar', 'constraint' => 255, 'default' => 'default.png'],
            'password_hash'    => ['type' => 'varchar', 'constraint' => 255],
            'reset_hash'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'reset_at'         => ['type' => 'datetime', 'null' => true],
            'reset_expires'    => ['type' => 'datetime', 'null' => true],
            'activate_hash'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status'           => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status_message'   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'active'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'force_pass_reset' => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('username');

        $this->forge->createTable('users', true);

        // Table 'layanan'
        $this->forge->addField([
            'id_layanan'  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_layanan' => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
            'kelas_paket' => ['type' => 'char', 'constraint' => 1, 'null' => false],
            'nominal_perjam' => ['type' => 'int', 'constraint' => 11, 'null' => false],
        ]);
        $this->forge->addKey('id_layanan', true);
        $this->forge->createTable('layanan', true);

        // Table 'ruangan'
        $this->forge->addField([
            'id_ruangan'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nomor_ruangan' => ['type' => 'varchar', 'constraint' => 100, 'null' => false],
            'status'        => ['type' => 'varchar', 'constraint' => 25, 'default' => 'kosong'],
        ]);
        $this->forge->addKey('id_ruangan', true);
        $this->forge->createTable('ruangan', true);

        // Table 'paket'
        $this->forge->addField([
            'id_paket'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_ruangan'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_layanan'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'deskripsi'     => ['type' => 'varchar', 'constraint' => 255, 'null' => false],
        ]);
        $this->forge->addKey('id_paket', true);
        $this->forge->addForeignKey('id_ruangan', 'ruangan', 'id_ruangan', '', 'CASCADE');
        $this->forge->addForeignKey('id_layanan', 'layanan', 'id_layanan', '', 'CASCADE');
        $this->forge->createTable('paket', true);

        // Table 'transaksi'
        $this->forge->addField([
            'id_transaksi'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_user'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_paket'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'id_ruangan'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'tanggal_booking'    => ['type' => 'datetime', 'null' => false],
            'tanggal_checkout'   => ['type' => 'datetime', 'null' => false],
            'total'              => ['type' => 'int', 'constraint' => 11, 'null' => false],
            'total'              => ['type' => 'varchar', 'constraint' => 15, 'null' => false],
        ]);
        $this->forge->addKey('id_transaksi', true);
        $this->forge->addForeignKey('id_user', 'users', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('id_paket', 'paket', 'id_paket', '', 'CASCADE');
        $this->forge->addForeignKey('id_ruangan', 'ruangan', 'id_ruangan', '', 'CASCADE');
        $this->forge->createTable('transaksi', true);

        // Auth Login Attempts
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'email'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'user_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true], // Only for successful logins
            'date'       => ['type' => 'datetime'],
            'success'    => ['type' => 'tinyint', 'constraint' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('email');
        $this->forge->addKey('user_id');
        // NOTE: Do NOT delete the user_id or email when the user is deleted for security audits
        $this->forge->createTable('auth_logins', true);

        /*
         * Auth Tokens
         * @see https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence
         */
        $this->forge->addField([
            'id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'selector'        => ['type' => 'varchar', 'constraint' => 255],
            'hashedValidator' => ['type' => 'varchar', 'constraint' => 255],
            'user_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'expires'         => ['type' => 'datetime'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('selector');
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_tokens', true);

        // Password Reset Table
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'      => ['type' => 'varchar', 'constraint' => 255],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255],
            'user_agent' => ['type' => 'varchar', 'constraint' => 255],
            'token'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_reset_attempts', true);

        // Activation Attempts Table
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ip_address' => ['type' => 'varchar', 'constraint' => 255],
            'user_agent' => ['type' => 'varchar', 'constraint' => 255],
            'token'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_activation_attempts', true);

        // Groups Table
        $fields = [
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'varchar', 'constraint' => 255],
            'description' => ['type' => 'varchar', 'constraint' => 255],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_groups', true);

        // Permissions Table
        $fields = [
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'varchar', 'constraint' => 255],
            'description' => ['type' => 'varchar', 'constraint' => 255],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_permissions', true);

        // Groups/Permissions Table
        $fields = [
            'group_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'permission_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey(['group_id', 'permission_id']);
        $this->forge->addForeignKey('group_id', 'auth_groups', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'auth_permissions', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_groups_permissions', true);

        // Users/Groups Table
        $fields = [
            'group_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'user_id'  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey(['group_id', 'user_id']);
        $this->forge->addForeignKey('group_id', 'auth_groups', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_groups_users', true);

        // Users/Permissions Table
        $fields = [
            'user_id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'permission_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
        ];

        $this->forge->addField($fields);
        $this->forge->addKey(['user_id', 'permission_id']);
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('permission_id', 'auth_permissions', 'id', '', 'CASCADE');
        $this->forge->createTable('auth_users_permissions', true);
    }

    //--------------------------------------------------------------------

    public function down()
    {
        // drop constraints first to prevent errors
        if ($this->db->DBDriver !== 'SQLite3') { // @phpstan-ignore-line
            $this->forge->dropForeignKey('auth_tokens', 'auth_tokens_user_id_foreign');
            $this->forge->dropForeignKey('auth_groups_permissions', 'auth_groups_permissions_group_id_foreign');
            $this->forge->dropForeignKey('auth_groups_permissions', 'auth_groups_permissions_permission_id_foreign');
            $this->forge->dropForeignKey('auth_groups_users', 'auth_groups_users_group_id_foreign');
            $this->forge->dropForeignKey('auth_groups_users', 'auth_groups_users_user_id_foreign');
            $this->forge->dropForeignKey('auth_users_permissions', 'auth_users_permissions_user_id_foreign');
            $this->forge->dropForeignKey('auth_users_permissions', 'auth_users_permissions_permission_id_foreign');
        }

        $this->forge->dropTable('users', true);
        $this->forge->dropTable('auth_logins', true);
        $this->forge->dropTable('auth_tokens', true);
        $this->forge->dropTable('auth_reset_attempts', true);
        $this->forge->dropTable('auth_activation_attempts', true);
        $this->forge->dropTable('auth_groups', true);
        $this->forge->dropTable('auth_permissions', true);
        $this->forge->dropTable('auth_groups_permissions', true);
        $this->forge->dropTable('auth_groups_users', true);
        $this->forge->dropTable('auth_users_permissions', true);
    }
}
