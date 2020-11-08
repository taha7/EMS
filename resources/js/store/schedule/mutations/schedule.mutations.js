import { SET_SCHEDULE_DATA } from "../types/index.types";

const mutations = {
    [SET_SCHEDULE_DATA]: (state, payload = null) => ({
        ...state,
        scheduleData: payload
    })
};

export default mutations;
