describe('News Management', () => {
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

      cy.intercept('GET', '**/dashboards/content-news**').as('newsPageLoad');
      cy.visit('/dashboards/content-news', { timeout: 15000 });
      cy.wait('@newsPageLoad').its('response.statusCode').should('eq', 200);
      cy.get('body', { timeout: 15000 }).should('be.visible');
    });
  });

  it('should allow superadmin to add a new news item', () => {
    cy.get('#news-form').within(() => {
      cy.get('#title_0').type('Test News Title');
      cy.get('#description_0').type('This is a test news description');
      cy.get('#date_0').type('2025-06-19');
    });

    cy.intercept('POST', '/content-news').as('newsSubmit');
    cy.get('#news-form').submit();

    cy.get('.alert-success', { timeout: 12000 }).should('contain', 'Berita berhasil ditambahkan!');
  });


 it('should allow superadmin to delete the first news item', () => {
    cy.get('.news-item', { timeout: 12000 }).then($items => {
      cy.log(`Found ${$items.length} news items`);
      if ($items.length === 0) {
        throw new Error('No news items found. Please seed the database with at least one news item.');
      }
    });

    cy.get('button.btn-danger', { timeout: 12000 })
      .contains('Remove')
      .first()
      .should('be.visible')
      .click();

    cy.intercept('DELETE', '**/content-news/**').as('newsDelete');
    cy.intercept('GET', '**/dashboards/content-news**').as('newsPageReload');

    cy.get('.alert-success', { timeout: 12000 }).should('contain', 'News section removed successfully!');
  });

  it('should allow superadmin to add multiple news items', () => {
    cy.get('#add-news').click();

    cy.get('#title_0').type('First Test News');
    cy.get('#description_0').type('First test description');
    cy.get('#date_0').type('2025-06-19');

    cy.get('#title_1').type('Second Test News');
    cy.get('#description_1').type('Second test description');
    cy.get('#date_1').type('2025-06-20');

    cy.intercept('POST', '/content-news').as('newsSubmit');
    cy.get('#news-form').submit();

    cy.get('.alert-success', { timeout: 12000 }).should('contain', 'Berita berhasil ditambahkan!');
  });
});
