<?php

namespace App\Http\Controllers;

use App\Models\ContractAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentFileController extends Controller
{
    public function show(Request $request, ContractAttachment $attachment)
    {
        $disk = env('UPLOAD_DISK', 'sftp');
        $path = $attachment->filename;

        if (!Storage::disk($disk)->exists($path)) {
            abort(404);
        }

        $stream = Storage::disk($disk)->readStream($path);
        $mime = 'application/octet-stream';
        try {
            $mime = Storage::disk($disk)->mimeType($path);
        } catch (\Throwable $e) {
            // ignore
        }

        $disposition = $request->query('download') ? 'attachment' : 'inline';

        if ($stream === false) {
            $contents = Storage::disk($disk)->get($path);
            return response($contents, 200)
                ->header('Content-Type', $mime)
                ->header('Content-Disposition', $disposition . '; filename="' . ($attachment->original_name ?: basename($path)) . '"');
        }

        $size = null;
        try {
            $size = Storage::disk($disk)->size($path);
        } catch (\Throwable $e) {
            $size = null;
        }

        return response()->stream(function () use ($stream) {
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, 200, array_filter([
            'Content-Type' => $mime,
            'Content-Length' => $size,
            'Content-Disposition' => $disposition . '; filename="' . ($attachment->original_name ?: basename($path)) . '"',
        ]));
    }
}
