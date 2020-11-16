import mutations from "../mutations/schedule.mutations";

const initialState = {
    scheduleData: {
        dates: [],
        companies: [],
        scheduleAgendaSlots: {}
    }
};

const reducer = (state = initialState, action) => {
    if (mutations.hasOwnProperty(action.type)) {
        return mutations[action.type](state, action.payload);
    }

    return state;
};

export default reducer;
