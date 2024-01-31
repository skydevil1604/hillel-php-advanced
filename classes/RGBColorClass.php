<?php

class RGBColor
{
    private int $red;
    private int $green;
    private int $blue;

    public function __construct(int $red, int $green, int $blue)
    {
        $this->setRed($red);
        $this->setGreen($green);
        $this->setBlue($blue);
    }

    public static function random(): RGBColor
    {
        $red = random_int(0, 255);
        $green = random_int(0, 255);
        $blue = random_int(0, 255);

        return new self($red, $green, $blue);
    }

    public function equals(RGBColor $newColor): bool
    {
        return $this->red === $newColor->getRed() &&
            $this->green === $newColor->getGreen() &&
            $this->blue === $newColor->getBlue();
    }

    public function getRed(): int
    {
        return $this->red;
    }

    public function setRed(int $red): void
    {
        $this->validateColorValue($red);
        $this->red = $red;
    }

    public function getGreen(): int
    {
        return $this->green;
    }

    public function setGreen(int $green): void
    {
        $this->validateColorValue($green);
        $this->green = $green;
    }

    public function getBlue(): int
    {
        return $this->blue;
    }

    public function setBlue(int $blue): void
    {
        $this->validateColorValue($blue);
        $this->blue = $blue;
    }

    public function mix(RGBColor $newColor): RGBColor
    {
        $mixedRed = ($this->red + $newColor->getRed()) / 2;
        $mixedGreen = ($this->green + $newColor->getGreen()) / 2;
        $mixedBlue = ($this->blue + $newColor->getBlue()) / 2;

        return new self($mixedRed, $mixedGreen, $mixedBlue);
    }

    private function validateColorValue(int $value): void
    {
        if ($value < 0 || $value > 255) {
            throw new InvalidArgumentException("Invalid color value. Range of 0 to 255.");
        }
    }
}

// Examples:
$color = new RGBColor(250, 250, 250);
echo '<pre>';
print_r($color);
echo '</pre>';

$randomColor = $color->random();
echo '<pre>';
print_r($randomColor);
echo '</pre>';

$mixedColor = $color->mix(new RGBColor(100, 100, 100));
echo '<pre>';
print_r($mixedColor);
echo '</pre>';
echo '<pre>';
print_r($mixedColor->getRed());
echo '</pre>';
echo '<pre>';
print_r($mixedColor->getGreen());
echo '</pre>';
echo '<pre>';
print_r($mixedColor->getBlue());
echo '</pre>';

$isEqual = $color->equals($randomColor);
if ($isEqual) {
    echo 'COLORS equals';
} else {
    echo 'COLORS not equals';
}