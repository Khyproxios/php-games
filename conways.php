#!/usr/bin/php8 -c ./php.ini

<?php

include_once("ffi.php");

class Cell {
	public bool $alive = false;
	public bool $stage = false;
	public bool $hover = false;
	public Rectangle $renderRect;
	public int $aliveCount = 0;
	public int $topLeft;
	public int $topMiddle;
	public int $topRight;
	public int $left;
	public int $right;
	public int $bottomLeft;
	public int $bottomMiddle;
	public int $bottomRight;

	public function __construct(int $x, int $y, Size $size) {
		$this->renderRect = new Rectangle($x, $y, $size->width, $size->height);	
	}
}

class Game {
	private Color $background;
	private Color $cellColor;
	private Color $hoverColor;
	private Color $aliveColor;
	private Color $infoColor;
	private Raylib $raylib;
	private int $horizontalCount;
	private int $verticalCount;
	private array $cells;

	function __construct(int $gridWidth, int $gridHeight, int $horizontalCount, int $verticalCount) {
		$width = 1280;
		$height = 800;
		$offsetX = ($width / 2) - ($gridWidth / 2);
		$offsetY = ($height / 2) - ($gridHeight / 2);
		$cellSize = new Size($gridWidth / $horizontalCount, $gridHeight / $verticalCount);
		$cells = [];

		$this->horizontalCount = $horizontalCount;
		$this->verticalCount = $verticalCount;

		$this->cellColor = new Color(0x88, 0x08, 0x08, 0xFF);
		$this->hoverColor = new Color(0x08, 0x88, 0x08, 0xFF);
		$this->aliveColor = new Color(0x08, 0x08, 0x88, 0xFF);
		$this->infoColor = new Color(0x00, 0x00, 0x00, 0xFF);
		$this->background = new Color(0x28, 0x28, 0x28, 0xFF);
		$this->raylib = new Raylib();

		$this->raylib->initWindow($width, $height, "Raylib + PHP Demo");
		$this->raylib->setTargetFPS(60);

		for ($y = 0; $y < $verticalCount; $y++) {
			for ($x = 0; $x < $horizontalCount; $x++) {
				$cellX = $cellSize->width * $x + $offsetX;
				$cellY = $cellSize->height * $y + $offsetY;
				$cell = new Cell($cellX, $cellY, $cellSize);

				$cell->topLeft = $this->getIndex($x - 1, $y - 1);
				$cell->topMiddle = $this->getIndex($x, $y - 1);
				$cell->topRight = $this->getIndex($x + 1, $y - 1);
				$cell->left = $this->getIndex($x - 1, $y);
				$cell->right = $this->getIndex($x + 1, $y);
				$cell->bottomLeft = $this->getIndex($x - 1, $y + 1);
				$cell->bottomMiddle = $this->getIndex($x, $y + 1);
				$cell->bottomRight = $this->getIndex($x + 1, $y + 1);

				array_push($cells, $cell);
			}
		}

		$this->cells = $cells;
	}

	function __destruct() {
		$this->raylib->closeWindow();
	}

	function getIndex(int $x, int $y): int {
		if ($x < 0 || $this->horizontalCount <= $x || $y < 0 || $this->verticalCount <= $y) {
			return -1;
		}

		return $y * $this->horizontalCount + $x;
	}

	function isAlive(int $index): bool {
		if ($index == -1) {
			return false;
		}

		return $this->cells[$index]->alive;
	}

	function updateCells(bool $runUpdate) {
		$position = $this->raylib->getMousePosition();

		for ($y = 0; $y < $this->verticalCount; $y++) {
			for ($x = 0; $x < $this->horizontalCount; $x++) {
				$index = $this->getIndex($x, $y);
				$cell = $this->cells[$index];

				$aliveCount = (int)$this->isAlive($cell->topLeft)
					+ (int)$this->isAlive($cell->topMiddle)
					+ (int)$this->isAlive($cell->topRight)
					+ (int)$this->isAlive($cell->left)
					+ (int)$this->isAlive($cell->right)
					+ (int)$this->isAlive($cell->bottomLeft)
					+ (int)$this->isAlive($cell->bottomMiddle)
					+ (int)$this->isAlive($cell->bottomRight);

				$cell->aliveCount = $aliveCount;

				if ($runUpdate) {
					$cell->stage = ($cell->alive && ($aliveCount == 2 || $aliveCount == 3))
						|| (!$cell->alive && $aliveCount == 3);
				}

				$mouseDown = $this->raylib->isMouseButtonPressed(MouseButton::Left);
				$mouseOver = $this->raylib->checkCollisionPointRec($position, $cell->renderRect);

				if ($mouseOver && $mouseDown) {
					$cell->alive = !$cell->alive;
					$cell->hover = false;
				} else if ($mouseOver) {
					$cell->hover = true;
				} else {
					$cell->hover = false;
				}
			}
		}

		if ($runUpdate) {
			foreach($this->cells as $cell) {
				$cell->alive = $cell->stage;
			}
		}
	}

	function renderCells() {
		foreach($this->cells as $cell) {
			$color = $this->cellColor;

			if ($cell->alive) {
				$color = $this->aliveColor;
			} else if ($cell->hover) {
				$color = $this->hoverColor;
			}

			$aliveCount = $cell->aliveCount;
			$x = $cell->renderRect->x;
			$y = $cell->renderRect->y;
			$this->raylib->drawRectangleRec($cell->renderRect, $color);
			$this->raylib->drawText("$aliveCount", $x + 10, $y + 10, 20, $this->infoColor);
		}
	}

	function run() {
		$updateThreshold = 0.125;
		$timeElapsed = 0;
		$skipUpdate = true;

		while (!$this->raylib->windowShouldClose()) {
			$deltaTime = $this->raylib->getFrameTime();
			$timeElapsed = $timeElapsed + $deltaTime;

			$runUpdate = !$skipUpdate && $updateThreshold <= $timeElapsed;

			if ($this->raylib->isKeyPressed(KeyboardKey::Space)) {
				$skipUpdate = !$skipUpdate;
			}

			if ($runUpdate) {
				$timeElapsed = 0;
			}

			$this->updateCells($runUpdate);

			$this->raylib->beginDrawing();
			$this->raylib->clearBackground($this->background);

			$this->renderCells();

			$this->raylib->endDrawing();
		}
	}
}

$game = new Game(600, 600, 10, 10);

$game->run();

unset($game);

?>
