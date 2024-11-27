# TradeMate Plugin

This repository contains the source code for the [TradeMate WordPress Plugin](https://wordpress.org/plugins/trademate/).

## Source Code Location

- Uncompressed JavaScript and CSS files are in the `src/` directory.
- Minified production files are in the `assets/` directory.

## Build Instructions

To rebuild the compressed files:

1. Clone this repository:

```
git clone https://github.com/wpintegrity/trademate.git
```

2. Install dependencies:

```
composer install
npm install
```
3. Development Process
```
npm run dev
```
4. Build the files

```
npm run build
```

5. Build release version

```
npm run release
```
The zip file will be stored in the `dist/` direcory