<?php

namespace hahahalib\aws;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use hahahalib\aws\define\key;

/*
// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

$key = "";
$secret_key = "";

$s3 = \hahahalib\aws\s3::Instance()->Initial(
    $key,
    $secret_key
);

$bucket = "hahaha-test-3";
$k = "test/test.pdf";
$file_name = "D:/desktop/新增資料夾/ipp_developer-guide-reference_2021.10-790148-790150.pdf";
$s3->Put_Object_File_Name(
    $bucket,
    $k,
    $file_name
);

$bucket = "hahaha-test-3";
$k = "test/test2.jpg";
$file_name = "D:/desktop/新增資料夾/未命名2.png";
$content = fopen($file_name, 'rb');
$s3->Put_Object_Body(
    $bucket,
    $k,
    $content,
    "image/jpeg"
);

$url = "";
$k = "test/test3.jpg";
$content = fopen($file_name, 'rb');
$s3->Get_Pre_Signed_Url(
    $url,
    $bucket,
    $k,
    "image/jpeg"
);

$information = "";
$size = filesize($file_name);
\hahahalib\curl::Instance()->Initial()->Put($url, 
    $content, 
    $size, 
    $information,
    [
        "Content-Type: image/jpeg",
    ] 
);

echo '<img src="https://hahaha-test-3.s3.ap-southeast-2.amazonaws.com/test/test.jpg">';
echo "hahaha";
*/
class s3
{
    use \hahahalib\instance;

    public $Client_;

    public $Key_;
    public $Secret_Key_;
    public $Region_;

    public function Initial(&$key, &$secret_key, $region = "ap-southeast-2")
    {
        $this->Key_ = $key;
        $this->Secret_Key_ = $secret_key;
        $this->Region_ = $region;

        $this->Client_ = new S3Client([
            key::REGION => $this->Region_,     // 你的 bucket 所在區域
            key::VERSION => key::LATEST,
            key::CREDENTIALS => [
                key::KEY => $this->Key_,
                key::SECRET => $this->Secret_Key_,
            ]
        ]);

        return $this;

    }

    // 副檔名	Content-Type
    // .doc	application/msword
    // .docx	application/vnd.openxmlformats-officedocument.wordprocessingml.document
    // .xls	application/vnd.ms-excel
    // .xlsx	application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
    // .ppt	application/vnd.ms-powerpoint
    // .pptx	application/vnd.openxmlformats-officedocument.presentationml.presentation
    // .csv	text/csv
    // .txt	text/plain
    // .pdf	application/pdf
    // .zip	application/zip
    // .png	image/png
    // .jpg / .jpeg	image/jpeg
    // .gif	image/gif
    // .mp4	video/mp4
    // $mime = mime_content_type($filePath);
    public function Put_Object_File_Name(&$bucket, &$key, &$file_name, $content_type = "", $cache_control = 'max-age=31536000')
    {
        $data = [
            key::BUCKET => $bucket,
            key::KEY_    => $key,
            key::SOURCE_FILE => $file_name,
            key::CACHE_CONTROL => 'max-age=31536000', // 可選：CDN 快取
        ];

        if(!empty($content_type))
        {
            $data[key::CONTENT_TYPE] = $content_type;        // ⭐ 設定上傳檔案類型

        }

        $result = $this->Client_->putObject($data);

        return $result;
    }

    public function Put_Object_Body(&$bucket, &$key, &$content, $content_type = "", $cache_control = 'max-age=31536000')
    {
        $data = [
            key::BUCKET => $bucket,
            key::KEY_    => $key,
            key::BODY => &$content,
            key::CACHE_CONTROL => 'max-age=31536000', // 可選：CDN 快取
        ];

        if(!empty($content_type))
        {
            $data[key::CONTENT_TYPE] = $content_type;        // ⭐ 設定上傳檔案類型

        }

        $result = $this->Client_->putObject($data);

        return $result;
    }

    // "+10 seconds"
    // "+10 minutes"
    // "+10 hours"
    public function Get_Pre_Signed_Url(&$url, &$bucket, &$key, $content_type = "", $cache_control = 'max-age=31536000', $expire_time="+10 minutes")
    {
        $data = [
            key::BUCKET => $bucket,
            key::KEY_    => $key,
            key::CACHE_CONTROL => 'max-age=31536000', // 可選：CDN 快取
        ];

        if(!empty($content_type))
        {
            $data[key::CONTENT_TYPE] = $content_type;        // ⭐ 設定上傳檔案類型

        } 
        else
        {
            $data[key::CONTENT_TYPE] = "application/octet-stream";

        }

        $cmd = $this->Client_->getCommand('PutObject', $data);

        $request = $this->Client_->createPresignedRequest($cmd, '+10 minutes');

        $url = (string)$request->getUri();

    }
    

  
} 