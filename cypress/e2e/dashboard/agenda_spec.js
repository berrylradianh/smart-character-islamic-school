describe('Agenda Management', () => {
  before(() => {
    cy.on('uncaught:exception', (err, runnable) => {
      console.log('Uncaught exception:', err.message, err.stack);
      if (
        err.message.includes('Bootstrap') ||
        err.message.includes('jQuery') ||
        err.message.includes('Script error') ||
        err.message.includes('crossorigin') ||
        err.message.includes('Uncaught') ||
        err.message.includes('form is null')
      ) {
        return false;
      }
      return true;
    });
  });

  beforeEach(() => {
    cy.request({ method: 'POST', url: '/auth/logout', failOnStatusCode: false }).then(() => {
      cy.clearCookies();
      cy.clearLocalStorage();
      cy.window().then((win) => {
        win.sessionStorage.clear();
      });
      cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' }, timeout: 30000 });
      cy.get('[data-testid="login-form"]', { timeout: 10000 })
        .should('be.visible')
        .within(() => {
          cy.get('[data-testid="email-input"]').type('superadmin@gmail.com');
          cy.get('[data-testid="password-input"]').type('password');
          cy.intercept('POST', '/auth/login').as('loginRequest');
          cy.get('[data-testid="submit-button"]').click();
        });
      cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);
      cy.url().should('include', '/dashboards');

      cy.intercept('GET', '**/dashboards/content-agenda**').as('agendaPageLoad');
      cy.visit('/dashboards/content-agenda', { timeout: 15000 });
      cy.wait('@agendaPageLoad').its('response.statusCode').should('eq', 200);
      cy.get('body', { timeout: 15000 }).should('be.visible');
    });
  });

  it('should allow superadmin to add a new agenda item', () => {
    cy.get('#agenda-form').within(() => {
      cy.get('#title_0').type('Test agenda Title');
      cy.get('#description_0').type('This is a test agenda description');
      cy.get('#date_0').type('2025-06-19');
    });

    cy.intercept('POST', '/content-agenda').as('agendaSubmit');
    cy.get('#agenda-form').submit();

    cy.get('.alert-success', { timeout: 12000 }).should('contain', 'Agenda berhasil ditambahkan!');
  });


 it('should allow superadmin to delete the first agenda item', () => {
    cy.get('.agenda-item', { timeout: 12000 }).then($items => {
      cy.log(`Found ${$items.length} agenda items`);
      if ($items.length === 0) {
        throw new Error('No agenda items found. Please seed the database with at least one agenda item.');
      }
    });

    cy.get('button.btn-danger', { timeout: 12000 })
      .contains('Remove')
      .first()
      .should('be.visible')
      .click();

    cy.intercept('DELETE', '**/content-agenda/**').as('agendaDelete');
    cy.intercept('GET', '**/dashboards/content-agenda**').as('agendaPageReload');

    cy.get('.alert-success', { timeout: 12000 }).should('contain', 'Agenda berhasil dihapus.');
  });

  it('should allow superadmin to add multiple agenda items', () => {
    cy.get('#add-agenda').click();

    cy.get('#title_0').type('First Test agenda');
    cy.get('#description_0').type('First test description');
    cy.get('#date_0').type('2025-06-19');

    cy.get('#title_1').type('Second Test agenda');
    cy.get('#description_1').type('Second test description');
    cy.get('#date_1').type('2025-06-20');

    cy.intercept('POST', '/content-agenda').as('agendaSubmit');
    cy.get('#agenda-form').submit();

    cy.get('.alert-success', { timeout: 12000 }).should('contain', 'Agenda berhasil ditambahkan!');
  });
});
