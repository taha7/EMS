import { fromJS } from "immutable";
import { SET_SCHEDULE_DATA } from "../types/index.types";

const mutations = {
    [SET_SCHEDULE_DATA]: (state, payload = null) => fromJS(payload)
};

export default mutations;
