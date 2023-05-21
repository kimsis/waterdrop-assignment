// https://on.cypress.io/api

import {createDog} from "../api/seedDog";
import type {DogCreateResponse} from "./types";

describe('Get dogs test', () => {

    let dog: DogCreateResponse;

    const uniqueIdentifier = Math.random();

    beforeEach(() => {
        createDog(uniqueIdentifier).then((createdDog) => {
            dog = createdDog.body;
        })
        cy.wait(11000);
    })

    it('should list all dogs', function () {
        cy.visit('/dogsList')

        listDogs();

        cy.get('div[data-testid=dogsList]').children();
    });

    it('should list all dogs, filtered by search string', function () {
        cy.visit('/dogsList')

        setNameInput(uniqueIdentifier.toString());

        listDogs();

        cy.get('div[data-testid=dogsList]').children();
    })

    const listDogs = (): void => {
        cy.get('input').contains('Get all dogs').click();
    }

    const setNameInput = (input: string): void => {
        cy.get('input[data-testid=name]').type(input);
    }
})