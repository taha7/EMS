const reducerFactory = (initialState, mutations) => (
    state = initialState,
    action
) => {
    if (mutations.hasOwnProperty(action.type)) {
        return mutations[action.type](state, action.payload);
    }

    return state;
};

export default reducerFactory;
