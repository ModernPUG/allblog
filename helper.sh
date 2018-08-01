#!/usr/bin/env bash

rm -rf packages/ModernPUG/FeedReader
mkdir -p packages/ModernPUG
git clone https://github.com/ModernPUG/FeedReader.git packages/ModernPUG/FeedReader
rm -rf vendor/modern-pug/feed-reader
mkdir -p vendor/modern-pug
ln -s ../../packages/ModernPUG/FeedReader vendor/modern-pug/feed-reader

composer dump

php artisan vendor:publish --provider="App\Providers\ReaderServiceProvider"