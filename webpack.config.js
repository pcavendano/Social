const path = require('path');
module.exports = {
    resolve: {
        alias: {
            '@': path.resolve( 'resources/js'),
        },
    },
    module: {
        rules: [
            {
                exclude: ['/node_modules/bootstrap/js']
            }
            ]
    }
    };
