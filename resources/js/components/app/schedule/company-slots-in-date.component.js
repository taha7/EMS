import React, { memo, useEffect } from "react";
import moment from "moment";
import InvCompanyInSlot from "./inv-company-in-slot.component";
import { connect } from "react-redux";
import { toJS } from "../../../lib/to-js";

const CompanySlotsInDate = memo(
    ({
        date,
        company,
        slots,
        openInvestorsModal
    }) => {
        useEffect(() => {
            console.log("in CompanySlotsInDate");
        }, []);

        return (
            <td className="table-data">
                <div className="slots d-flex align-items-stretch">
                    {slots.map(slot => {
                        const isSlotVisible =
                            slot.type != 3 ||
                            (slot.type == 3 && slot.meetings[company.id]);

                        return isSlotVisible ? (
                            <div
                                className="timeSlot d-flex flex-column"
                                key={date + company.id + slot.id}
                            >
                                <div className="slotHeader d-flex justify-content-center align-items-center">
                                    <span className="startTime">
                                        {moment(
                                            slot.start_time,
                                            "HH:mm:ss"
                                        ).format("HH:mm")}
                                    </span>
                                    -
                                    <span className="endTime">
                                        {moment(
                                            slot.end_time,
                                            "HH:mm:ss"
                                        ).format("HH:mm")}
                                    </span>
                                </div>
                                <div className="slot-body">
                                    {slot.meetings[company.id]
                                        ? Object.keys(
                                              slot.meetings[company.id]
                                          ).map(invComp => {
                                              const firstMeeting =
                                                  slot.meetings[company.id][
                                                      invComp
                                                  ][0];
                                              return (
                                                  <InvCompanyInSlot
                                                      key={
                                                          invComp +
                                                          firstMeeting.agenda_slot_id +
                                                          firstMeeting.company_id +
                                                          firstMeeting.client_id
                                                      }
                                                      invCompName={invComp}
                                                      meetingsWithPresComp={
                                                          slot.meetings[
                                                              company.id
                                                          ][invComp]
                                                      }
                                                  />
                                              );
                                          })
                                        : null}
                                </div>
                                <div className="schedule-footer d-flex justify-content-center align-items-center p-2">
                                    <button
                                        className="add-inv shadow button circle-button-sm primary-button"
                                        type="button"
                                        data-toggle="modal"
                                        data-target="#investorsModal"
                                        onClick={() =>
                                            openInvestorsModal({
                                                slot,
                                                company
                                            })
                                        }
                                    >
                                        <i className="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        ) : null;
                    })}
                </div>
            </td>
        );
    }
);



const mapDispatchToProps = dispatch => ({
    openInvestorsModal: startingData =>
        dispatch({
            type: "SET_INVESTORS_MODAL_STARTING_DATA",
            payload: startingData
        })
});

export default connect(null, mapDispatchToProps)(toJS(CompanySlotsInDate));
