import React from "react";
import ReactDOM from "react-dom";
import { Provider } from "react-redux";
import store from "../store/schedule/store";
import ScheduleBody from "../components/app/schedule/schedule-body.component";

const Schedule = () => (
    <div className="container-fluid" style={{ height: "100%" }}>
        <ScheduleBody />
    </div>
);

const scheduleElement = document.getElementById("schedule");
if (scheduleElement) {
    ReactDOM.render(
        <Provider store={store}>
            <Schedule />
        </Provider>,
        scheduleElement
    );
}

export default Schedule;
