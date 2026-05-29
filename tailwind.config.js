import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans],
                display: ["Space Grotesk", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                canvas: "#0b0b0f",
                surface: "#111116",
                accent: {
                    DEFAULT: "#8b5cf6",
                    hover: "#7c4ddb",
                    muted: "rgba(139, 92, 246, 0.12)",
                },
                border: {
                    subtle: "rgba(255, 255, 255, 0.06)",
                },
            },
            boxShadow: {
                card: "0 1px 2px rgba(0, 0, 0, 0.4)",
            },
        },
    },

    plugins: [forms],
};
