<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('mobil', 'Mobil::index');
$routes->get('mobil/tambah_mobil', 'Mobil::tambah_mobil');
$routes->post('mobil/simpan_mobil', 'Mobil::aksi_tambah_mobil');
$routes->post('mobil/update/(:num)', 'Mobil::update_mobil/$1');
$routes->get('mobil/edit_mobil/(:num)', 'Mobil::edit_mobil/$1');
$routes->get('mobil/dihapus_mobil', 'Mobil::dihapus_mobil');
$routes->get('mobil/delete_mobil/(:num)', 'Mobil::delete_mobil/$1');
$routes->get('mobil/restore_mobil/(:num)', 'Mobil::restore_mobil/$1');
$routes->get('mobil/hapus_mobil/(:num)', 'Mobil::hapus_mobil/$1');
$routes->get('mobil/detail_mobil/(:num)', 'Mobil::detail_mobil/$1');

$routes->get('penjualan', 'Penjualan::index');
$routes->get('penjualan/tambah_penjualan', 'Penjualan::tambah_penjualan');
$routes->post('penjualan/simpan_penjualan', 'Penjualan::aksi_tambah_penjualan');
$routes->post('penjualan/update/(:num)', 'Penjualan::update_penjualan/$1');
$routes->get('penjualan/edit_penjualan/(:num)', 'penjualan::edit_penjualan/$1');
$routes->get('penjualan/dihapus_penjualan', 'penjualan::dihapus_penjualan');
$routes->get('penjualan/delete_penjualan/(:num)', 'penjualan::delete_penjualan/$1');
$routes->get('penjualan/restore_penjualan/(:num)', 'penjualan::restore_penjualan/$1');
$routes->get('penjualan/hapus_penjualan/(:num)', 'penjualan::hapus_penjualan/$1');
$routes->get('penjualan/detail_penjualan/(:num)', 'penjualan::detail_penjualan/$1');
 
$routes->get('pelanggan', 'Pelanggan::index');
$routes->get('pelanggan/tambah_pelanggan', 'Pelanggan::tambah_pelanggan');
$routes->post('pelanggan/simpan_pelanggan', 'Pelanggan::aksi_tambah_pelanggan');
$routes->post('pelanggan/update/(:num)', 'pelanggan::update_pelanggan/$1');
$routes->get('pelanggan/edit_pelanggan/(:num)', 'pelanggan::edit_pelanggan/$1');
$routes->get('pelanggan/dihapus_pelanggan', 'pelanggan::dihapus_pelanggan');
$routes->get('pelanggan/delete_pelanggan/(:num)', 'pelanggan::delete_pelanggan/$1');
$routes->get('pelanggan/restore_pelanggan/(:num)', 'pelanggan::restore_pelanggan/$1');
$routes->get('pelanggan/hapus_pelanggan/(:num)', 'pelanggan::hapus_pelanggan/$1');
$routes->get('pelanggan/detail_pelanggan/(:num)', 'pelanggan::detail_pelanggan/$1');

$routes->get('/', 'Home::index');
$routes->get('/newsletter', 'Home::newsletter');
$routes->get('/contact', 'Home::contact');
$routes->get('Admin', 'Admin::index');
$routes->get('Katalog', 'Katalog::index'); 
$routes->get('/login', 'Login::index');
$routes->post('login/aksi_login', 'Login::aksi_login');
$routes->get('login/logout', 'Login::logout');

