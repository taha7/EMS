import React, { useEffect } from "react";
import ReactDOM from "react-dom";
import { connect, Provider } from "react-redux";
import store from "../store/schedule/store";
import mapDispatchToProps from "../store/schedule/actions/index.action";

function Schedule(props) {
    useEffect(() => {
        props.loadScheduleData();
    }, []);
    console.log(props.scheduleData);
    return (
        <div className="container-fluid">
            <div className="row">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header">Example Component</div>

                        <div className="card-body">
                            {Object.keys(props.scheduleData).length > 0 && (
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th>Companies</th>
                                            {Object.keys(
                                                props.scheduleData
                                            ).map(date => (
                                                <th key={date}>{date}</th>
                                            ))}
                                        </tr>
                                    </thead>
                                </table>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

const mapStateToProps = state => ({
    scheduleData: state.scheduleReducer.scheduleData
});

const ScheduleComponenet = connect(
    mapStateToProps,
    mapDispatchToProps
)(Schedule);

const scheduleElement = document.getElementById("schedule");
if (scheduleElement) {
    ReactDOM.render(
        <Provider store={store}>
            <ScheduleComponenet />
        </Provider>,
        scheduleElement
    );
}

export default ScheduleComponenet;
