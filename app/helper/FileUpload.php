<?php

class FileUpload
{
    private const MAX_SIZE = 50 * 1024 * 1024; // 50 MB

    private const ALLOWED_EXTENSIONS = [
        "jpg",
        "jpeg",
        "png",
        "webp"
    ];

    private static function getDirectory(string $directory): string
    {
        return dirname(__DIR__) .
            "/../assets/images/" .
            trim($directory, "/");
    }

    public static function upload(
        array $file,
        string $directory
    ): ?string {

        if (
            !isset($file["error"]) ||
            $file["error"] === UPLOAD_ERR_NO_FILE
        ) {
            return null;
        }

        if ($file["error"] !== UPLOAD_ERR_OK) {
            throw new Exception("Failed to upload image.");
        }

        if ($file["size"] > self::MAX_SIZE) {
            throw new Exception("Image must not exceed 5 MB.");
        }

        $extension = strtolower(
            pathinfo(
                $file["name"],
                PATHINFO_EXTENSION
            )
        );

        if (
            !in_array(
                $extension,
                self::ALLOWED_EXTENSIONS,
                true
            )
        ) {
            throw new Exception(
                "Only JPG, JPEG, PNG and WEBP images are allowed."
            );
        }

        $mime = mime_content_type(
            $file["tmp_name"]
        );

        if (
            !str_starts_with(
                $mime,
                "image/"
            )
        ) {
            throw new Exception("Invalid image.");
        }

        $uploadDirectory = self::getDirectory($directory);

        if (!is_dir($uploadDirectory)) {
            mkdir(
                $uploadDirectory,
                0777,
                true
            );
        }

        $filename =
            uniqid() .
            "_" .
            time() .
            "." .
            $extension;

        $destination =
            $uploadDirectory .
            "/" .
            $filename;

        if (
            !move_uploaded_file(
                $file["tmp_name"],
                $destination
            )
        ) {
            throw new Exception("Failed to save image.");
        }

        return $filename;
    }

    public static function delete(
        string $directory,
        ?string $filename
    ): void {

        if (empty($filename)) {
            return;
        }



        $path = self::getDirectory($directory) . "/" . $filename;

        if (file_exists($path)) {
            unlink($path);
        }
    }

    public static function url(
        string $directory,
        ?string $filename
    ): ?string {

        if (empty($filename)) {
            return null;
        }

        return "/uploads/" .
            trim($directory, "/") .
            "/" .
            $filename;
    }
}
