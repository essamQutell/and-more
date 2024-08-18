<?php

namespace App\Traits;

use App\Enums\Options\FileTypesEnum;
use App\Models\Attachment;
use App\Services\settings\AttachmentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\UploadedFile;

trait HasAttachmentTrait
{
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function saveVideo(
        $file,
        string $folder,
        string $title,
        ?string $name,
        ?int $size,
        ?int $id
    ) {
        if ($id != null) {
            $attach = Attachment::find($id);
            $attach->update([
                'file' => (new AttachmentService())->videoUploader($file, $folder, $attach->file),
            ]);

            return $attach;
        } else {
            return Attachment::create([
                'type' => FileTypesEnum::video->name,
                'title' => $title,
                'name' => $name,
                'size' => $size ?? 0,
                'file' => (new AttachmentService())->videoUploader($file, $folder),
            ]);
        }
    }

    public function saveImage(
        UploadedFile $file,
        string $folder,
        string $title,
        ?string $name,
        ?int $size,
        ?int $id
    ): Attachment {
        if ($id != null) {
            $attach = Attachment::find($id);
            $attach->update([
                'file' => (new AttachmentService())->imageUploaderWithResize($file, $folder, $attach->file),
            ]);

            return $attach;
        } else {
            return Attachment::create([
                'type' => FileTypesEnum::image->name,
                'title' => $title,
                'name' => $name,
                'size' => $size ?? 0,
                'file' => (new AttachmentService())->imageUploaderWithoutResize($file, $folder),
            ]);
        }
    }

    public function saveFile(
        UploadedFile $file,
        string $folder,
        string $title,
        ?string $name,
        ?int $size,
        ?int $id
    ): Attachment|Model {
        if ($id != null) {
            $attach = Attachment::find($id);
            $attach->update([
                'file' => (new AttachmentService())->fileUploader($file, $folder, $attach->file),
            ]);

            return $attach;
        } else {
            return Attachment::create([
                'type' => FileTypesEnum::file->name,
                'title' => $title,
                'name' => $name,
                'size' => $size ?? 0,
                'file' => (new AttachmentService())->fileUploader($file, $folder),
            ]);
        }
    }

    public function saveImageResize(
        UploadedFile $file,
        string $folder,
        string $title,
        ?string $name,
        ?int $size,
        ?int $id
    ): Attachment|Model {
        if ($id != null) {
            $attach = Attachment::find($id);
            $attach->update([
                'file' => (new AttachmentService())->imageUploaderWithResize($file, $folder, $attach->file),
            ]);

            return $attach;
        } else {
            return Attachment::create([
                'type' => FileTypesEnum::image->name,
                'title' => $title,
                'name' => $name,
                'size' => $size ?? 0,
                'file' => (new AttachmentService())->imageUploaderWithResize($file, $folder),
            ]);
        }
    }

    public function assignAttachment(array $files): void
    {
        if ($this->attachments()) {
            $this->attachments()->update(['attachmentable_type' => null, 'attachmentable_id' => null]);
        }

        Attachment::whereIn('id', $files)->update([
            'attachmentable_type' => get_class($this),
            'attachmentable_id' => $this->id,
        ]);
        //Attachment::where('attachmentable_type', null)->delete();
    }

    public function deleteAllAttachments(string $path): void
    {
        foreach ($this->attachments as $file) {
            (new AttachmentService())->deleteFile($path, $file->file);
            $file->delete();
        }
    }

    public function getAttachmentFile($title): string
    {
        $default = url('images/logo.png');
        if ($this->relationLoaded('attachments')) {
            $attachment = $this->attachments->firstWhere('title', $title);
            if ($attachment && ! empty($attachment->file)) {
                return get_file($attachment->file);
            }
        }

        return $default;
    }

    public function getAllFiles(string $path): array
    {
        $files = [];
        foreach ($this->attachments as $file) {
            $files[] = [
                'src' => asset('uploads/'.$path.'/'.$file->file),
                'file' => $file,
            ];
        }

        return $files;
    }
}
