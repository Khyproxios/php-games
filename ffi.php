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

enum MouseButton: int {
	case Left = 0;
	case Right = 1;
	case Middle = 2;
	case Side = 3;
	case Extra = 4;
	case Forward = 5;
	case Back = 6;
}

enum KeyboardKey: int {
    case Null            = 0;        // Key: NULL, used for no key pressed
    // Alphanumeric keys
    case Apostrophe      = 39;       // Key: '
    case Comma           = 44;       // Key: ,
    case Minus           = 45;       // Key: -
    case Period          = 46;       // Key: .
    case Slash           = 47;       // Key: /
    case Zero            = 48;       // Key: 0
    case One             = 49;       // Key: 1
    case Two             = 50;       // Key: 2
    case Three           = 51;       // Key: 3
    case Four            = 52;       // Key: 4
    case Five            = 53;       // Key: 5
    case Six             = 54;       // Key: 6
    case Seven           = 55;       // Key: 7
    case Eight           = 56;       // Key: 8
    case Nine            = 57;       // Key: 9
    case SemiColon       = 59;       // Key: ;
    case Equal           = 61;       // Key: =
    case A               = 65;       // Key: A | a
    case B               = 66;       // Key: B | b
    case C               = 67;       // Key: C | c
    case D               = 68;       // Key: D | d
    case E               = 69;       // Key: E | e
    case F               = 70;       // Key: F | f
    case G               = 71;       // Key: G | g
    case H               = 72;       // Key: H | h
    case I               = 73;       // Key: I | i
    case J               = 74;       // Key: J | j
    case K               = 75;       // Key: K | k
    case L               = 76;       // Key: L | l
    case M               = 77;       // Key: M | m
    case N               = 78;       // Key: N | n
    case O               = 79;       // Key: O | o
    case P               = 80;       // Key: P | p
    case Q               = 81;       // Key: Q | q
    case R               = 82;       // Key: R | r
    case S               = 83;       // Key: S | s
    case T               = 84;       // Key: T | t
    case U               = 85;       // Key: U | u
    case V               = 86;       // Key: V | v
    case W               = 87;       // Key: W | w
    case X               = 88;       // Key: X | x
    case Y               = 89;       // Key: Y | y
    case Z               = 90;       // Key: Z | z
    case LeftBracket    = 91;       // Key: [
    case BackSlash       = 92;       // Key: '\'
    case RightBracket   = 93;       // Key: ]
    case Grave           = 96;       // Key: `
    // Function keys
    case Space           = 32;       // Key: Space
    case Escape          = 256;      // Key: Esc
    case Enter           = 257;      // Key: Enter
    case Tab             = 258;      // Key: Tab
    case Backspace       = 259;      // Key: Backspace
    case Insert          = 260;      // Key: Ins
    case Delete          = 261;      // Key: Del
    case Right           = 262;      // Key: Cursor right
    case Left            = 263;      // Key: Cursor left
    case Down            = 264;      // Key: Cursor down
    case Up              = 265;      // Key: Cursor up
    case PageUp         = 266;      // Key: Page up
    case PageDown       = 267;      // Key: Page down
    case Home            = 268;      // Key: Home
    case End             = 269;      // Key: End
    case CapsLock       = 280;      // Key: Caps lock
    case ScrollLock     = 281;      // Key: Scroll down
    case NumLock        = 282;      // Key: Num lock
    case PrintScreen    = 283;      // Key: Print screen
    case Pause           = 284;      // Key: Pause
    case F1              = 290;      // Key: F1
    case F2              = 291;      // Key: F2
    case F3              = 292;      // Key: F3
    case F4              = 293;      // Key: F4
    case F5              = 294;      // Key: F5
    case F6              = 295;      // Key: F6
    case F7              = 296;      // Key: F7
    case F8              = 297;      // Key: F8
    case F9              = 298;      // Key: F9
    case F10             = 299;      // Key: F10
    case F11             = 300;      // Key: F11
    case F12             = 301;      // Key: F12
    case LeftShift      = 340;      // Key: Shift left
    case LeftControl    = 341;      // Key: Control left
    case LeftAlt        = 342;      // Key: Alt left
    case LeftSuper      = 343;      // Key: Super left
    case RightShift     = 344;      // Key: Shift right
    case RightControl   = 345;      // Key: Control right
    case RightAlt       = 346;      // Key: Alt right
    case RightSuper     = 347;      // Key: Super right
    case BMenu         = 348;      // Key: KB menu
    // Keypad keys
    case KP_0            = 320;      // Key: Keypad 0
    case KP_1            = 321;      // Key: Keypad 1
    case KP_2            = 322;      // Key: Keypad 2
    case KP_3            = 323;      // Key: Keypad 3
    case KP_4            = 324;      // Key: Keypad 4
    case KP_5            = 325;      // Key: Keypad 5
    case KP_6            = 326;      // Key: Keypad 6
    case KP_7            = 327;      // Key: Keypad 7
    case KP_8            = 328;      // Key: Keypad 8
    case KP_9            = 329;      // Key: Keypad 9
    case KP_Decimal      = 330;      // Key: Keypad .
    case KP_Divide       = 331;      // Key: Keypad /
    case KP_Multiply     = 332;      // Key: Keypad *
    case KP_Subtract     = 333;      // Key: Keypad -
    case KP_Add          = 334;      // Key: Keypad +
    case KP_Enter        = 335;      // Key: Keypad Enter
    case KP_Equal        = 336;      // Key: Keypad =
    // Android key buttons
    case Back            = 4;        // Key: Android back button
    case Menu            = 5;        // Key: Android menu button
    case VolumeUp       = 24;       // Key: Android volume up button
    case VolumeDown     = 25;       // Key: Android volume down button
};

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
			float GetFrameTime(void);
			void BeginDrawing(void);
			void ClearBackground(Color color);
			void EndDrawing(void);
			void CloseWindow(void);

			void DrawText(const char *text, int posX, int posY, int fontSize, Color color);
			void DrawRectangleRec(Rectangle rec, Color color);
			Vector2 GetMousePosition(void);
			bool IsKeyPressed(int key);
			bool IsMouseButtonPressed(int button);
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

	public function getFrameTime(): float {
		return $this->ffi->GetFrameTime();
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

	public function drawText(string $text, int $posX, int $posY, int $fontSize, Color $color) {
		$convertedColor = $this->convertColor($color);

		$this->ffi->DrawText($text, $posX, $posY, $fontSize, $convertedColor);
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

	public function isKeyPressed(KeyboardKey $key): bool {
		return $this->ffi->IsKeyPressed($key->value);
	}

	public function isMouseButtonPressed(MouseButton $button): bool {
		return $this->ffi->IsMouseButtonPressed($button->value);
	}

	public function checkCollisionPointRec(Vector2 $position, Rectangle $rectangle): bool {
		$convertedVector2 = $this->convertVector2($position);
		$convertedRectangle = $this->convertRectangle($rectangle);

		return $this->ffi->CheckCollisionPointRec($convertedVector2, $convertedRectangle);
	}
}

?>
