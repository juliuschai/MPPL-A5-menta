<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper {
	static function getDocumentOrFail($filename) {
		if (Storage::disk('public')->exists($filename)){
			return Storage::disk('public')->response($filename);
		} else {
			abort(404, 'File tidak ditemukan di server');
		}
	}

	static function downloadDocumentOrFail($filename, $userFilename) {
		if (Storage::disk('public')->exists($filename)){
			return Storage::disk('public')->download($filename, $userFilename);
		} else {
			abort(404, 'File tidak ditemukan di server');
		}
	}

	static function deleteDocumentOrFail($filename) {
		if (Storage::disk('public')->exists($filename)){
			return Storage::disk('public')->delete($filename);
		} else {
			abort(404, 'File tidak ditemukan di server');
		}
	}
}
