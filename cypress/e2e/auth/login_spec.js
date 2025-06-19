describe('Login Page', () => {
  beforeEach(() => {
    cy.visit('/auth/login');
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');
  });

  before(() => {
    cy.on('uncaught:exception', (err, runnable) => {
      console.log('Uncaught exception:', err.message);
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
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    cy.intercept('POST', '/auth/login').as('loginRequest');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 2: Empty email with filled password shows email required error', () => {
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    cy.intercept('POST', '/auth/login').as('loginRequest');
    cy.get('[data-testid="password-input"]').type('somepassword');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 3: Filled email with empty password shows password required error', () => {
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    cy.intercept('POST', '/auth/login').as('loginRequest');
    cy.get('[data-testid="email-input"]').type('test@example.com');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="password-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 4: Wrong email and wrong password shows credentials error', () => {
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    cy.intercept('POST', '/auth/login').as('loginRequest');
    cy.get('[data-testid="email-input"]').type('wrong@example.com');
    cy.get('[data-testid="password-input"]').type('wrongpassword');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
  });

  it('Test Case 5: Wrong email and correct password shows credentials error', () => {
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    cy.intercept('POST', '/auth/login').as('loginRequest');
    cy.get('[data-testid="email-input"]').type('wrong@example.com');
    cy.get('[data-testid="password-input"]').type('password');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
  });

  it('Test Case 6: Correct email and wrong password shows credentials error', () => {
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

    cy.intercept('POST', '/auth/login').as('loginRequest');
    cy.get('[data-testid="email-input"]').type('superadmin@gmail.com');
    cy.get('[data-testid="password-input"]').type('wrongpassword');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'These credentials do not match our record');
  });

  it('Test Case 7: Correct email and password redirects to dashboard', () => {
  cy.clearCookies();
  cy.clearLocalStorage();
  cy.window().then((win) => {
    win.sessionStorage.clear();
  });
  cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
  cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

  cy.intercept('POST', '/auth/login').as('loginRequest');
  cy.get('[data-testid="email-input"]').type('superadmin@gmail.com');
  cy.get('[data-testid="password-input"]').type('password');
  cy.get('[data-testid="submit-button"]').click();
  cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

  cy.window().then((win) => {
    expect(win.jQuery).to.exist;
    cy.wait(2000);
  });

  cy.url({ timeout: 15000 }).should('satisfy', (url) => {
    return url.includes('/dashboards') || url.includes('/profile');
  });

  cy.get('body', { timeout: 15000 }).should('be.visible');

  cy.get('[data-testid="success-message"]', { timeout: 15000 })
    .should('be.visible')
    .and('contain', 'Login successful!');
});
});
