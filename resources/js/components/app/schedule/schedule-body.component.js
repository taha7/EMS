import React, { useEffect } from "react";
import { connect } from "react-redux";
import mapDispatchToProps from "../../../store/schedule/actions/index.action";
import CompanySlotsInDate from "./company-slots-in-date.component";
import InvestorsModal from "./investors-modal.component";
import "./schedule.css";

const renderDates = (dates, datesWidth) => {
    console.log("rerender dates");

    return dates.map(date => (
        <th className="dates-title " key={date}>
            {date} {datesWidth[date]}
        </th>
    ));
};

const renderCompanies = ({ companies, scheduleAgendaSlots }) => {
    return companies.map((company, $index) => (
        <tr key={company.id}>
            <td className="companies-box p-2">
                <div className="company-name">{company.name} {$index + 1}</div>
            </td>
            {Object.keys(scheduleAgendaSlots).map(date => (
                <CompanySlotsInDate
                    key={company.id + date}
                    company={company}
                    date={date}
                    slots={scheduleAgendaSlots[date]}
                />
            ))}
        </tr>
    ));
};

const ScheduleBody = ({
    scheduleData: schedule,
    loadScheduleData,
    datesWidth
}) => {
    useEffect(() => {
        loadScheduleData();
    }, []);

    return (
        <div className="schedule-body-container shadow-xl">
            <table className="table table-borderless">
                <thead>
                    <tr className="">
                        <th className="companies-title ">Companies</th>
                        {renderDates(schedule.dates, datesWidth)}
                    </tr>
                </thead>
                <tbody>{renderCompanies(schedule)}</tbody>
            </table>
            <InvestorsModal />
        </div>
    );
};

const mapStateToProps = ({ scheduleReducer }) => ({
    scheduleData: scheduleReducer.scheduleData,
    datesWidth: scheduleReducer.datesWidth
});

export default connect(mapStateToProps, mapDispatchToProps)(ScheduleBody);
