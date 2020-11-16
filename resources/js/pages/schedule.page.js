import React, { useEffect } from "react";
import ReactDOM from "react-dom";
import { Provider } from "react-redux";
import store from "../store/schedule/store";
import ScheduleBody from "../components/app/schedule/schedule-company/schedule-body.component";

const Schedule = () => (
    <div className="container-fluid" style={{ height: "100%" }}>
        <div className="row">
            <div className="col-md-12">
                <div className="card">
                    <div className="card-header">Example Component</div>
                </div>
            </div>
        </div>
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
