<?php
$this->breadcrumbs = [
    'Help' => ['/m1/help'],
];

$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/help']],
];
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-user"></i>
        Create User
    </h1>
</div>

<p>Halaman ini digunakan untuk menambah data user baru. Halaman ini terdiri dari beberapa bagian yaitu
<ul>
    <li>Kolom kiri berisi form create user. Form ini terdiri dari input
        <ul>
            <li>Module Name, nama modul yang dapat diakses setelah registrasi</li>
            <li>Email, alamat email user</li>
            <li>Status, status registrasi user</li>
            <li>Button Create, klik button ini untuk menyimpan data user baru</li>
        </ul>
    </li>
    <li><p>Kolom kanan berisi
        <ul>
            <li>Home, link ke daftar user pelamar</li>
        </ul>
    </li>
</ul>
<BR>
<img src="/images/man/sUserRegistration_create.jpg">