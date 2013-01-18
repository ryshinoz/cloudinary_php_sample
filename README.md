# cloudinary_php sample

cloudinary_phpを利用サンプルです

## 環境構築

``` bash
$ git clone git@github.com:ryshinoz/cloudinary_php_sample.git
$ cd cloudinary_php_sample
$ curl -s http://getcomposer.org/installer | php
$ php composer.phar install
```

設定ファイルを用意する

``` bash
$ cp config.ini.orig config.ini
$ vim config.ini
```

Cloudinary Management Consoleにログインして以下を記述する

- Cloud name
- API Key
- API Secret
- Secure URL

``` vim
cloud_name  = 
api_key     = 
api_secret  = 
private_cdn = 
```

環境変数（CLOUDINARY_URL）に設定してもできます。サンプルソースの修正が必要

- Environment variable

```
export CLOUDINARY_URL=
```

## アップロード

単純にアップロードするだけなら、アップロードファイルを指定するだけです。

```php
$result = \Cloudinary\Uploader::upload(__DIR__ . '/data/photo1.jpg');
```

レスポンスは配列で返ってきます。※URL等の文字、数値は適当に変換しています

レスポンスのurlへアクセスするとアップロードされた画像が表示されるはずです。

```php
Array
(
    [public_id] => abcdefghijklmnopqrst
    [version] => 1234567890
    [signature] => abcdefghijklmnopqrstuvwxyz1234567890abcd
    [width] => 1632
    [height] => 1224
    [format] => jpg
    [resource_type] => image
    [bytes] => 413717
    [url] => http://example.com/xxxxxxxxx/image/upload/v1234567890/abcdefghijklmnoprqst.jpg
    [secure_url] => https://example.com/xxxxxxxxx/image/upload/v1234567890/abcdefghijklmnopqrst.jpg
)
```

cloudinary_url()を利用するとURLが取得できます

```php
cloudinary_url('abcdefghijklmnopqrst.jpg');
```

### public_id指定

オプションで指定します

内部で既に画像に対してIDなどある場合、便利です

```php
$result = \Cloudinary\Uploader::upload(__DIR__ . '/data/photo1.jpg',
    array('public_id' => 'sample-1'));
```

### カラー情報取得

オプションで指定してアップロードするとレスポンスにカラー情報が入ります

```php
$result = \Cloudinary\Uploader::upload(__DIR__ . '/data/photo1.jpg',
    array('colors' => true));
```

他のオプションと一緒に指定もできます

```php
$result = \Cloudinary\Uploader::upload(__DIR__ . '/data/photo1.jpg',
    array('public_id' => 'sample-2', 'colors' => true));
```

### EXIF情報削除

回転情報通りに画像を回転してからEXIF情報を削除して保存できます

```php
$result = \Cloudinary\Uploader::upload(__DIR__ . '/data/photo2.jpg', 
    array('angle' => 'exif'));
```

カラー情報同様、他のオプションと同時に指定もできます

```php
$result = \Cloudinary\Uploader::upload(__DIR__ . '/data/photo2.jpg',
    array('public_id' => 'sample-3', 'angle' => 'exif'));
```

> URLにa_exifをつけることで画像取得時に同様の事ができるみたいです

http://cloudinary.com/blog/api_for_extracting_semantic_image_data_colors_faces_exif_data_and_more

### おまけ

OSXでEXIF情報見るにはプレビューでツール -> インスペクタを表示

## Links

- [Cloudinary](http://cloudinary.com/)
- [cloudinary_php](https://github.com/cloudinary/cloudinary_php)
