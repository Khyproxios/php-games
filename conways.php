#!/usr/bin/php8 -c ./php.ini

<?php

include_once("ffi.php");

class Game {
	private Color $background;
	private Raylib $raylib;	

	function __construct() {
		$this->background = new Color(0x28, 0x28, 0x28, 0xFF);
		$this->raylib = new Raylib();

		$this->raylib->initWindow(1280, 800, "Raylib + PHP Demo");
		$this->raylib->setTargetFPS(60);
	}

	function __destruct() {
		$this->raylib->closeWindow();
	}

	function run() {
		while (!$this->raylib->windowShouldClose()) {
			$this->raylib->beginDrawing();
			$this->raylib->clearBackground($this->background);
			$this->raylib->endDrawing();
		}
	}
}

$game = new Game();

$game->run();

unset($game);

?>
