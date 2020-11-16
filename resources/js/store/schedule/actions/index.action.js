import { SET_SCHEDULE_DATA } from '../types/index.types'

const mapDispatchToProps = dispatch => {
    return {
        loadScheduleData: () => {
            axios.get("/schedule").then(({ data }) => {
                dispatch({ type: SET_SCHEDULE_DATA, payload: data });
            });
        }
    };
};

export default mapDispatchToProps;
