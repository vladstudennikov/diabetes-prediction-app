describe('Nutrition form test', () => {
  it('should open nutrition form, fill and submit it', () => {
    cy.visit('/'); 
    cy.contains('Увійти').click();

    cy.url().should('include', '/login');

    cy.get('input[type=email]').type('vladstudennikovwork@gmail.com');
    cy.get('input[type=password]').type('12345678');
    cy.get('button[type=submit]').click();

    cy.url().should('not.include', '/login');

    cy.contains('Харчування').click();
    cy.contains('Додати страву').click();

    const date = new Date().toLocaleDateString('en-CA');
    cy.get('input[type="date"]').type(date);

    cy.get('input[placeholder="Наприклад: Вівсянка з фруктами"]').type('Вівсянка з фруктами');

    cy.get('select').select('Сніданок');

    cy.get('[data-cy="submit-activity"]').click();

    cy.get('.vuecal__cell').contains(new Date().getDate()).click();

    cy.contains(`Сніданок: Вівсянка з фруктами`).should('exist');
  });
});