<?php

class Raylib {
	private FFI $ffi;

	function __construct() {
		$raylib = FFI::cdef("
			void InitWindow(int width, int height, const char *title);
			void SetTargetFPS(int fps);
			bool WindowShouldClose(void);
			void BeginDrawing(void);
			void EndDrawing(void);
			void CloseWindow(void);
			", "libraylib.so");

		if (!isset($raylib)) {
			die("could not load raylib.h");
		}

		$this->ffi = $raylib;
	}

	public function initWindow(int $width, int $height, string $title) {
		$this->ffi->InitWindow($width, $height, $title);
	}

	public function setTargetFPS(int $fps) {
		$this->ffi->SetTargetFPS($fps);
	}

	public function windowShouldClose(): bool {
		return $this->ffi->WindowShouldClose();
	}

	public function beginDrawing() {
		$this->ffi->BeginDrawing();
	}

	public function endDrawing() {
		$this->ffi->EndDrawing();
	}

	public function closeWindow() {
		$this->ffi->CloseWindow();
	}
}

?>
