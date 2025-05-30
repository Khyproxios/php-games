#!/usr/bin/php8 -c ./php.ini

<?php

include_once("ffi.php");

class Game {
	private Raylib $raylib;	

	function __construct() {
		$this->raylib = new Raylib();

		$this->raylib->InitWindow(1280, 800, "Raylib + PHP Demo");
		$this->raylib->SetTargetFPS(60);
	}

	function __destruct() {
		$this->raylib->CloseWindow();
	}

	function run() {
		while (!$this->raylib->WindowShouldClose()) {
			$this->raylib->BeginDrawing();
			$this->raylib->EndDrawing();
		}
	}
}

$game = new Game();

$game->run();

unset($game);

?>
