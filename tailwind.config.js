import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                devlog: {
                    bg: "#2d2640",
                    card: "#3d3555",
                    sidebar: "#251f38",
                    border: "#4a4168",
                    text: "#f0ece8",
                    muted: "#9b92b8",
                    primary: "#c4785a",
                    accent: "#e8a87c",
                },
            },
        },
    },

    plugins: [forms],
};
