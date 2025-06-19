describe('Landing Page', () => {
    beforeEach(() => {
        cy.clearCookies();
        cy.clearLocalStorage();
        cy.window().then((win) => {
            win.sessionStorage.clear();
        });
        cy.window().then((win) => {
            cy.spy(win.console, 'error').as('consoleError');
        });
        cy.visit('/', { headers: { 'Cache-Control': 'no-cache' } });
        cy.window().then((win) => {
            cy.waitUntil(() => win.jQuery, {
                timeout: 10000,
                interval: 500,
                errorMsg: 'jQuery was not loaded within 10 seconds'
            });
        });
        cy.get('body', { timeout: 10000 }).should('be.visible');
    });

    before(() => {
        cy.on('uncaught:exception', (err, runnable) => {
            console.log('Uncaught exception:', err.message);
            if (
                err.message.includes('Bootstrap') ||
                err.message.includes('jQuery') ||
                err.message.includes('Script error') ||
                err.message.includes('crossorigin') ||
                err.message.includes('Uncaught') ||
                err.message.includes('$ is not defined') ||
                err.message.includes('owlCarousel') ||
                err.message.includes('jQuery is not defined')
            ) {
                return false;
            }
        });
    });

    it('Test Case 1: Root URL loads successfully without errors', () => {
        cy.request('/').its('status').should('eq', 200);
        cy.get('.slider__area', { timeout: 10000 }).should('be.visible');
        cy.get('@consoleError').should('not.have.been.called');
    });

    it('Test Case 2: Daftar Sekarang button links to register page', () => {
        cy.get('.slider__btn a', { timeout: 10000 })
            .should('be.visible')
            .and('contain', 'Daftar Sekarang')
            .and('have.attr', 'href')
            .and('include', '/auth/register');
    });

    it('Test Case 3: Introduction section content loads without errors', () => {
        cy.get('section[style*="background-color: #1a2e44"]', { timeout: 10000 }).should('be.visible');
        cy.get('h1[style*="font-size: 50px"]').should('contain', 'Welcome to SCIS');
        cy.get('h2[style*="font-size: 45px"]').should('contain', 'Smart Character Islamic School');
        cy.get('@consoleError').should('not.have.been.called');
    });
});
