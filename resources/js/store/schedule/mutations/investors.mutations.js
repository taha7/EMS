import { fromJS, List } from "immutable";

const mutations = {
    SET_INVESTORS_MODAL_STARTING_DATA: (state, payload) => {
        return {
            ...state,
            startingData: { ...state.startingData, ...payload }
        };
    },
    // SET_INVESTORS_MODAL_STARTING_DATA: (state, payload) =>
    //     state.setIn(["startingData"], fromJS(payload)),
    SET_INVESTORS_IN_INVESTORS_MODAL: (state, payload) => {
        return {
            ...state,
            investors: payload
        };
    }
    // SET_INVESTORS_IN_INVESTORS_MODAL: (state, payload) =>
    //     state.setIn(["investors"], new List(payload))
};

export default mutations;
