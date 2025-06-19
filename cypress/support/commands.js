Cypress.Commands.add('deleteUserByEmail', (email) => {
  cy.task('deleteUser', { email }).then((result) => {
    return result;
  });
});
