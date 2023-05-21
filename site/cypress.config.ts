import { defineConfig } from 'cypress'

export default defineConfig({
  e2e: {
    specPattern: 'cypress/e2e/**/*.{cy,spec}.{js,jsx,ts,tsx}',
    baseUrl: 'http://localhost:8000',
  },
  env: {
    apiUrl: 'http://localhost:9000/api',
    apiKey: 'secret_key',
  }
})
