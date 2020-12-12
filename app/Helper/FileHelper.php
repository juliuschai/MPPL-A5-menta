<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper {
	static function getDocumentOrFail($filename) {
		if (Storage::disk('local')->exists($filename)){
			return Storage::disk('local')->response($filename);
		} else {
			abort(404, 'File tidak ditemukan di server');
		}
	}

	static function downloadDocumentOrFail($filename, $userFilename) {
		if (Storage::disk('local')->exists($filename)){
			return Storage::disk('local')->download($filename, $userFilename);
		} else {
			abort(404, 'File tidak ditemukan di server');
		}
	}

	static function deleteDocumentOrFail($filename) {
		if (Storage::disk('local')->exists($filename)){
			return Storage::disk('local')->delete($filename);
		} else {
			abort(404, 'File tidak ditemukan di server');
		}
	}
}
