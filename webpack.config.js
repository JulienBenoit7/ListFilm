const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/') // Répertoire de sortie pour les assets compilés
    .setPublicPath('/build') // Chemin public pour accéder aux assets compilés depuis le serveur web
    .splitEntryChunks() // Divise les entrées en morceaux pour une meilleure optimisation
    .enableSingleRuntimeChunk() // Active un chunk runtime unique pour éviter les duplications

    // Configuration des entrées (chaque entrée génère un fichier JavaScript et CSS)
    .addEntry('app', './assets/app.js')

    // Nettoie le répertoire de sortie avant chaque build
    .cleanupOutputBeforeBuild()

    // Active les notifications de build
    .enableBuildNotifications()

    // Active les source maps pour un débogage facilité
    .enableSourceMaps(!Encore.isProduction())

    // Active le versionnement des fichiers pour le cache busting en production
    .enableVersioning(Encore.isProduction())

    // Configure Babel pour les polyfills avec @babel/preset-env
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage'; // Utilise les polyfills selon l'usage détecté dans votre code
        config.corejs = '3.23'; // Version de core-js à utiliser
    })

    // Active le chargement de Sass/SCSS
    .enableSassLoader()

// Active les hashs d'intégrité pour les tags script et link (nécessite WebpackEncoreBundle 1.4+)
//.enableIntegrityHashes(Encore.isProduction())

// Active la prise en charge de TypeScript si nécessaire
//.enableTypeScriptLoader()

// Active la prise en charge de React si nécessaire
//.enableReactPreset()

// Fournit automatiquement jQuery si nécessaire pour les plugins
//.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
