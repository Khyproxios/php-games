<?php

const ONE = new Vector2(1, 1);
const ZERO = new Vector2(0, 0);
const BLACK = new Color(0, 0, 0, 255);

class Vector2 {
	public int $x;
	public int $y;

	public function __construct(int $x, int $y) {
		$this->x = $x;
		$this->y = $y;
	}
}

class Size {
	public int $width;
	public int $height;

	public function __construct(int $width, int $height) {
		$this->width = $width;
		$this->height = $height;
	}
}

class Rectangle {
	public int $x;
	public int $y;
	public int $width;
	public int $height;

	public function __construct(int $x, int $y, int $width, int $height) {
		$this->x = $x;
		$this->y = $y;
		$this->width = $width;
		$this->height = $height;
	}
}

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

class Raylib {
	private \FFI $ffi;
	private \FFI\CType $vector2Type;
	private \FFI\CType $sizeType;
	private \FFI\CType $rectangleType;
	private \FFI\CType $colorType;

	function __construct() {
		$raylib = \FFI::cdef("
			typedef struct Color {
				unsigned char r;
				unsigned char g;
				unsigned char b;
				unsigned char a;
			} Color;

			typedef struct Vector2 {
				float x;
				float y;
			} Vector2;

			typedef struct Size {
				float width;
				float height;
			} Size;

			typedef struct Rectangle {
				float x;
				float y;
				float width;
				float height;
			} Rectangle;

			void InitWindow(int width, int height, const char *title);
			void SetTargetFPS(int fps);
			bool WindowShouldClose(void);
			void BeginDrawing(void);
			void ClearBackground(Color color);
			void EndDrawing(void);
			void CloseWindow(void);

			void DrawRectangleRec(Rectangle rec, Color color);
			Vector2 GetMousePosition(void);
			bool CheckCollisionPointRec(Vector2 point, Rectangle rec);
		", "libraylib.so");

		if (!isset($raylib)) {
			die("could not load raylib.h");
		}

		$this->ffi = $raylib;
		$this->colorType = $this->ffi->type("struct Color");
		$this->vector2Type = $this->ffi->type("struct Vector2");
		$this->sizeType = $this->ffi->type("struct Size");
		$this->rectangleType = $this->ffi->type("struct Rectangle");
	}

	function convertVector2(Vector2 $vector2): \FFI\CData {
		$convertedVector2 = $this->ffi->new($this->vector2Type);

		$convertedVector2->x = $vector2->x;
		$convertedVector2->y = $vector2->y;

		return $convertedVector2;
	}

	function convertSize(Size $size): \FFI\CData {
		$convertedSize = $this->ffi->new($this->sizeType);

		$convertedSize->width = $size->width;
		$convertedSize->height = $size->height;

		return $convertedSize;
	}

	function convertRectangle(Rectangle $rect): \FFI\CData {
		$convertedRect = $this->ffi->new($this->rectangleType);

		$convertedRect->x = $rect->x;
		$convertedRect->y = $rect->y;
		$convertedRect->width = $rect->width;
		$convertedRect->height = $rect->height;

		return $convertedRect;
	}

	function convertColor(Color $color): \FFI\CData {
		$convertedColor = $this->ffi->new($this->colorType);

		$convertedColor->r = $color->r;
		$convertedColor->g = $color->g;
		$convertedColor->b = $color->b;
		$convertedColor->a = $color->a;

		return $convertedColor;
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
		$convertedColor = $this->convertColor($color);

		$this->ffi->ClearBackground($convertedColor);
	}

	public function endDrawing() {
		$this->ffi->EndDrawing();
	}

	public function closeWindow() {
		$this->ffi->CloseWindow();
	}

	public function drawRectangleRec(Rectangle $rectangle, Color $color) {
		$convertedRectangle = $this->convertRectangle($rectangle);
		$convertedColor = $this->convertColor($color);

		$this->ffi->DrawRectangleRec($convertedRectangle, $convertedColor);
	}

	public function getMousePosition(): Vector2 {
		$position = $this->ffi->GetMousePosition();

		return new Vector2($position->x, $position->y);
	}

	public function checkCollisionPointRec(Vector2 $position, Rectangle $rectangle): bool {
		$convertedVector2 = $this->convertVector2($position);
		$convertedRectangle = $this->convertRectangle($rectangle);

		return $this->ffi->CheckCollisionPointRec($convertedVector2, $convertedRectangle);
	}
}

?>
