const { defineConfig } = require('cypress');
const mysql = require('mysql2/promise');
require('dotenv').config();

module.exports = defineConfig({
  e2e: {
    baseUrl: 'http://localhost:8000',
    specPattern: 'cypress/e2e/**/*.{js,jsx,ts,tsx,cy.js}',
    pageLoadTimeout: 120000,
    setupNodeEvents(on, config) {
      on('task', {
        deleteUser({ email }) {
          return new Promise(async (resolve, reject) => {
            try {
              const connection = await mysql.createConnection({
                host: process.env.DB_HOST || 'localhost',
                user: process.env.DB_USER || 'root',
                password: process.env.DB_PASSWORD || '',
                database: process.env.DB_DATABASE || 'your_database_name',
              });

              console.log(`Deleting user with email: ${email}`);
              await connection.query('DELETE FROM users WHERE email = ?', [email]);
              await connection.end();
              resolve(true);
            } catch (error) {
              console.error('Error deleting user:', error);
              reject(error);
            }
          });
        },
      });
      return config;
    },
  },
});
