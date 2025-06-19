describe('PPDB Functionality', () => {
    beforeEach(() => {
        cy.request({ method: 'POST', url: '/auth/logout', failOnStatusCode: false }).then(() => {
            cy.clearCookies();
            cy.clearLocalStorage();
            cy.window().then((win) => {
                win.sessionStorage.clear();
            });
            cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' }, timeout: 30000 });
            cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');
        });
    });

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

    it('Test Case 1: Login and check accepted status on ppdb-pengumuman', () => {
        cy.clearCookies();
        cy.clearLocalStorage();
        cy.window().then((win) => {
            win.sessionStorage.clear();
        });
        cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
        cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

        cy.intercept('POST', '/auth/login').as('loginRequest');
        cy.get('[data-testid="email-input"]').type('berryl1@gmail.com');
        cy.get('[data-testid="password-input"]').type('password');
        cy.get('[data-testid="submit-button"]').click();
        cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

        cy.visit('http://localhost:8000/dashboards/ppdb-pengumuman', { timeout: 15000 });
        cy.get('body', { timeout: 15000 }).should('be.visible');

        cy.get('.card-body', { timeout: 12000 }).should('be.visible');
        cy.contains('Diterima', { timeout: 12000 }).should('be.visible');
        cy.contains('Selamat, Anda telah diterima di Smart Character Islamic School.', { timeout: 12000 }).should('be.visible');
    });

    it('Test Case 2: Login and check waiting status on ppdb-pendaftaran', () => {
        cy.clearCookies();
        cy.clearLocalStorage();
        cy.window().then((win) => {
            win.sessionStorage.clear();
        });
        cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
        cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

        cy.intercept('POST', '/auth/login').as('loginRequest');
        cy.get('[data-testid="email-input"]').type('berryl2@gmail.com');
        cy.get('[data-testid="password-input"]').type('password');
        cy.get('[data-testid="submit-button"]').click();
        cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

        cy.visit('http://localhost:8000/dashboards/ppdb-pengumuman', { timeout: 15000 });
        cy.get('body', { timeout: 15000 }).should('be.visible');

        cy.contains('Menunggu Verifikasi', { timeout: 12000 }).should('be.visible');
        cy.contains('Pendaftaran Anda sedang ditinjau oleh tim kami. Anda akan menerima pembaruan segera.', { timeout: 12000 }).should('be.visible');
        cy.get('#registrationForm', { timeout: 5000 }).should('not.exist');
    });

    it('Test Case 3: Login and check approved status with test details on ppdb-pendaftaran', () => {
        cy.clearCookies();
        cy.clearLocalStorage();
        cy.window().then((win) => {
            win.sessionStorage.clear();
        });
        cy.visit('/auth/login', { headers: { 'Cache-Control': 'no-cache' } });
        cy.get('[data-testid="login-form"]', { timeout: 10000 }).should('be.visible');

        cy.intercept('POST', '/auth/login').as('loginRequest');
        cy.get('[data-testid="email-input"]').type('berryl3@gmail.com');
        cy.get('[data-testid="password-input"]').type('password');
        cy.get('[data-testid="submit-button"]').click();
        cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

        cy.visit('http://localhost:8000/dashboards/ppdb-pengumuman', { timeout: 15000 });
        cy.get('body', { timeout: 15000 }).should('be.visible');

        cy.contains('Diterima Seleksi Administrasi', { timeout: 12000 }).should('be.visible');
        cy.contains('Pendaftaran Anda telah diterima, lakukan tes terlebih dahulu, untuk detailnya silahkan cek di halaman pendaftaran.', { timeout: 12000 }).should('be.visible');
        cy.get('#registrationForm', { timeout: 5000 }).should('not.exist');
    });

    it('Test Case 4: Login and check download kartu peserta button on ppdb-pendaftaran', () => {
        cy.intercept('POST', '/auth/login').as('loginRequest');
        cy.get('[data-testid="email-input"]').type('berryl3@gmail.com');
        cy.get('[data-testid="password-input"]').type('password');
        cy.get('[data-testid="submit-button"]').click();
        cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

        cy.intercept('GET', '**/dashboards/ppdb-pendaftaran**').as('pageLoad');
        cy.visit(`http://localhost:8000/dashboards/ppdb-pendaftaran`, { timeout: 30000 });
        cy.wait('@pageLoad').its('response.statusCode').should('eq', 200);
        cy.get('body', { timeout: 30000 }).should('be.visible');

        // Verify expected UI for approve/accepted/not_accepted status
        cy.contains('Diterima Seleksi Administrasi', { timeout: 12000 }).should('be.visible');
        cy.get('#registrationForm', { timeout: 5000 }).should('not.exist'); // Form should not exist
        cy.get('.card-body', { timeout: 12000 }).should('be.visible');
        cy.get('#downloadKartuPeserta', { timeout: 12000 })
            .should('be.visible')
            .and('contain', 'Download Kartu Peserta')
            .click();

        cy.intercept('GET', '**/download-kartu-peserta**').as('downloadRequest');
    });

    it('Test Case 5: Login and check declined status with revisi button on ppdb-pendaftaran', () => {
        cy.intercept('POST', '/auth/login').as('loginRequest');
        cy.get('[data-testid="email-input"]').type('berryl4@gmail.com');
        cy.get('[data-testid="password-input"]').type('password');
        cy.get('[data-testid="submit-button"]').click();
        cy.wait('@loginRequest').its('response.statusCode').should('eq', 302);

        cy.intercept('GET', '**/dashboards/ppdb-pendaftaran**').as('pageLoad');
        cy.visit(`http://localhost:8000/dashboards/ppdb-pendaftaran`, { timeout: 30000 });
        cy.wait('@pageLoad').its('response.statusCode').should('eq', 200);
        cy.get('body', { timeout: 30000 }).should('be.visible');

        // Verify expected UI for decline status
        cy.contains('Pendaftaran Ditolak', { timeout: 12000 }).should('be.visible');
        cy.contains('Maaf, pendaftaran Anda tidak memenuhi kriteria. Silakan revisi dan mengirimkan kembali ke tim kami.', { timeout: 12000 }).should('be.visible');
        cy.get('#registrationForm', { timeout: 5000 }).should('not.exist'); // Form should not exist
        cy.get('.card-body', { timeout: 12000 }).should('be.visible');
        cy.get('#buttonRevisiData', { timeout: 12000 })
            .should('be.visible')
            .and('contain', 'Revisi Data')
            .click();

        cy.url({ timeout: 15000 }).should('eq', 'http://localhost:8000/dashboards/ppdb-pendaftaran/revisi');
    });
});
