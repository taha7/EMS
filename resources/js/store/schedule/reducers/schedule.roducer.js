import { Map } from "immutable";
import mutations from "../mutations/schedule-data.mutations";
import reducerFactory from "./reducer-factory";

const initialState = new Map({
    dates: [],
    companies: [],
    scheduleAgendaSlots: {}
});

export default reducerFactory(initialState, mutations);
