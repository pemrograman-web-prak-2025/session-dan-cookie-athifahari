/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js", 
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            // ✅ BISA TAMBAH CUSTOM COLOR
            colors: {
                'nature': {
                    50: '#f0f9f4',
                    100: '#dcf2e3',
                    500: '#10b981',
                    600: '#059669',
                    700: '#047857',
                }
            },
            // ✅ BISA TAMBAH CUSTOM FONT
            fontFamily: {
                'sans': ['Figtree', 'ui-sans-serif', 'system-ui'],
            }
        },
    },
    plugins: [],
}