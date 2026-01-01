<?php

namespace App\Services;

use App\Models\Bateau;
use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    /**
     * Upload and save a media file for a bateau
     *
     * @param Bateau $bateau
     * @param UploadedFile $file
     * @param string $type (image or video)
     * @param string|null $description
     * @return Media
     */
    public function uploadMedia(Bateau $bateau, UploadedFile $file, string $type = 'image', ?string $description = null): Media
    {
        // Generate unique filename
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

        // Determine storage path based on type
        $path = $type === 'video' ? 'videos' : 'images';
        $fullPath = $path . '/' . $bateau->id;

        // Get configured disk (cloudflare in production, public in local)
        $disk = config('filesystems.default');

        // Store file
        $file->storeAs($fullPath, $filename, $disk);

        // Store only the relative path (Media accessor will transform to full URL)
        $relativePath = $fullPath . '/' . $filename;

        // Create media record
        $lastOrder = $bateau->medias()->where('type', $type)->max('ordre') ?? 0;

        return Media::create([
            'bateau_id' => $bateau->id,
            'type' => $type,
            'url' => $relativePath,  // Store relative path, accessor will add R2 URL
            'description' => $description,
            'ordre' => $lastOrder + 1,
        ]);
    }

    /**
     * Upload multiple media files
     *
     * @param Bateau $bateau
     * @param array $files
     * @param string $type
     * @return array
     */
    public function uploadMultipleMedia(Bateau $bateau, array $files, string $type = 'image'): array
    {
        $uploadedMedia = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $uploadedMedia[] = $this->uploadMedia($bateau, $file, $type);
            }
        }

        return $uploadedMedia;
    }

    /**
     * Delete a media and its file
     *
     * @param Media $media
     * @return bool
     */
    public function deleteMedia(Media $media): bool
    {
        // The Media model's deleting event will handle R2 file deletion
        // Just delete the database record
        return $media->delete();
    }

    /**
     * Update media order
     *
     * @param Bateau $bateau
     * @param array $mediaIds (ordered array of media IDs)
     * @return void
     */
    public function updateMediaOrder(Bateau $bateau, array $mediaIds): void
    {
        foreach ($mediaIds as $index => $mediaId) {
            Media::where('id', $mediaId)
                ->where('bateau_id', $bateau->id)
                ->update(['ordre' => $index + 1]);
        }
    }

    /**
     * Get validated mime types for images
     *
     * @return array
     */
    public function getImageMimeTypes(): array
    {
        return ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    }

    /**
     * Get validated mime types for videos
     *
     * @return array
     */
    public function getVideoMimeTypes(): array
    {
        return ['video/mp4', 'video/mpeg', 'video/quicktime', 'video/x-msvideo', 'video/webm'];
    }

    /**
     * Get validation rules for image upload
     *
     * @return string
     */
    public function getImageValidationRules(): string
    {
        return 'image|mimes:jpeg,jpg,png,gif,webp|max:10240'; // Max 10MB
    }

    /**
     * Get validation rules for video upload
     *
     * @return string
     */
    public function getVideoValidationRules(): string
    {
        return 'mimes:mp4,mpeg,mov,avi,webm|max:102400'; // Max 100MB
    }
}
