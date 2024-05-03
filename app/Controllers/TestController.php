<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TestController extends BaseController
{

    function index()
    {
        $faker = \Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $isi = $faker->word;
            $data[] = [
                'permission' => strtolower($isi),
                'description' => $isi
            ];
        }
        
       dd($data);
    }
    public function permissionToGroup()
    {


        // Mendapatkan koneksi database
        $db = \Config\Database::connect();

        // Mendapatkan data dari tabel group dan permissions di database
        $groups = $db->table('groups')->get()->getResultArray();
        $permissions = $db->table('permissions')->get()->getResultArray();

        // Membuat konten yang akan diganti dalam file AuthGroups.php
        $newMatrix = [];
        foreach ($groups as $group) {
            $newMatrix[$group['group_name']] = [];
            foreach ($permissions as $permission) {
                if ($permission['group_id'] == $group['id']) {
                    $newMatrix[$group['group_name']][] = $permission['permission_name'];
                }
            }
        }

        // Path ke file AuthGroups.php
        $filePath = APPPATH . 'Config/AuthGroups.php';

        // Membaca konten file AuthGroups.php
        $fileContent = file_get_contents($filePath);

        // Menemukan bagian yang akan diganti
        $search = "public array \$matrix = [";
        $startIndex = strpos($fileContent, $search);
        $endIndex = strpos($fileContent, "];", $startIndex) + strlen("];");

        // Mengganti konten yang akan diganti dengan data dari database
        $replace = substr($fileContent, $startIndex, $endIndex - $startIndex);
        $newContent = str_replace($replace, "public array \$matrix = " . var_export($newMatrix, true) . ";", $fileContent);

        // Menulis konten yang telah diperbarui kembali ke file
        file_put_contents($filePath, $newContent);

        echo "Maps permissions to groups";
    }

    public  function permission()
    {
        // Mendapatkan koneksi database
        $db = \Config\Database::connect();

        // Mendapatkan data dari tabel permissions di database
        $query = $db->table('auth_permissions')->get();

        // Mengisi array $permissions dari hasil query
        $permissions = [];
        foreach ($query->getResult() as $row) {
            $permissions[$row->permission] = $row->description ?? "";
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

        echo "Success";
    }
}
