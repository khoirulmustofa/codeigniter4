<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class UpdateAuthGroups extends BaseCommand
{
    protected $group       = 'Custom Commands';
    protected $name        = 'authgroups:update';
    protected $description = 'Update AuthGroups from database';

    protected $usage = 'command:name [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        // Mendapatkan koneksi database
        $db = \Config\Database::connect();

        // Mendapatkan data dari tabel permissions di database
        $query = $db->table('auth_permissions')->get();

        // Mengisi array $permissions dari hasil query
        $permissions = [];
        foreach ($query->getResult() as $row) {
            $permissions[$row->name] = $row->description ?? "";
        }

        // Path ke file AuthGroups.php
        $filePath = APPPATH . 'Config/AuthGroups.php';

        // Membaca konten file AuthGroups.php
        $fileContent = file_get_contents($filePath);

        // Menghapus bagian yang akan diganti
        $search = "public array \$permissions";
        $startIndex = strpos($fileContent, $search);
        $endIndex = strpos($fileContent, ";", $startIndex) + strlen(";");
        $replace = substr($fileContent, $startIndex, $endIndex - $startIndex);

        // Mengganti konten yang akan diganti dengan data dari database
        $newContent = str_replace($replace, "public array \$permissions = " . var_export($permissions, true) . ";", $fileContent);

        // Menulis konten yang telah diperbarui kembali ke file
        file_put_contents($filePath, $newContent);

        CLI::write('AuthGroups.php telah diperbarui.');
    }
}
