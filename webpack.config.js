var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/website/')
    .setPublicPath('/website')
    .addEntry('website', './assets/js/website/app.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSassLoader()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableReactPreset();

websiteConfig = Encore.getWebpackConfig();
websiteConfig.name = 'websiteConfig';

module.exports = [websiteConfig];
