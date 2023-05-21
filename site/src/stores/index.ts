// @ts-ignore
import {createStore} from "vuex";
import axios from "axios";

// @ts-ignore
// @ts-ignore
const store = createStore({
    state: {
        secretKey: 'secret_key',
    },
    getters: {},
    actions: {
        getAllDogs() {
            return axios.get('http://localhost:9000/api/listDogs', {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: store.state.secretKey,
                },
                method: "GET",
            })
                .then((res) => res.data.data)
        },
        getAllNamedDogs({}, name: string) {
            return axios.get('http://localhost:9000/api/listDogs?name=' + name, {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: store.state.secretKey,
                },
                method: "GET",
            })
                .then((res) => res.data.data)
        },
        saveDog({}, dogData: object) {
            const data = {
                data: JSON.stringify(dogData)
            };
            try{
                return axios.post('http://localhost:9000/api/addDog', data, {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        Authorization: store.state.secretKey,
                    },
                    method: "POST",
                })
                    .catch(err => { return err.response } )
            } catch (axiosError) {
                return console.log(axiosError);
            }
        }
    },
    mutations: {},
    modules: {},
})

export default store;