import React, { useEffect } from "react";
import { connect } from "react-redux";
import mapDispatchToProps from "../../../../store/schedule/actions/index.action";
import CompanyTimeSlotsInDate from "../company-time-slots-in-date/company-time-slots-in-date.component";
import "./schedule-body.css";

const renderDates = dates =>
    dates.map(date => (
        <th className="dates-title " key={date}>
            {date}
        </th>
    ));

const renderCompanies = ({ companies, scheduleAgendaSlots }) => {
    return companies.map(company => (
        <tr key={company.id}>
            <td
                className="companies-box p-2"
                style={{ verticalAlign: "inherit" }}
            >
                <div className="company-name">{company.name}</div>
            </td>
            {Object.keys(scheduleAgendaSlots).map(date => (
                <CompanyTimeSlotsInDate
                    key={company.id + date}
                    company={company}
                    date={date}
                    slots={scheduleAgendaSlots[date]}
                />
            ))}
        </tr>
    ));
}

const ScheduleBody = ({ scheduleData: schedule, loadScheduleData }) => {
    useEffect(() => {
        loadScheduleData();
    }, []);

    return (
        <div className="schedule-body-container">
            <table className="table table-borderless">
                <thead>
                    <tr className="">
                        <th className="companies-title ">Companies</th>
                        {renderDates(schedule.dates)}
                    </tr>
                </thead>
                <tbody>{renderCompanies(schedule)}</tbody>
            </table>
        </div>
    );
};

const mapStateToProps = state => ({
    scheduleData: state.scheduleReducer.scheduleData
});

export default connect(mapStateToProps, mapDispatchToProps)(ScheduleBody);
