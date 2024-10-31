const fs = require('fs-extra');

const pluginFiles = [
    'assets/**/*',
    'includes/**/*',
    'languages/**/*',
    'templates/**/*',
    'src/**/*',
    'trademate.php',
];

const versionReplace = async () => {
    try {
        const packageJson = fs.readFileSync('package.json', 'utf8');
        const { version } = JSON.parse(packageJson);

        const { replaceInFile } = await import('replace-in-file');

        const options = {
            files: pluginFiles,
            from: /TRADEMATE_SINCE/g,
            to: version,
        };

        replaceInFile(options)
            .then(results => {
                console.log('Replacement results:', results);
            })
            .catch(error => {
                console.error('Error occurred:', error);
            });
    } catch (error) {
        console.error('Error reading package.json:', error);
    }
};

versionReplace();
