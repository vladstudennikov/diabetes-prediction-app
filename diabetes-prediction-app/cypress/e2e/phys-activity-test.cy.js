describe('Add Physical Activity After Login', () => {
  it('logs in and adds a physical activity', () => {
    const date = new Date().toLocaleDateString('en-CA'); // today's date
    const duration = Math.floor(Math.random() * 90) + 10;
    const exercise = 'Біг ' + Math.floor(Math.random() * 1000);

    // Step 1: Visit home and click "Увійти"
    cy.visit('/');
    cy.contains('Увійти').click();

    // Step 2: Fill login form
    cy.get('input[type="email"]').type('vladstudennikovwork@gmail.com');
    cy.get('input[type="password"]').type('12345678');
    cy.get('button[type="submit"]').click();

    // Step 3: Wait for redirect to dashboard
    cy.url().should('include', '/dashboard');

    // Step 4: Open "Add Activity" modal
    cy.contains('Фіз. активність').click();
    cy.contains('Додати вправу').click();

    // Step 5: Fill the form
    cy.get('input[type="date"]').clear().type(date);
    cy.get('input[type="number"]').clear().type(duration);
    cy.get('input[type="text"]').clear().type(exercise);

    // Step 6: Intercept POST request
    cy.intercept('POST', '/phys-activities').as('addActivity');
    cy.get('[data-cy="submit-activity"]').click();

    // Step 8: Click calendar cell for today's date (to refresh activity list)
    cy.get('.vuecal__cell').contains(new Date().getDate()).click();

    // Step 9: Verify the activity appears
    cy.contains(`${exercise} — ${duration} хв`).should('exist');
  });
});