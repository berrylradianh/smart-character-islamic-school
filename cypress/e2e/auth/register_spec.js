describe('Register Page', () => {
  beforeEach(() => {
    cy.clearCookies();
    cy.clearLocalStorage();
    cy.window().then((win) => {
      win.sessionStorage.clear();
    });
    cy.visit('/auth/register', { headers: { 'Cache-Control': 'no-cache' } });
    cy.get('[data-testid="register-form"]', { timeout: 10000 }).should('be.visible');
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

  it('Test Case 1: All fields empty shows required field errors', () => {
    cy.intercept('POST', '/auth/register').as('registerRequest');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@registerRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="name-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="level-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-confirmation-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 2: Only Fullname filled shows required errors for other fields', () => {
    cy.intercept('POST', '/auth/register').as('registerRequest');
    cy.get('[data-testid="name-input"]').type('John Doe');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@registerRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="level-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-confirmation-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 3: Only Email filled shows required errors for other fields', () => {
    cy.intercept('POST', '/auth/register').as('registerRequest');
    cy.get('[data-testid="email-input"]').type('test@example.com');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@registerRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="name-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="level-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-confirmation-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 4: Only Education Level filled shows required errors for other fields', () => {
    cy.intercept('POST', '/auth/register').as('registerRequest');

    cy.get('[data-testid="level-input"]').parents('.sign__input').then(($parent) => {
      cy.log('Parent DOM:', $parent.html());
      cy.screenshot('test-case-4-select');
    });
    cy.get('[data-testid="level-input"]').then(($select) => {
      cy.log('Select element:', $select);
      cy.log('Is visible:', $select.is(':visible'));
    });

    cy.get('[data-testid="level-input"]').select(1, { force: true });

    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@registerRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="name-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-confirmation-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 5: Only Password filled shows required errors for other fields', () => {
    cy.intercept('POST', '/auth/register').as('registerRequest');
    cy.get('[data-testid="password-input"]').type('password123');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@registerRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="name-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="email-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="level-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="password-confirmation-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 6: All fields filled except Confirmation Password shows required error', () => {
    cy.intercept('POST', '/auth/register').as('registerRequest');
    cy.get('[data-testid="name-input"]').type('John Doe');
    cy.get('[data-testid="email-input"]').type('test@example.com');

    cy.get('[data-testid="level-input"]').parents('.sign__input').then(($parent) => {
      cy.log('Parent DOM:', $parent.html());
      cy.screenshot('test-case-6-select');
    });
    cy.get('[data-testid="level-input"]').then(($select) => {
      cy.log('Select element:', $select);
      cy.log('Is visible:', $select.is(':visible'));
    });

    cy.get('[data-testid="level-input"]').select(1, { force: true });

    cy.get('[data-testid="password-input"]').type('password123');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@registerRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="password-confirmation-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Harap isi bidang ini');
  });

  it('Test Case 7: Password and Confirmation Password mismatch shows error', () => {
    cy.intercept('POST', '/auth/register').as('registerRequest');
    cy.get('[data-testid="name-input"]').type('John Doe');
    cy.get('[data-testid="email-input"]').type('test@example.com');

    cy.get('[data-testid="level-input"]').parents('.sign__input').then(($parent) => {
      cy.log('Parent DOM:', $parent.html());
      cy.screenshot('test-case-7-select');
    });
    cy.get('[data-testid="level-input"]').then(($select) => {
      cy.log('Select element:', $select);
      cy.log('Is visible:', $select.is(':visible'));
    });

    cy.get('[data-testid="level-input"]').select(1, { force: true });

    cy.get('[data-testid="password-input"]').type('password123');
    cy.get('[data-testid="password-confirmation-input"]').type('password456');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@registerRequest').its('response.statusCode').should('eq', 302);

    cy.get('[data-testid="password-error"]', { timeout: 12000 }).should('be.visible').and('contain', 'Password dan Konfirmasi Password tidak cocok');
    cy.get('[data-testid="error-message"]', { timeout: 12000 }).should('be.visible').and('contain', 'Password dan Konfirmasi Password tidak cocok');
  });

  it('Test Case 8: All fields filled correctly redirects to dashboard', () => {
    const uniqueEmail = `test${Date.now()}@example.com`;
    cy.intercept('POST', '/auth/register').as('registerRequest');
    cy.intercept('GET', '/dashboards/profile/edit').as('profileRequest');
    cy.get('[data-testid="name-input"]').type('John Doe');
    cy.get('[data-testid="email-input"]').type(uniqueEmail);

    cy.get('[data-testid="level-input"]').parents('.sign__input').then(($parent) => {
      cy.log('Parent DOM:', $parent.html());
      cy.screenshot('test-case-8-select');
    });
    cy.get('[data-testid="level-input"]').then(($select) => {
      cy.log('Select element:', $select);
      cy.log('Is visible:', $select.is(':visible'));
    });

    cy.get('[data-testid="level-input"]').select(1, { force: true });

    cy.get('[data-testid="password-input"]').type('password123');
    cy.get('[data-testid="password-confirmation-input"]').type('password123');
    cy.get('[data-testid="submit-button"]').click();
    cy.wait('@registerRequest').its('response.statusCode').should('eq', 302);

    cy.wait('@profileRequest', { timeout: 120000 }).then((interception) => {
      cy.log('Profile edit request status:', interception.response.statusCode);
    });
    cy.url({ timeout: 120000 }).should('eq', 'http://localhost:8000/dashboards/profile/edit');

    cy.deleteUserByEmail(uniqueEmail).should('eq', true);
  });
});
