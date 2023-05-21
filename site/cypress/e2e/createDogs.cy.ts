// https://on.cypress.io/api

import {createDog} from "../api/seedDog";
import type {DogCreateResponse} from "./types";

describe('Create dog test', () => {

  let dog: DogCreateResponse;
  const uniqueIdentifier = Math.random();

  beforeEach(() => {
    createDog(uniqueIdentifier).then((createdDog) => {
      dog = createdDog.body;
    })
  })

  it('should add a dog', () => {
    cy.visit('/addDog')
    fillOutName('Nicky the dog')

    fillOutBreed('Shiba inu')

    addDog();

    cy.contains('Dog creation successfully started.').should('exist');
  });

  it('should fail to add a dog', () => {
    cy.visit('/addDog')

    fillOutBreed('Shiba inu')

    addDog();

    cy.contains('The name field is required.').should('exist');
  })

  const fillOutName = (value: string): void => {
    cy.get('input[data-testid=name]').type(value);
  }

  const fillOutBreed = (value: string): void => {
    cy.get('input[data-testid=breed]').type(value);
  }

  const addDog = (): void => {
    cy.get('input').contains('Add dog').click();
  }
})
