import { SET_SCHEDULE_DATA } from "../types/index.types";

const mutations = {
    [SET_SCHEDULE_DATA]: (state, payload = null) => payload,
    // SET_INVESTORS_MODAL_STARTING_DATA: (state, payload) => {
    //     return {
    //         ...state,
    //         investorsModal: {
    //             ...state.investorsModal,
    //             startingData: { ...state.startingData, ...payload }
    //         }
    //     };
    // },
    // SET_INVESTORS_IN_INVESTORS_MODAL: (state, payload) => {
    //     return {
    //         ...state,
    //         investorsModal: {
    //             ...state.investorsModal,
    //             investors: payload
    //         }
    //     };
    // }
};

export default mutations;
