const path = require('path')

module.exports = {
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            '@': path.resolve(__dirname, 'resources/js/src/'),
            '@libs': path.resolve(__dirname, 'resources/js/src/libs/')
        }
    }
}
