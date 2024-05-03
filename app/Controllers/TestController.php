<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TestController extends BaseController
{

    function index()
    {
        // $user = auth()->user();
        // $user->addGroup('base_user');
        // echo "succes";

        // $user = auth()->user();
        // $user->removeGroup('base_user');


        if (auth()->user()->can('menu.dashboard')) {
            echo "Yes";
        } else {
            echo "No";
        }
    }
    public function permissionToGroup()
    {

        // Mendapatkan koneksi database
        $db = \Config\Database::connect();

        // Mendapatkan data dari tabel group dan permissions di database
        $groups = $db->table('auth_groups')->get()->getResultArray();


        // Membuat konten yang akan diganti dalam file AuthGroups.php
        $newMatrix = [];
        foreach ($groups as $group) {
            $newMatrix[$group['group']] = [];

            $permissions = $db->table('auth_groups_permissions')->where("group", $group['group'])->get()->getResultArray();


            foreach ($permissions as $permission) {

                $newMatrix[$group['group']][] = $permission['permission'];
            }
        }

        // Path ke file AuthGroups.php
        $filePath = APPPATH . 'Config/AuthGroups.php';

        // Membaca konten file AuthGroups.php
        $fileContent = file_get_contents($filePath);

        // Menemukan bagian yang akan diganti
        $search = "public array \$matrix";
        $startIndex = strpos($fileContent, $search);
        $endIndex = strpos($fileContent, ";", $startIndex) + strlen(";");

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

    public  function group()
    {
        // Mendapatkan koneksi database
        $db = \Config\Database::connect();

        // Mendapatkan data dari tabel auth_groups di database
        $groups = $db->table('auth_groups')->get()->getResultArray();

        // Membuat konten yang akan diganti dalam file AuthGroups.php
        $newGroups = [];
        foreach ($groups as $group) {
            $newGroups[$group['group']] = [
                'title'       => $group['title'],
                'description' => $group['description'] ?? ""
            ];
        }

        // Path ke file AuthGroups.php
        $filePath = APPPATH . 'Config\AuthGroups.php';

        // Membaca konten file AuthGroups.php
        $fileContent = file_get_contents($filePath);

        // Menemukan bagian yang akan diganti
        $search = "public array \$groups";
        $startIndex = strpos($fileContent, $search);
        $endIndex = strpos($fileContent, ";", $startIndex) + strlen(";");

        // Mengganti konten yang akan diganti dengan data dari database
        $replace = substr($fileContent, $startIndex, $endIndex - $startIndex);
        $newContent = str_replace($replace, "public array \$groups = " . var_export($newGroups, true) . ";", $fileContent);

        // Menulis konten yang telah diperbarui kembali ke file
        file_put_contents($filePath, $newContent);

        echo 'AuthGroups.php telah diperbarui.';
    }
}
