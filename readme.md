# Symdoc
An intelligent documentation generator for Symfony.

> **⚠️ Important:**
This project is currently in development and is not intended for production use!
It is here for testing and development purposes only.

## Installation
Since Symdoc is still in development and there isn’t a stable version yet, you’ll need to tell Composer to allow unstable packages.

1. **Require the package:**
```bash
composer require symdoc/symdoc --dev --prefer-source --no-cache
```

2. **Allow unstable versions:** Add the following to your composer.json or include --dev in the require command:
```json
{
    "minimum-stability": "dev",
    "prefer-stable": true
}
```

3. **Install SymDoc:** Run the Composer update to install dependencies:
```bash
composer update
```

## Usage
Once installed, you can run SymDoc from the command line from the root directory using:
```bash
vendor/bin/symdoc
```