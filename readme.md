# Symdoc
An intelligent documentation generator for Symfony.

![CI](https://img.shields.io/github/actions/workflow/status/rukanuel/symdoc/ci.yml?label=CI)
![GitHub License](https://img.shields.io/github/license/rukanuel/symdoc)

> **⚠️ Important:**
This project is currently in development and is not intended for production use!
It is here for testing and development purposes only.

## Installation
Since Symdoc is still in development and there isn’t a stable version yet, you’ll need to tell Composer to allow unstable packages.

**1. Require the package:**

```bash
composer require symdoc/symdoc --dev --prefer-source --no-cache
```

**2. Allow unstable versions:** 

Add the following to your composer.json or include --dev in the require command:
```json
{
    "minimum-stability": "dev",
    "prefer-stable": true
}
```

**3. Install Symdoc:** 

Run the Composer update to install dependencies:
```bash
composer update
```

## Usage
Once installed, you can run Symdoc from the command line from the root directory using:
```bash
vendor/bin/symdoc
```

## Local Development

When developing or contributing to **Symdoc**, the easiest way to work is by cloning the [Symfony Demo](https://github.com/symfony/demo) project and testing Symdoc locally within that project.

**1. Clone required projects**

First, clone the [Symdoc](https://github.com/rukanuel/symdoc) and [Symfony Demo](https://github.com/symfony/demo) repositories.

**2. Update `composer.json`**

Add the following to the `repositories` section of your `composer.json` in Symfony Demo:

```json
"repositories": [
    {
        "type": "path",
        "url": "path/to/local/symdoc"
    }
]
```
Then, in the require section, add Symdoc:
```json
"require": {
  "symdoc/symdoc": "*"
}
```

**3. Update Composer**

Run the following command to update your dependencies:
```bash
composer update
```

**4. Start Using Symdoc Locally**

Now, you can start using **Symdoc** as you normally would. The demo project will now use your local version of Symdoc, allowing you to make real-time updates and test them instantly.
