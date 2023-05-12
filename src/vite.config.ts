import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'
// https://vitejs.dev/config/
export default defineConfig({
    resolve: {
        alias: {
            '/main.ts': './src/main.ts',
        },
    },
    server: {
        port: 8000,
        hmr: {
            host: 'testcase.loc'
        },
    },
    plugins: [vue()],
})
