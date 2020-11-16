import React, { useState } from "react";
import "./company-time-slots-in-date.module.css";
import moment from "moment";
import InvCompanyInSlot from "../inv-company-in-slot/inv-company-in-slot.component";

const CompanyTimeSlotsInDate = ({ date, company, slots }) => {
    return (
        <td className="table-data">
            <div className="slots d-flex align-items-stretch">
                {slots.map(slot => (
                    <div className="timeSlot" key={date + company.id + slot.id}>
                        <div className="slotHeader">
                            <span className="startTime">
                                {moment(slot.start_time, "HH:mm:ss").format(
                                    "HH:mm"
                                )}
                            </span>
                            -
                            <span className="endTime">
                                {moment(slot.end_time, "HH:mm:ss").format(
                                    "HH:mm"
                                )}
                            </span>
                        </div>
                        <div className="slot-body">
                            {slot.meetings[company.id]
                                ? Object.keys(slot.meetings[company.id]).map(
                                      invComp => {
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
                                                      slot.meetings[company.id][
                                                          invComp
                                                      ]
                                                  }
                                              />
                                          );
                                      }
                                  )
                                : null}
                        </div>
                    </div>
                ))}
            </div>
        </td>
    );
};

export default CompanyTimeSlotsInDate;
