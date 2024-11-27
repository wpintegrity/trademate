const fs = require('fs-extra');
const path = require('path');
const { exec } = require('child_process');
const util = require('util');
const _ = require('lodash');

const asyncExec = util.promisify(exec);

const pluginFiles = [
    'assets/',
    'includes/',
    'languages/',
    'templates/',
    'vendor/',
    'trademate.php',
    'readme.txt',
    'composer.json',
];

const removeFiles = ['composer.lock'];

const allowedVendorFiles = {
    // Specify allowed files for each composer package if needed
};

const { version } = JSON.parse(fs.readFileSync('package.json'));

async function cleanDistDirectory() {
    try {
        const files = await fs.readdirSync('dist');
        const zipFiles = files.filter(file => file.endsWith('.zip'));

        if (zipFiles.length > 0) {
            await asyncExec(
                'rm *.zip',
                {
                    cwd: 'dist',
                }
            );
            console.log(`Removed existing ${zipFiles.join(', ')} files.`);
        } else {
            console.log('No existing .zip files to remove.');
        }
    } catch (error) {
        console.error(`Error cleaning dist directory: ${error.message}`);
    }
}

async function packagePlugin() {
    try {
        await cleanDistDirectory();

        const dest = path.resolve(`dist/trademate`); // Ensure dest is a resolved path

        const fileList = [...pluginFiles];

        fs.mkdirpSync(dest);

        fileList.forEach((file) => {
            const sourcePath = path.resolve(file); // Resolve source file path
            const destinationPath = path.resolve(dest, file); // Resolve destination file path
            fs.copySync(sourcePath, destinationPath); // Copy files with resolved paths
        });

        console.log(`Finished copying files to ${dest}.`);

        await asyncExec(
            'composer install --optimize-autoloader --no-dev',
            {
                cwd: dest,
            }
        );

        console.log(`Installed composer packages in ${dest} directory.`);

        removeFiles.forEach((file) => {
            fs.removeSync(path.resolve(dest, file)); // Ensure file paths are resolved before removal
        });

        Object.keys(allowedVendorFiles).forEach((composerPackage) => {
            const packagePath = path.resolve(
                dest,
                `vendor/${composerPackage}`
            );

            if (!fs.existsSync(packagePath)) {
                return;
            }

            const list = fs.readdirSync(packagePath);
            const deletables = _.difference(
                list,
                allowedVendorFiles[composerPackage]
            );

            deletables.forEach((deletable) => {
                fs.removeSync(path.resolve(packagePath, deletable));
            });
        });

        const zipFile = `trademate-${version}.zip`;

        console.log(`Making zip file ${zipFile}...`);

        await asyncExec(
            `zip -rq ${zipFile} trademate`,
            {
                cwd: 'dist',
            }
        );

        fs.removeSync(dest);
        console.log(`${zipFile} is ready.`);
    } catch (error) {
        console.log(`Could not complete the packaging process.`);
        console.log(error);
    }
}

packagePlugin();
