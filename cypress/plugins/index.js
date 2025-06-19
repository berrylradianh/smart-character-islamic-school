module.exports = (on, config) => {
  const mysql = require('mysql2/promise');
  require('dotenv').config();

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
};
