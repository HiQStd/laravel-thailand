### แพคเกจตำบล, อำเภอ, จังหวัด และรหัสไปรษณีย์สำหรับ Laravel Framework
---
[![Latest Stable Version](https://poser.pugx.org/baraear/laravel-thailand/v/stable)](https://packagist.org/packages/baraear/laravel-thailand)
[![Build Status](https://travis-ci.org/baraear/laravel-thailand.svg?branch=master)](https://travis-ci.org/baraear/laravel-thailand)
[![StyleCI](https://styleci.io/repos/120746847/shield?style=flat&branch=master)](https://styleci.io/repos/120746847)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/baraear/laravel-thailand/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/baraear/laravel-thailand/?branch=master)
[![Total Downloads](https://poser.pugx.org/baraear/laravel-thailand/downloads)](https://packagist.org/packages/baraear/laravel-thailand)
[![GitHub license](https://img.shields.io/github/license/baraear/laravel-thailand.svg)](https://github.com/baraear/laravel-thailand/blob/master/LICENSE)

แพคเกจนี้จะช่วยให้นักพัฒนาที่ใช้ Laravel Framework ในการพัฒนาสามารถจัดเก็บข้อมูลที่อยู่ได้ง่ายขึ้น

### การติดตั้ง
1. ติดตั้งแพคเกจ `baraear/laravel-thailand` ผ่านทาง Composer
    ```sh
    composer require baraear/laravel-thailand
    ```
2. ทำการเพิ่ม Service Provider ของแพคเกจใน `config/app.php`
    ```php
    /*
     * Package Service Providers...
     */
    Baraear\ThaiAddress\ThaiAddressServiceProvider::class,
    ```
3. ประกาศใช้งานไฟล์ config ของแพคเกจ
    ```sh
    php artisan vendor:publish --provider="Baraear\ThaiAddress\ThaiAddressServiceProvider" --tag="config"
    ```
4. ประกาศใช้งานไฟล์ migration ของแพคเกจ
    ```sh
    php artisan vendor:publish --provider="Baraear\ThaiAddress\ThaiAddressServiceProvider" --tag="migrations"
    php artisan migrate
    ```
5. ประกาศใช้งานไฟล์ seeds ของแพคเกจ
    ```sh
    php artisan vendor:publish --provider="Baraear\ThaiAddress\ThaiAddressServiceProvider" --tag="seeds"
    composer dump-autoload
    ```
6. เพิ่มข้อมูลตำบล, อำเภอ, จังหวัด และรหัสไปรษณีย์ลงฐานข้อมูล แก้ไขไฟล์ `database/seeds/DatabaseSeeder.php` ดังนี้
    ```php
    <?php

    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
             $this->call(ThaiAddressTablesSeeder::class);
        }
    }
    ```
    ```sh
    php artisan db:seed
    ```
    
### การใช้งาน
หลังจากทำการเพิ่มข้อมูลแล้วโดยปกติผู้ใช้สามารถใช้งานผ่านทาง Models ที่ทางแพคเกจจัดทำไว้ให้ได้เลย ซึ่งมีดังต่อไปนี้ `SubDistrict`, `District`, `Province` และ `PostalCode`

##### ตำบล
```php
// ข้อมูลทุกตำบล
$sub_districts = SubDistrict::all();

foreach ($sub_districts as $sub_district) {
    // แสดงข้อมูลตำบล
    print_r($sub_district);
    
    // แสดงข้อมูลอำเภอที่มีความสัมพันธ์กับตำบลนี้
    print_r($sub_district->district);
    
    // แสดงข้อมูลรหัสไปรษณีย์ที่มีความสัมพันธ์กับตำบลนี้
    print_r($sub_district->postal_code);
}
```
##### อำเภอ
```php
// ข้อมูลทุกอำเภอ
$districts = District::all();

foreach ($districts as $district) {
    // แสดงข้อมูลอำเภอ
    print_r($district);
    
    // แสดงข้อมูลตำบลที่มีความสัมพันธ์กับอำเภอนี้
    print_r($district->sub_districts);
    
    // แสดงข้อมูลจังหวัดที่มีความสัมพันธ์กับอำเภอนี้
    print_r($district->province);
    
    // แสดงข้อมูลรหัสไปรษณีย์ที่มีความสัมพันธ์กับอำเภอนี้
    print_r($district->postal_codes);
}
```
##### จังหวัด
```php
// ข้อมูลทุกจังหวัด
$provinces = Province::all();

foreach ($provinces as $province) {
    // แสดงข้อมูลจังหวัด
    print_r($province);
    
    // แสดงข้อมูลอำเภอที่มีความสัมพันธ์กับจังหวัดนี้
    print_r($province->districts);
    
    // แสดงข้อมูลรหัสไปรษณีย์ที่มีความสัมพันธ์กับจังหวัดนี้
    print_r($province->postal_codes);
}
```
##### รหัสไปรษณีย์
```php
// ข้อมูลรหัสไปรษณีย์ทั้งหมด
$postal_codes = PostalCode::all();

foreach ($postal_codes as $postal_code) {
    // แสดงข้อมูลรหัสไปรษณีย์
    print_r($postal_code);
    
    // แสดงข้อมูลตำบลที่มีความสัมพันธ์กับรหัสไปรษณีย์นี้
    print_r($postal_code->sub_district);
    
    // แสดงข้อมูลอำเภอที่มีความสัมพันธ์กับรหัสไปรษณีย์นี้
    print_r($postal_code->district);
    
    // แสดงข้อมูลจังหวัดที่มีความสัมพันธ์กับรหัสไปรษณีย์นี้
    print_r($postal_code->province);
}
```
ซึ่งหากผู้ใช้ไม่ต้องการใช้งานผ่าน Models ที่แพคเกจจัดทำไว้ผู้ใช้สามารถสร้าง Model ใหม่โดยจำเป็นต้องทำการ implements ด้วย Contract ที่ทางแพคเกจเตรียมไว้ให้และจำเป็นต้องแก้ไข models ในไฟล์ `config/thai_address.php` ให้ตรงกันด้วย
```php
<?php

namespace App;

use Baraear\ThaiAddress\Contracts\SubDistrict as SubDistrictContract;
use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model implements SubDistrictContract
{
    //
}
```
```php
<?php

namespace App;

use Baraear\ThaiAddress\Contracts\District as DistrictContract;
use Illuminate\Database\Eloquent\Model;

class District extends Model implements DistrictContract
{
    //
}
```
```php
<?php

namespace App;

use Baraear\ThaiAddress\Contracts\Province as ProvinceContract;
use Illuminate\Database\Eloquent\Model;

class Province extends Model implements ProvinceContract
{
    //
}
```
```php
<?php

namespace App;

use Baraear\ThaiAddress\Contracts\PostalCode as PostalCodeContract;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model implements PostalCodeContract
{
    //
}
```
เมื่อสร้าง Models เองอย่าลืมแก้ไข config
```php
<?php

return [

    'models' => [
        'sub_district' => Baraear\ThaiAddress\Models\SubDistrict::class,
        'district' => Baraear\ThaiAddress\Models\District::class,
        'province' => Baraear\ThaiAddress\Models\Province::class,
        'postal_code' => Baraear\ThaiAddress\Models\PostalCode::class,
    ],

    'table_names' => [
        'sub_district' => 'sub_districts',
        'district' => 'districts',
        'province' => 'provinces',
        'postal_code' => 'postal_codes',
    ],

];
```
นอกจากนี้แพคเกจยังเตรียมการใช้งาน API ไว้ให้ใช้งานสำหรับท่านที่ใช้ Vue.js และ axios
```
+--------+----------+----------------------------------+---------------------+--------------------------------------------------------------------------+--------------+
| Domain | Method   | URI                              | Name                | Action                                                                   | Middleware   |
+--------+----------+----------------------------------+---------------------+--------------------------------------------------------------------------+--------------+
|        | GET|HEAD | api/district/all                 | district.all        | Baraear\ThaiAddress\Controllers\ThaiAddressController@getAllDistricts    | api          |
|        | GET|HEAD | api/district/search/{query}      | district.search     | Baraear\ThaiAddress\Controllers\ThaiAddressController@searchDistrict     | api          |
|        | GET|HEAD | api/district/{id}                | district.get        | Baraear\ThaiAddress\Controllers\ThaiAddressController@getDistrict        | api          |
|        | GET|HEAD | api/postal-code/all              | postal-code.all     | Baraear\ThaiAddress\Controllers\ThaiAddressController@getAllPostalCodes  | api          |
|        | GET|HEAD | api/postal-code/search/{query}   | postal-code.search  | Baraear\ThaiAddress\Controllers\ThaiAddressController@searchPostalCode   | api          |
|        | GET|HEAD | api/postal-code/{id}             | postal-code.get     | Baraear\ThaiAddress\Controllers\ThaiAddressController@getPostalCode      | api          |
|        | GET|HEAD | api/province/all                 | province.all        | Baraear\ThaiAddress\Controllers\ThaiAddressController@getAllProvinces    | api          |
|        | GET|HEAD | api/province/search/{query}      | province.search     | Baraear\ThaiAddress\Controllers\ThaiAddressController@searchProvince     | api          |
|        | GET|HEAD | api/province/{id}                | province.get        | Baraear\ThaiAddress\Controllers\ThaiAddressController@getProvince        | api          |
|        | GET|HEAD | api/search/address/{query}       | search.address      | Baraear\ThaiAddress\Controllers\ThaiAddressController@search             | api          |
|        | GET|HEAD | api/sub-district/all             | sub-district.all    | Baraear\ThaiAddress\Controllers\ThaiAddressController@getAllSubDistricts | api          |
|        | GET|HEAD | api/sub-district/search/{query}  | sub-district.search | Baraear\ThaiAddress\Controllers\ThaiAddressController@searchSubDistrict  | api          |
|        | GET|HEAD | api/sub-district/{id}            | sub-district.get    | Baraear\ThaiAddress\Controllers\ThaiAddressController@getSubDistrict     | api          |
+--------+----------+----------------------------------+---------------------+--------------------------------------------------------------------------+--------------+
```
ผู้ใช้สามารถใช้งานการค้นหาชื่อตำบล, อำเภอ, จังหวัด และรหัสไปรษณีย์ได้ผ่านทาง `Baraear\ThaiAddress\Controllers\ThaiAddressController@search` หรือผ่าน API `api/search/address/{query}` ซึ่งการค้นหาจะใช้ keyword ไปค้นหาจากชื่อตำบล, อำเภอ, จังหวัด และรหัสไปรษณีย์ภายในครั้งเดียว