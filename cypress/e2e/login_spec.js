describe('Login Page', () => {
  beforeEach(() => {
    // Visit the login page before each test
    cy.visit('/auth/login');
    // Ensure the login form is visible
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');
  });

  // Handle uncaught exceptions
  before(() => {
    cy.on('uncaught:exception', (err, runnable) => {
      // Log the error for debugging
      console.log('Uncaught exception:', err.message);
      // Ignore Bootstrap jQuery and other irrelevant errors
      if (
        err.message.includes('Bootstrap') ||
        err.message.includes('jQuery') ||
        err.message.includes('Script error') ||
        err.message.includes('crossorigin') ||
        err.message.includes('Uncaught')
      ) {
        return false;
      }
    });
  });

  it('Test Case 1: Empty email and password shows required field errors', () => {
    // Clear browser cache and storage
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    // Intercept the login POST request
    cy.intercept('POST', '/auth/login').as('loginRequest');
    // Submit form without filling email and password
    cy.get('[data-testid="submit-button"]').click();
    // Wait for the POST request to complete
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    // Check for validation messages
    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 2: Empty email with filled password shows email required error', () => {
    // Clear browser cache and storage
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    // Intercept the login POST request
    cy.intercept('POST', '/auth/login').as('loginRequest');
    // Fill password only
    cy.get('[data-testid="password-input"]').type('somepassword');
    cy.get('[data-testid="submit-button"]').click();
    // Wait for the POST request to complete
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    // Check for email validation message
    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 3: Filled email with empty password shows password required error', () => {
    // Clear browser cache and storage
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    // Intercept the login POST request
    cy.intercept('POST', '/auth/login').as('loginRequest');
    // Fill email only
    cy.get('[data-testid="email-input"]').type('test@example.com');
    cy.get('[data-testid="submit-button"]').click();
    // Wait for the POST request to complete
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    // Check for password validation message
    cy.get('[data-testid="password-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 4: Wrong email and wrong password shows credentials error', () => {
    // Clear browser cache and storage
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    // Intercept the login POST request
    cy.intercept('POST', '/auth/login').as('loginRequest');
    // Fill wrong email and password
    cy.get('[data-testid="email-input"]').type('wrong@example.com');
    cy.get('[data-testid="password-input"]').type('wrongpassword');
    cy.get('[data-testid="submit-button"]').click();
    // Wait for the POST request to complete
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    // Check for error message
    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
  });

  it('Test Case 5: Wrong email and correct password shows credentials error', () => {
    // Clear browser cache and storage
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    // Intercept the login POST request
    cy.intercept('POST', '/auth/login').as('loginRequest');
    // Fill wrong email and correct password
    cy.get('[data-testid="email-input"]').type('wrong@example.com');
    cy.get('[data-testid="password-input"]').type('password');
    cy.get('[data-testid="submit-button"]').click();
    // Wait for the POST request to complete
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    // Check for error message
    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
  });

  it('Test Case 6: Correct email and wrong password shows credentials error', () => {
    // Clear browser cache and storage
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    // Intercept the login POST request
    cy.intercept('POST', '/auth/login').as('loginRequest');
    // Fill correct email and wrong password
    cy.get('[data-testid="email-input"]').type('superadmin@gmail.com');
    cy.get('[data-testid="password-input"]').type('wrongpassword');
    cy.get('[data-testid="submit-button"]').click();
    // Wait for the POST request to complete
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    // Check for error message
    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
  });

  it('Test Case 7: Correct email and password redirects to dashboard', () => {
  // Clear browser cache and storage
  cy.clearCookies();
  cy.clearLocalStorage();
  cy.window().then((win) => {
    win.sessionStorage.clear();
  });
  cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
  cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

  // Intercept the login POST request
  cy.intercept('POST', '/auth/login').as('loginRequest');
  // Fill correct email and password
  cy.get('[data-testid="email-input"]').type('superadmin@gmail.com');
  cy.get('[data-testid="password-input"]').type('password');
  cy.get('[data-testid="submit-button"]').click();
  // Wait for the POST request to complete
  cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

  // Wait for jQuery to load
  cy.window().then((win) => {
    // Ensure jQuery is available
    expect(win.jQuery).to.exist;
    // Optionally wait for scripts to initialize
    cy.wait(2000); // This is still okay, but consider if it's necessary
  });

  // Check for redirection to dashboard or profile page
  cy.url({ timeout: 15000 }).should('satisfy', (url) => {
    return url.includes('/dashboards') || url.includes('/profile');
  });

  // Ensure the dashboard page is fully loaded
  cy.get('body', { timeout: 15000 }).should('be.visible');

  // Check for success message
  cy.get('[data-testid="success-message"]', { timeout: 15000 })
    .should('be.visible')
    .and('contain', 'Login successful!');
});
});
