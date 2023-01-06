import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/vendors/css/vendors.min.css",
                "css/core.css",
                "css/base/themes/dark-layout.css",
                "css/base/themes/bordered-layout.css",
                "css/base/themes/semi-dark-layout.css",
                "css/base/core/menu/menu-types/vertical-menu.css",
                "css/overrides.css",
                "css/style.css",
                "css/custom.css",
            ],
            refresh: true,
        }),
    ],
});
