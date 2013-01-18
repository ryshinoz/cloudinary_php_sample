<?php

require_once __DIR__ . '/vendor/autoload.php';

$configs = parse_ini_file(__DIR__ . '/config.ini');

$prefix = 'sample';
$timestamp = time();

// 環境変数（CLOUDINARY_URL）を利用する場合は、$confisを引数で渡さない
\Cloudinary::config($configs);

// ファイルをアップロードする
$result = \Cloudinary\Uploader::upload(__DIR__ . '/data/photo1.jpg');
print_r($result);

// public_idを指定したアップロードする
$result = \Cloudinary\Uploader::upload(__DIR__ . '/data/photo1.jpg',
    array('public_id' => sprintf('%s_%s-1', $prefix, $timestamp)));
print_r($result);

// カラー情報取得する
$result = \Cloudinary\Uploader::upload(__DIR__ . '/data/photo1.jpg',
    array('public_id' => sprintf('%s_%s-2', $prefix, $timestamp), 'colors' => true));
print_r($result);

// EXIF情報削除
$result = \Cloudinary\Uploader::upload(__DIR__ . '/data/photo1.jpg',
    array('public_id' => sprintf('%s_%s-3', $prefix, $timestamp), 'angle' => 'exif'));
print_r($result);
