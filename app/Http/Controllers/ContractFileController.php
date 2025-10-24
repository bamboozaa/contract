<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractFileController extends Controller
{
    /**
     * Stream the contract file to the browser.
     */
    public function show(Contract $contract)
    {
        if (empty($contract->formFile)) {
            abort(404);
        }

        $disk = env('UPLOAD_DISK', 'sftp');
        $path = $contract->formFile;

        if (!Storage::disk($disk)->exists($path)) {
            abort(404);
        }

        // Try to get a stream to avoid loading whole file into memory
        $stream = Storage::disk($disk)->readStream($path);
        if ($stream === false) {
            // Fallback to get()
            $contents = Storage::disk($disk)->get($path);
            $mime = null;
            try {
                $mime = Storage::disk($disk)->mimeType($path);
            } catch (\Exception $e) {
                $mime = 'application/octet-stream';
            }

            return response($contents, 200)
                ->header('Content-Type', $mime)
                ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
        }

        $size = null;
        $mime = null;
        try {
            $size = Storage::disk($disk)->size($path);
        } catch (\Exception $e) {
            $size = null;
        }
        try {
            $mime = Storage::disk($disk)->mimeType($path);
        } catch (\Exception $e) {
            $mime = 'application/octet-stream';
        }

        return response()->stream(function () use ($stream) {
            fpassthru($stream);
            if (is_resource($stream)) {
                fclose($stream);
            }
        }, 200, array_filter([
            'Content-Type' => $mime,
            'Content-Length' => $size,
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
        ]));
    }
}
