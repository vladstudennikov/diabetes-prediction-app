describe('Тест на діабет', () => {
  beforeEach(() => {
    cy.visit('/diabetes-test/start')
  })

  it('Показує помилку при відсутності вибору варіанту', () => {
    cy.contains('Далі').click()
    cy.contains('Будь ласка, введіть значення перед тим, як продовжити.').should('be.visible')
  })

  it('Показує помилку при відсутності числового вводу', () => {
    for (let i = 0; i < 2; i++) {
        cy.get('input[type="number"]').clear().type('1') 
        cy.contains('Далі').click()
    }

    cy.contains('Далі').click()

    cy.contains('Будь ласка, виберіть відповідь перед тим, як продовжити.').should('be.visible')
  })

  it('Проходить тест, відправляє дані та переходить до результатів', () => {
    cy.intercept('POST', '/diabetes-test/results').as('submitResults')

    const steps = [
      { type: 'number', value: '20' },
      { type: 'number', value: '25' },
      { type: 'radio', value: 'last' },
      { type: 'radio', value: 'last' },
      { type: 'radio', value: 'first' },
      { type: 'radio', value: 'last' },
      { type: 'radio', value: 'last' },
      { type: 'radio', value: 'last' },
      { type: 'radio', value: 'last' },
      { type: 'radio', value: 'last' },
      { type: 'number', value: '1' },
      { type: 'radio', value: 'last' },
      { type: 'radio', value: 'first' },
      { type: 'number', value: '1' },
      { type: 'radio', value: 'last' },
      { type: 'radio', value: 'last' },
    ]

    steps.forEach((step) => {
      if (step.type === 'radio') {
        if (step.value === 'first') cy.get('[type="radio"]').first().click()
        else cy.get('[type="radio"]').last().click()
      } else if (step.type === 'number') {
        cy.get('input[type="number"]').clear().type(step.value)
      }

      cy.contains('Далі').click()
    })

    cy.wait('@submitResults').its('response.statusCode').should('eq', 200)
    cy.url().should('include', '/diabetes-test/results/show')
  })
})