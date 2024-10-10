# Composer Contribute Plugin

[![Minimum PHP Version](https://img.shields.io/badge/php-%5E8.2-8892BF.svg)](https://www.php.net/releases/8.2/en.php)
[![Continuous Integration Status](https://github.com/leonhusmann/composer-contribute/workflows/CI/badge.svg)](https://github.com/leonhusmann/composer-contribute/actions)
[![Code Coverage](https://codecov.io/gh/leonhusmann/composer-contribute/branch/main/graph/badge.svg?token=X)](https://codecov.io/gh/leonhusmann/composer-contribute)
[![License](https://poser.pugx.org/leonhusmann/composer-contribute/license)](https://github.com/leonhusmann/composer-contribute/blob/main/LICENSE)

**Composer Contribute** is a Composer plugin that helps you find open issues in your project dependencies, allowing you to contribute to the packages you rely on. It's particularly useful during events like Hacktoberfest.

## Features

- Lists open issues from your Composer dependencies.
- Filter issues by labels (e.g., `good first issue`, `help wanted`, `hacktoberfest`).

## Installation

### Global Installation

To install this plugin globally, run:

```bash
composer global require leonhusmann/composer-contribute
```

This will install the plugin and make the `contribute` command available globally.

### Usage

Once installed, you can use the `contribute` command to find open issues from your project dependencies:

```bash
composer contribute
```

This command will query the dependencies of your current Composer project and list any open issues you can contribute to.

## Contributing

We welcome contributions! Here's how you can get started with local development and testing.

### Local Development Setup

To contribute to this project, follow these steps to set up the plugin for local development:

1. Fork this repository and clone your fork locally:

   ```bash
   git clone https://github.com/leonhusmann/composer-contribute.git
   cd composer-contribute
   ```

2. Run `composer install` to install the required dependencies.

3. Add the local repository path to your global Composer configuration:

   ```bash
   composer global config repositories.local path /path/to/your/local/fork
   ```

   Replace `/path/to/your/local/fork` with the actual path where you cloned the project.

4. Install the plugin globally in development mode:

   ```bash
   composer global require leonhusmann/composer-contribute:@dev
   ```

5. Ensure your global `composer.json` allows development versions by setting the `minimum-stability` to `dev`:

   ```bash
   composer global config minimum-stability dev
   ```

6. Now, you can test the `contribute` command:

   ```bash
   composer contribute
   ```

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.