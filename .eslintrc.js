module.exports = {
	env: {
		browser: true,
		es2021: true,
		node: true,
	},
	extends: [ 'eslint:recommended', 'prettier', 'plugin:react/recommended' ],
	globals: {
		wp: 'readonly',
	},
	parser: 'babel-eslint',
	parserOptions: {
		ecmaFeatures: {
			jsx: true,
		},
		ecmaVersion: 12,
		sourceType: 'module',
	},
	plugins: [ 'react' ],
	rules: {
		'no-console': 'warn',
		'react/react-in-jsx-scope': 'off',
		'react/jsx-fragments': [ 'error', 'syntax' ],
		'react/display-name': 'off',
		'react/prop-types': 'off',
	},
};
