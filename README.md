# Height

![GitHub release (latest by date)](https://img.shields.io/github/v/release/kdpls/Height?style=flat-square)
![GitHub all releases](https://img.shields.io/github/downloads/kdpls/Height/total?label=downloads%40total&style=flat-square)
![GitHub release (latest by date)](https://img.shields.io/github/downloads/kdpls/Height/latest/total?style=flat-square)
![Discord](https://img.shields.io/discord/856281149503963166?style=flat-square)

A PocketMine-MP plugin to get player height location relative to sea level using command.

## Usage

Command: `/height`\
Permission: `height.command` (Default: `true`)

Get self height location relative to sea level (only works if command sender is an online player): `/height`\
Get a player height location relative to sea level: `/height <player>` (Example: `/height KygekDev` to get height location of player KygekDev relative to sea level)

## Downloads

- Stable version (Recommended): [Latest](https://github.com/KygekDev/Height/releases/latest) | [All releases](https://github.com/KygekDev/Height/releases)
- Build version (For advanced users): [Poggit CI](https://poggit.pmmp.io/ci/kdpls/Height/~)

## API

### `\KygekDev\Height\Height::getHeight()`

**Description**

Gets player's height location (Y coordinate) relative to sea level

**Synopsis**

```php
public static getHeight(Player $player, int $precision = 1) : float
```

**Parameters**

- `Player $player`: The `Player` object to get height location of
- `int $precision = 1`: Number of decimal places to pass to the `round()` function

**Returns**

`float`: Player's Y coordinate relative to sea level

**Example**

```php
use KygekDev\Height\Height;
use pocketmine\Server;

$player = Server::getInstance()->getPlayerExact("KygekDev");

$name = $player->getName();
// 2 decimal places (.xx)
$height = Height::getHeight($player, 2);
$heightString = $height >= 0 ? $height . "m above" : abs($height) . "m below";

$player->sendMessage("Player $name is $heightString sea level");
```

## Info

This plugin is made by KygekDev and licensed under [GPL-3.0](/LICENSE).

- Please [submit an issue](https://github.com/KygekDev/Height/issues) if you want to give suggestions or report bugs.
- Join [KygekDev Community Discord server](https://discord.gg/TstDS9jZf7) for latest news from KygekDev and support from KygekDev or its members.
