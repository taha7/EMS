import React, { memo, useEffect, useState } from "react";
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
    console.log("renderCompanies");
    return companies.map((company, $index) => (
        <tr key={company.id}>
            <td className="companies-box p-2">
                <div className="company-name">
                    {company.name} {$index + 1}
                </div>
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

const ScheduleBody = memo(
    ({
        scheduleData: schedule,
        loadScheduleData,
        appendCompanies,
        isLoading,
        datesWidth
    }) => {
        useEffect(() => {
            loadScheduleData();
        }, []);

        let lastScroll = 0;

        const detectAppendCompanies = e => {
            let scrollDown = false;
            if (e.target.scrollTop > lastScroll) {
                scrollDown = true;
            }
            lastScroll = e.target.scrollTop;

            if (
                Math.ceil(e.target.offsetHeight + e.target.scrollTop) >=
                    e.target.scrollHeight - 100 &&
                scrollDown &&
                !isLoading
            ) {
                appendCompanies();
            }
        };

        return (
            <div
                className="schedule-body-container shadow-xl"
                onScroll={detectAppendCompanies}
            >
                <table className="table table-borderless">
                    <thead>
                        <tr className="">
                            <th className="companies-title ">Companies</th>
                            {renderDates(schedule.dates, datesWidth)}
                        </tr>
                    </thead>
                    <tbody id="schedule-table-body">
                        {renderCompanies(schedule)}
                    </tbody>
                </table>
                <InvestorsModal />
            </div>
        );
    }
);

const mapStateToProps = ({ scheduleReducer }) => ({
    scheduleData: scheduleReducer.scheduleData,
    datesWidth: scheduleReducer.datesWidth,
    scheduleHeight: scheduleReducer.scheduleHeight,
    isLoading: scheduleReducer.isLoading
});

export default connect(mapStateToProps, mapDispatchToProps)(ScheduleBody);
