module.exports = {
  purge: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
          primary: {
            DEFAULT: '#00ffaf',
            dark: '#00d693',
          },
          'secondary': {
            DEFAULT: '#00d0c1',
          },
          'discord': {
            DEFAULT: '#7289da',
              dark: '#5d6eb3',
          }
      },
      maxWidth: {
        '1/4': '25%',
        '1/2': '50%',
        '3/4': '75%',
      },
      gridTemplateRows: {
        '7': 'repeat(7, minmax(0, 1fr))',
      }
    },
  },
  variants: {
    extend: {
      borderWidth: ['hover', 'focus'],
    },
  },
  plugins: [
    require('postcss-import'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
  ],
}
