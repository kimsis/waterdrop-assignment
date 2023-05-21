/// <reference types="cypress" />

import type { DogCreateResponse } from "../e2e/types";

const apiUrl = Cypress.env('apiUrl');
export function createDog(uniqueNumber: number): Cypress.Chainable<Cypress.Response<DogCreateResponse>> {
    const body = {
        data: '{"name":"Nick' + uniqueNumber + '","breed":"Shiba"}',
    }
    return cy.request({
        url: `${apiUrl}/addDog`,
        headers: createHeaders(Cypress.env('apiKey')),
        body,
        method: 'POST',
    });
}

function createHeaders(apiKey?: string): Record<string, string> {
    return {
        Authorization: `${apiKey}`,
        'accept': 'application/json'
    };
}
