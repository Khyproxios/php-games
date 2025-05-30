<?php

class Color {
	public int $r {
		get {
			return $this->r;
		}
		set (int $r) {
			$this->r = $r;
		}
	}

	public int $g {
		get {
			return $this->g;
		}
		set (int $g) {
			$this->g = $g;
		}
	}

	public int $b {
		get {
			return $this->b;
		}
		set (int $b) {
			$this->b = $b;
		}	
	}

	public int $a {
		get {
			return $this->a;
		}
		set (int $a) {
			$this->a = $a;
		}
	}

	function __construct(int $r, int $g, int $b, int $a) {
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
		$this->a = $a;
	}
}

const BLACK = new Color(0, 0, 0, 255);

class Raylib {
	private \FFI $ffi;
	private \FFI\CType $color_type;

	function __construct() {
		$raylib = \FFI::cdef("
			typedef struct Color {
				unsigned char r;
				unsigned char g;
				unsigned char b;
				unsigned char a;
			} Color;

			void InitWindow(int width, int height, const char *title);
			void SetTargetFPS(int fps);
			bool WindowShouldClose(void);
			void BeginDrawing(void);
			void ClearBackground(Color color);
			void EndDrawing(void);
			void CloseWindow(void);
			", "libraylib.so");

		if (!isset($raylib)) {
			die("could not load raylib.h");
		}

		$this->ffi = $raylib;
		$this->color_type = $this->ffi->type("struct Color");
	}

	function convertColor(Color $color): \FFI\CData {
		$converted_color = $this->ffi->new($this->color_type);

		$converted_color->r = $color->r;
		$converted_color->g = $color->g;
		$converted_color->b = $color->b;
		$converted_color->a = $color->a;

		return $converted_color;
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

	public function clearBackground(Color $color) {
		$converted_color = $this->convertColor($color);

		$this->ffi->ClearBackground($converted_color);
	}

	public function endDrawing() {
		$this->ffi->EndDrawing();
	}

	public function closeWindow() {
		$this->ffi->CloseWindow();
	}
}

?>
