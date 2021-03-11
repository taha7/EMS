export const combineReducers = config => {
    return (state, action) => {
        return Object.keys(config).reduce((state, key) => {
            const reducer = config[key];
            const prevState = state.get(key);

            const newVal = reducer(prevState, action);
            if (!newVal) {
                throw new Error(
                    `A reducer returned undefined when reducing key::${key}`
                );
            }
            return state.set(key, newVal);
        }, state);
    };
};
