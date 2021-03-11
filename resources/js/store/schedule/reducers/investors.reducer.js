import { fromJS, List, Map } from "immutable";
import mutations from "../mutations/investors.mutations";
import reducerFactory from "./reducer-factory";

// const initialState = new Map({
//     startingData: fromJS({
//         slot: {},
//         company: {}
//     }),
//     investors: new List([])
// });

const initialState = {
    startingData: {
        slot: {},
        company: {}
    },
    investors: []
};

export default reducerFactory(initialState, mutations);
