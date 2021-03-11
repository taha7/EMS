import { combineReducers } from "redux";
// import { combineReducers } from "../../../lib/combine-reducers";
// import { combineReducers } from "redux-immutable";

import scheduleReducer from "./schedule.roducer";
import investorsReducer from "./investors.reducer";

const rootReducer = combineReducers({
    scheduleReducer,
    investorsReducer,
});

export default rootReducer;
