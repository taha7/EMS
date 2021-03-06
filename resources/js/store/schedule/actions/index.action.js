import { SET_SCHEDULE_DATA } from "../types/index.types";

const mapDispatchToProps = dispatch => {
    return {
        loadScheduleData: () => {
            dispatch({ type: SET_LOADING, payload: true });
            axios
                .get("/schedule?page=1")
                .then(({ data }) => {
                    dispatch({ type: SET_SCHEDULE_DATA, payload: data });
                    dispatch({ type: SET_LOADING, payload: false });
                })
                .catch(() => {
                    dispatch({ type: SET_LOADING, payload: false });
                });
        },
        appendCompanies: () => {
            dispatch({ type: SET_LOADING, payload: true });
            axios
                .get(`/schedule?page=${page}`)
                .then(({ data }) => {
                    dispatch({ type: appendCompanies, payload: data });
                    dispatch({ type: SET_LOADING, payload: false });
                })
                .catch(() => {
                    dispatch({ type: SET_LOADING, payload: false });
                });
        }
    };
};

export default mapDispatchToProps;
